import Vue from 'vue'
import VueRouter from 'vue-router'
// import VueMaterial from 'vue-material'

// import '../node_modules/vue-material/dist/vue-material.css'
// import '../node_modules/font-awesome/css/font-awesome.css'
import '../node_modules/semantic-ui-css/semantic.css'

import App from './App'
import Home from './Home'
import Character from './Character'

// Vue.use(VueMaterial)
// Vue.material.registerTheme({
//   default: {
//     primary: 'pink',
//     accent: 'orange'
//   }
// })

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    { path: '/', name: 'home', component: Home },
    { path: '/character', name: 'character', component: Character }
  ]
})

new Vue({
  router,
  template: `<App/>`,
  components: { App }
}).$mount('#app')
