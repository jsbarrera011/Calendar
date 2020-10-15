import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './components/Home.vue'
import NavBar from './components/NavBar.vue'

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes:[
        {
            path: '/',
            name: 'Home',
            components: {
                header: NavBar,
                default: Home
            }
        }
    ]
})
