
import Page404 from '../components/frontend/pages/404/Page404'
import App from '../components/frontend/AppComponent'
import HomePageComponent from '../components/frontend/pages/home/HomePageComponent'

export default [
    /**
     * Rotas Sistema
     */
    {
        path: '/',
        component: App,
        meta: {
            auth: false
        },
        children: [{
            path: '',
            component: HomePageComponent,
            name: 'home'
        }, ]
    },


    
    

    // Rota 404
    {
        path: '*',
        component: Page404
    },
]