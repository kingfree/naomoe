<template>

  <div id="app" class="ui github">
    <header-component/>
    <router-view class="view"></router-view>
  </div>

</template>

<script>
import HeaderComponent from './components/header'

export default {
  name: 'app',
  components: {
    HeaderComponent
  },
  methods: {
  }
}
</script>

<style>
* {
  font-family: "PingFang SC", Ubuntu, Tahoma, Arial, Helvetica, "Microsoft YaHei New", "Microsoft Yahei", "微软雅黑", STXihei, "华文细黑", "文泉驿微米黑", 宋体, SimSun, sans-serif;
}

.view {
  position: inherit;
  padding-top: 85px;
  padding-left: 15px;
  padding-right: 15px;
}
</style>
