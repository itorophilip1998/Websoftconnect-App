//pages routes
import Home from './components/mainapp/home';
import Notification from './components/mainapp/notification';
import Profile from './components/mainapp/profile';
import Chat from './components/mainapp/chat';
import Chats from './components/mainapp/chats';
import Settings from './components/mainapp/settings';
import Search from './components/mainapp/search';
import About from './components/mainapp/about';
import Premium from './components/mainapp/premium';
import EditComment from './components/mainapp/categories/editcomment';
import EditPost from './components/mainapp/categories/editpost';
import Reactions from './components/mainapp/categories/reactions';
import Post from './components/mainapp/categories/singlepost';
import Groups from './components/mainapp/groups';
import Group from './components/mainapp/group';
import Videos from './components/mainapp/videos';



// extension Routes
import VueSweetalert2 from 'vue-sweetalert2';
import VueRouter from "vue-router";
import Axios from 'axios'
import Vue from 'vue'
import Vuesax from 'vuesax'

// used extention
Vue.use(Axios)
Vue.use(VueRouter);
Vue.use(VueSweetalert2);



const routes = [
    {
        path: '/home',
        component: Home,
        meta: {
            auth: true,
            title: 'Home'
          }
    },
    {
        path: '/',
        component: Home,
        meta: {
            auth: true,
            title: 'Home'
          }
    },
    {
        path: '/notification',
        component: Notification,
        meta: {
            auth: true,
            title: 'Notification'
          }
    },
    {
        path: '/profile/:name',
        component: Profile,
        meta: {
            auth: true,
            title: 'Profile'
          }
    },

    {
        path: '/settings',
        component: Settings,
        meta: {
            auth: true,
            title: 'Setting'
          }
    },
    {
        path: '/chat/:name',
        component: Chat,
        meta: {
            auth: true,
            title: 'Chat'
          }
    },
    {
        path: '/chats',
        component: Chats,
        meta: {
            auth: true,
            title: 'Chats'
          }
    },
    {
        path: '/videos',
        component: Videos,
        meta: {
            auth: true,
            title: 'Videos'
          }
    },

    {
        path: '/search/:name',
        component: Search,
        meta: {
            auth: true,
            title: 'Search'
          }
    },
    {
        path: '/about',
        component: About,
        meta: {
            auth: true,
            title: 'About'
          }
    },
    {
        path: '/premium',
        component: Premium,
        meta: {
            auth: true,
            title: 'Premium'
          }
    },
    {
        path: '/editpost/:name',
        component: EditPost,
        meta: {
            auth: true,
            title: 'EditPost'
          }
    },
    {
        path: '/editcomment/:name',
        component: EditComment,
        meta: {
            auth: true,
            title: 'EditComment'
          }
    },
    {
        path: '/reactions/:name',
        component: Reactions,
        meta: {
            auth: true,
            title: 'Reactions'
          }
    },
    {
        path: '/post/:name',
        component: Post,
        meta: {
            auth: true,
            title: 'Post'
          }
    },
    {
        path: '/groups',
        component: Groups,
        meta: {
            auth: true,
            title: 'Groups'
          }
    },
    {
        path: '/group/:id',
        component: Group,
        meta: {
            auth: true,
            title: 'Group'
          }
    },



]


const router = new VueRouter({
    routes: routes,
    linkActiveClass: 'active',
    mode: 'hash',
    hashbang: true,
    history: false,
})

export default router
