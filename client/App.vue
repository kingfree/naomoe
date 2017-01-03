<template>
  <div id="app" class="ui material">
    <header-component/>
    <div class="ui container">
      <div class="row">
        <div class="ui floating positive message" :class="{ hidden: !success.title }">
          <i class="close icon"></i>
          <div class="header">{{ success.title || '' }}</div>
          <p>{{ success.content || '' }}</p>
        </div>
        <div class="ui floating negative message" :class="{ hidden: !error.title }">
          <i class="close icon"></i>
          <div class="header">{{ error.title || '' }}</div>
          <p>{{ error.content || '' }}</p>
        </div>
        <router-view class="view"></router-view>
      </div>
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
