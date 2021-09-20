import Vue from 'vue'
import Vuex from 'vuex'

import Freight from './modules/freights/freights'
import preloader from './modules/preloader/preloader'


Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        freights: Freight,
        preloader,
        
    }
})