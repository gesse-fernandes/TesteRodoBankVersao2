<template>
  <div class="container">
    <h1>Teste de Seleção da empresa RodoBank</h1>
    <h2>Sistema de fretes</h2>
    <h1>
      Total de Fretes
      <span v-if="freights.total > 0">({{ freights.total }})</span>
    </h1>

    <div class="row options">
      <div class="col">
        <a ref="modal" @click.prevent="create" class="btn btn-success">
          Adicionar
        </a>
      </div>

      <div class="col">
        <search @search="searchFreight"></search>

        <div v-if="search">Resultados para a pesquisa: {{ search }}</div>
      </div>
    </div>

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
          <button v-on:click="teste(freight.id)" class="btn btn-danger">
            Deletar
          </button>
        </td>
      </tr>
    </table>

    <vodal
      :show="showModal"
      animation="zoom"
      @hide="hide"
      :width="600"
      :height="500"
    >
      <form-freight :freight="freight" :update="update" @success="success">
      </form-freight>
    </vodal>

    <paginate
      :pagination="freights"
      :offset="3"
      @paginate="loadFreights"
    ></paginate>
  </div>
</template>

<script>
import Vodal from "vodal";

import SearchFreightComponent from "../../SearchFreightComponent.vue";
import PaginationComponent from "../../../layouts/PaginationComponent";
import FormFreightComponent from "../../FormFreightComponent.vue";

export default {
  name: "freight-component",
  created() {
    this.loadFreights();
  },
  data() {
    return {
      search: null,
      freightId: null,
      showModal: false,
      freight: {
        id: '',
                    board:'',
                    vehicle_owner:'',
                    price_freight:'',
                    date_start:'',
                    date_end:'',
                    status:{
                        iniciado:'Iniciado',
                        transito:'em trânsito',
                        concluido:'concluido',
                        
                    },
      },
      update: false,
    };
  },
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
    teste(id) {
      if (confirm("Confirma a exclusão?")) {
        this.destroy(id);
      }
    },
    destroy(id) {
      this.$store.dispatch("destroyFreight", id).then(() => {
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
         id: '',
                    board:'',
                    vehicle_owner:'',
                    price_freight:'',
                    date_start:'',
                    date_end:'',
                    status:{
                        iniciado:'Iniciado',
                        transito:'em trânsito',
                        concluido:'concluido',
                        
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
