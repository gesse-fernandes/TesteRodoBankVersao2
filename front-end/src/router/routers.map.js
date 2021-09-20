
import Page404 from '../components/frontend/pages/404/Page404'
import SiteComponent from '../components/frontend/SiteComponent'
import HomePageComponent from '../components/frontend/pages/home/HomePageComponent'

export default [
    /**
     * Rotas Site
     */
    {
        path: '/',
        component: SiteComponent,
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