<template>
  <div id="app" class="ui material">
    <header-component/>
    <div class="ui container">
      <router-view class="view"></router-view>
    </div>
  </div>
</template>

<script>
import HeaderComponent from './components/header'

export default {
  name: 'app',
  data() {
    return {
      success: {title: null, content: null},
      error: {title: null, content: null}
    }
  },
  components: {
    HeaderComponent
  },
  methods: {
    showError: function(title, content) {
      this.error.title = title
      this.error.content = content
      setTimeout(function() {
        this.error.title = null
      }, 5000)
    }
  }
}

</script>

<style>
* {
  font-family: "PingFang SC", Ubuntu, Tahoma, Arial, Helvetica, "Microsoft YaHei New", "Microsoft Yahei", "微软雅黑", STXihei, "华文细黑", "文泉驿微米黑", 宋体, SimSun, sans-serif;
}

.view {
  position: inherit;
  padding-top: 65px;
  padding-bottom: 40px;
}

</style>
