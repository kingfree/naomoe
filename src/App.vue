<template>
  <div id="app">
    <my-header></my-header>
    <chara-list></chara-list>
  </div>
</template>

<script>
import MyHeader from './components/MyHeader'
import CharaList from './components/CharaList'

export default {
  name: 'app',
  components: {
    MyHeader,
    CharaList
  }
}
</script>

<style>
</style>
