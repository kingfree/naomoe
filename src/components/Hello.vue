<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <h2>前台</h2>
    <ul>
      <li><a href="/" target="_blank">投票</a></li>
      <li><a href="/" target="_blank">赛程</a></li>
      <li><a href="/" target="_blank">讨论</a></li>
    </ul>
    <h2>后台</h2>
    <ul>
      <li><a href="/" target="_blank">添加角色</a></li>
      <li><a href="/" target="_blank">角色列表</a></li>
      <li><a href="/" target="_blank">创建比赛</a></li>
      <li><a href="/" target="_blank">比赛管理</a></li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
      msg: 'Tōyama Nao Saimoe Tournament'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
