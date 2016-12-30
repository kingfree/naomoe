import Vue from 'vue'
import VueRouter from 'vue-router'
// import VueMaterial from 'vue-material'

// import '../node_modules/vue-material/dist/vue-material.css'
// import '../node_modules/font-awesome/css/font-awesome.css'
import '../semantic/dist/semantic.css'
import 'semantic'

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

Vue.use(VueRouter, 'localhost:3000')

const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    { path: '/home', name: 'home', component: Home },
    { path: '/character', name: 'character', component: Character, meta: { title: '角色' } }
  ]
})

router.afterEach(route => {
  document.title = route.meta.title || '闹萌'
})

new Vue({
  router,
  template: `<App/>`,
  components: { App }
}).$mount('#app')
