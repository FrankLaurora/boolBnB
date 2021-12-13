import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Home from './pages/Home';
import Apartment from './pages/Apartment';
import NotFound from './pages/NotFound';
// import About from './pages/About';
// import Contacts from './pages/Contacts';
// import Error_404 from './pages/Error_404';

const router = new VueRouter({
    mode: 'history',

    routes: [
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/apartment',
            name: 'apartment',
            component: Apartment
        },
        // {
        //     path: '/about',
        //     name: 'about',
        //     component: About
        // },
        // {
        //     path: '/contacts',
        //     name: 'contacts',
        //     component: Contacts
        // },
        {
            path: '/*',
            name: 'error_404',
            component: NotFound
        },
    ]
});

export default router;