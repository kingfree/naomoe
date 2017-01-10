import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

import $ from 'jquery'

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'

import 'semantic'
import '../semantic/dist/semantic.css'

import 'select2'
import 'select2/dist/css/select2.css'
import 'select2/dist/js/i18n/zh-CN'

import App from './App'
import Home from './Home'
import Character from './Character'
import Competition from './Competition'

Vue.use(VueResource)
Vue.use(VueRouter, 'localhost:3000')
Vue.use(ElementUI)

Vue.component('select2', {
  props: ['options', 'value'],
  template: '<select><slot></slot></select>',
  mounted: function() {
    var vm = this
    $(this.$el)
      .val(this.value)
      // init select2
      .select2({ data: this.options })
      // emit event on change.
      .on('change', function() {
        vm.$emit('input', this.value)
      })
  },
  watch: {
    value: function(value) {
      // update value
      $(this.$el).val(value)
    },
    options: function(options) {
      // update options
      $(this.$el).select2({ data: options })
    }
  },
  destroyed: function() {
    $(this.$el).off().select2('destroy')
  }
})

const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    { path: '/home', name: 'home', component: Home },
    { path: '/character', name: 'character', component: Character, meta: { title: '角色' } },
    { path: '/competition', name: 'competition', component: Competition, meta: { title: '比赛' } }
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
