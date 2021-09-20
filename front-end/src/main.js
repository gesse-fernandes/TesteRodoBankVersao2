
window.Vue = require('vue')
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import bootstrap from '../node_modules/bootstrap/dist/css/bootstrap.css'
import store from './vuex/store'
import Snotify from 'vue-snotify'
import VueSwal from 'vue-swal'
Vue.use(bootstrap);
Vue.use(Snotify, {
  toast: {
    showProgressBar: true
  }
})
Vue.use(VueSwal)

/**
 * Cria os componentes globais
 */
/* pegar vue.component*/ 
Vue.component('preloader-component', require('./components/layouts/PreloaderComponent'))

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
