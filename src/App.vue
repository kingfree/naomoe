<template>

  <div id="app">
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
  }
}
</script>

<style>
</style>
