<template>
    <div>
      <form @submit.prevent="onSubmit">
       

        <div :class="['form-group', {'has-error': errors.board}]">
            <label >Placa do veiculo:</label>
            <input type="text"  class="form-control" placeholder="Nome da placa do veiculo" v-model="freight.board">
            <div v-if="errors.board" class="help-block">
                <p>{{ errors.board[0] }}</p>
            </div>
        </div>

        <div :class="['form-group', {'has-error': errors.vehicle_owner}]">
             <label >Dono do Veiculo:</label>
            <input type="text" class="form-control" placeholder="Dono do Veiculo" v-model="freight.vehicle_owner">
            <div v-if="errors.vehicle_owner" class="help-block">
                <p>{{ errors.vehicle_owner[0] }}</p>
            </div>
        </div>
        <div :class="['form-group', {'has-error': errors.price_freight}]">
             <label >Valor do Frete:</label>
            <input type="number" min="0.01" step="0.01" class="form-control" placeholder="Valor do Frete" v-model="freight.price_freight">
            <div v-if="errors.price_freight" class="help-block">
                <p>{{ errors.price_freight[0] }}</p>
            </div>
        </div>
        <div :class="['form-group', {'has-error': errors.date_start}]">
              <label >Data de Inicio:</label>
            <input type="date" class="form-control" placeholder="Data de Inicio" v-model="freight.date_start">
            <div v-if="errors.date_start" class="help-block">
                <p>{{ errors.date_start[0] }}</p>
            </div>
        </div>
        <div :class="['form-group', {'has-error': errors.date_end}]">
            <label >Data de fim:</label>
            <input type="date" class="form-control" placeholder="Data de fim" v-model="freight.date_end">
            <div v-if="errors.date_end" class="help-block">
                <p>{{ errors.date_end[0] }}</p>
            </div>
        </div>
           <div :class="['form-group',{'has-error':errors.status}]">
                 <label >Status:</label>
                <select v-model="freight.status"  class="form-control">
                    <option disabled  value="">Escolha o status</option>
                    <option value="Iniciado">{{freight.status.iniciado}}</option>
                     <option value="em trânsito">{{freight.status.transito}}</option>
                      <option value="concluido">{{freight.status.concluido}}</option>
                </select>
                
                <div v-if="errors.status" class="help-block">
                    <p>{{errors.status[0]}}</p>
                </div>
            </div>
            
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>
</template>

<script>
import PictureInput from 'vue-picture-input'

export default {
    mounted () {
        this.reset()
    },
    props: {
        update: {
            require: false,
            type: Boolean,
            default: false
        },
        freight: {
            require: false,
            type: Object,
            default: ()=>{
                    return {
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
                }
            }
        }
    },
    data () {
        return {
            errors: {},
        }
    },
    methods: {
        onSubmit () {
            const action = this.update ? 'editFreight' : 'addFreight'
            const formData = new FormData()
            formData.append('id', this.freight.id)
            formData.append('board', this.freight.board)
            formData.append('vehicle_owner', this.freight.vehicle_owner)
            formData.append('price_freight', this.freight.price_freight)
            formData.append('date_start', this.freight.date_start)
            formData.append('date_end', this.freight.date_end)
            formData.append('status', this.freight.status)

            return this.$store.dispatch(action, formData)
                        .then(() => {
                            this.$swal('Sucesso', 'Operação realizada com sucesso!', 'success')

                            this.$emit('success')

                            this.errors = {}
                        })
                        .catch(errors => {
                            this.$snotify.error('Algo errado...')

                            this.errors = errors.hasOwnProperty('errors') ? errors.errors : errors
                        })
        },
        reset () {
            console.log('Form reset')
            this.errors = {}
        }
    },
    components: {
        PictureInput
    }
}
</script>

<style>
form{
    margin: 10px 0;
}
.img-responsive{max-width: 60px;}
</style>
