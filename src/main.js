import Vue from 'vue'
import App from './App'
import VueMaterial from 'vue-material'
import '../node_modules/vue-material/dist/vue-material.css'
import '../node_modules/font-awesome/css/font-awesome.css'

Vue.use(VueMaterial)

Vue.material.registerTheme({
  default: {
    primary: 'pink',
    accent: 'green'
  }
})

var app = new Vue({
  el: '#app',
  template: '<App/>',
  components: { App }
})
