import Vue from 'vue'
import Router from 'vue-router'
//Registo de componentes
import Home from './components/Home'
import BookDetails from './components/BookDetails'
import BookRead from './components/BookRead'
import BookVideo from './components/BookVideo'
import SearchPage from './components/SearchPage'
import Login from './components/Login'
import Signup from './components/Signup'
import Dashboard from './components/Dashboard/Dashboard'
import Author from './components/Author'
import Activities from './components/Activities'
import Profile from './components/Dashboard/Profile'
import Favourites from './components/Dashboard/Favourites'
import Mybooks from './components/Dashboard/Mybooks'
import Contact from './components/Dashboard/Contact'
import Premium from './components/Dashboard/Premium'

Vue.use(Router)
export default new Router({
    //mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },        
        {
            path: '/book/:id',
            name: 'BookDetails',
            component: BookDetails,
            props: true
        },
        {
            path: '/book/:id/read',
            name: 'BookRead',
            component: BookRead,
            props: true
        },
        {
            path: '/book/:id/video',
            name: 'BookVideo',
            component: BookVideo,
            props: true
        },
        {
            path: '/search/:search',
            name: 'Search',
            component: SearchPage,
            props: true
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
            props: true
        },
        {
            path: '/Signup',
            name: 'Signup',
            component: Signup,
            props: true
        },
        {
            path: '/dashboard',
            name: 'Dashboard',
            component: Dashboard,
            redirect: {
                name: 'Profile',
              },
            props: true,
            children: [
                {
                    path: '/profile',
                    name: 'Profile',
                    component: Profile,
                    props: true
                },
                {
                    path: '/favourites',
                    name: 'Favourites',
                    component: Favourites,
                    props: true
                },
                {
                    path: '/mybooks',
                    name: 'Mybooks',
                    component: Mybooks,
                    props: true
                },
                {
                    path: '/premium',
                    name: 'Premium',
                    component: Premium,
                    props: true
                },
                {
                    path: '/contact',
                    name: 'Contact',
                    component: Contact,
                    props: true
                }
            ]
        },
        {
            path: '/author/:id',
            name: 'Author',
            component: Author,
            props: true
        },
        {
            path: '/activities/:id',
            name: 'Activities',
            component: Activities,
            props: true
        },
        
    ]
})