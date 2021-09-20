<!-- 
Aqui é meu templeate da Home 
que vai carregar minha Pagina
minha listagem, botões
adicionar, pesqusisar,editar e deletar
uso algumas classes do Bootstrap 
para ser melhor o css
-->
<template>
  <div class="container">
    <h1>Teste de Seleção da empresa RodoBank</h1>
    <h2>Sistema de fretes</h2>
    <h1>
      Total de Fretes
      <span v-if="freights.total > 0">({{ freights.total }})</span>
    </h1>
    <!--
      dentro
      dessa minha div possuo um nav-link
      que vai abrir um modal em baixo para que eu possa
      adicionar assim chamando a função do
      click prevent -> create

     -->
    <div class="row options">
      <div class="col">
        <a ref="modal" @click.prevent="create" class="btn btn-success">
          Adicionar
        </a>
      </div>
      <!--
        aqui outra div
        e uma tag search que vai servir de
        chamada do componente para que possa
        pesquisar a placa do veiculo e também 
        chamando a função searchFreight

       -->
      <div class="col">
        <search @search="searchFreight"></search>

        <div v-if="search">Resultados para a pesquisa: {{ search }}</div>
      </div>
    </div>
    <!-- aqui a minha tabela criada para a listagem

   
    -->
    <table class="table table-dark">
      <tr>
        <th>Placa do veiculo</th>
        <th>Dono do Veiculo</th>
        <th>Valor do Frete</th>
        <th>Data de Inicio</th>
        <th>Data Fim</th>
        <th>Status</th>
        <th width="200">Ações</th>
      </tr>
      <!-- 
        aqui crio tr e td caso tenha mais uma
        linha ou seja mais de um dado 
        e preenche a pos ter percorrido
        pelo v-for -> passando freights.data
        e exbindo os dados e também os botões
        editar e deletar
      -->
      <tr v-for="(freight, key) in freights.data" :key="key">
        <td v-text="freight.board"></td>
        <td v-text="freight.vehicle_owner"></td>
        <td v-text="freight.price_freight"></td>
        <td v-text="freight.date_start"></td>
        <td v-text="freight.date_end"></td>
        <td v-text="freight.status"></td>
        <td>
          <a href="#" @click.prevent="edit(freight.id)" class="btn btn-info">
            Editar
          </a>
          <button v-on:click="deletar(freight.id)" class="btn btn-danger">
            Deletar
          </button>
        </td>
      </tr>
    </table>
    <!-- 
    aqui é o meu modal que sera
    aberto.

  -->
    <vodal
      :show="showModal"
      animation="zoom"
      @hide="hide"
      :width="600"
      :height="500"
    >
      <!--
      minhas tags form-freight
      que vai chamar o formulário.
     -->
      <form-freight :freight="freight" :update="update" @success="success">
      </form-freight>
    </vodal>
    <!--
  minha paginação.
 -->
    <paginate
      :pagination="freights"
      :offset="3"
      @paginate="loadFreights"
    ></paginate>
  </div>
</template>
<!-- 
aqui é onde vai ter todo
o meu javascript importações
de componentes chamada de funções
-->
<script>
//TODO importo o modal
import Vodal from "vodal";
//TODO aqui chamo meu componente de pesquisa
import SearchFreightComponent from "../../SearchFreightComponent.vue";
//TODO minha paginação que vai paginar os dados
//TODO para a proxima pagina
import PaginationComponent from "../../../layouts/PaginationComponent";
//TODO aqui chamo o meu form do formulário.
import FormFreightComponent from "../../FormFreightComponent.vue";
//TODO aqui dou export por padrão é bom deixar default
export default {
  //TODO dou um nome a ele
  name: "freight-component",
  //TODO crio uma função anonima created
  //TODO que vai chamar a função loadFreights
  //TODO podendo assim retornar todos os dados da minha
  //TODO listagem.
  created() {
    this.loadFreights();
  },
  //TODO o meu data por padrão o javascript já tem essa função anonima
  data() {
    return {
      search: null,
      freightId: null,
      showModal: false,
      freight: {
        id: "",
        board: "",
        vehicle_owner: "",
        price_freight: "",
        date_start: "",
        date_end: "",
        status: {
          iniciado: "Iniciado",
          transito: "em trânsito",
          concluido: "concluído",
        },
      },
      update: false,
    };
  },
  //TODO aqui é onde são criadas as funçoes anonimas
  //TODO freights e params
  computed: {
    freights() {
      return this.$store.state.freights.items;
    },
    params() {
      return {
        page: this.freights.current_page,
        board: this.search,
      };
    },
  },
  methods: {
    loadFreights(page = 1) {
      this.$store.dispatch("loadFreights", { ...this.params, page });
    },
    edit(id) {
      this.reset();

      this.$store
        .dispatch("loadFreight", id)
        .then((response) => {
          this.freight = response;
          this.showModal = true;
          this.update = true;
        })
        .catch((error) => this.$snotify.error("Erro ao carregar Fretes"));
    },
    searchFreight(search) {
      this.search = search;
      this.loadFreights();
    },
    deletar(id) {
      if (confirm("Confirma a exclusão?")) {
        this.destroy(id);
      }
    },
    destroy(id) {
      this.$store.dispatch("destroyFreight", id).then(
      () => {
        this.$swal('Sucesso', 'Operação realizada com sucesso!', 'success')

        this.$emit('success')
        id = null;
        this.loadFreights();
      });
    },
    create() {
      this.reset();
      this.update = false;
      this.showModal = true;
    },
    hide() {
      this.showModal = false;
    },
    success() {
      this.reset();
      this.loadFreights();
      this.hide();
    },
    reset() {
      this.freight = {
        id: "",
        board: "",
        vehicle_owner: "",
        price_freight: "",
        date_start: "",
        date_end: "",
        status: {
          iniciado: "Iniciado",
          transito: "em trânsito",
          concluido: "concluído",
        },
      };
    },
  },
  components: {
    search: SearchFreightComponent,
    paginate: PaginationComponent,
    formFreight: FormFreightComponent,
    Vodal,
  },
};
</script>


<style scoped>
.options {
  margin: 20px 0;
}
.vodal-dialog {
  height: auto;
  max-width: 90%;
}
</style>
