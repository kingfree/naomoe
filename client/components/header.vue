<template>
  <div id="header-component" class="app-viewport">
    <div class="ui top pink inverted fixed menu">
      <router-link class="item" to="/home">
        <img src="../assets/logo.png" class="icon" style="width: 24px; height: 24px;">
      </router-link>
      <div class="labeled icon menu">
        <router-link class="item" to="/vote"><i class="gamepad icon"></i>投票</router-link>
        <router-link class="item" to="/schedule"><i class="calendar icon"></i>赛程</router-link>
        <router-link class="item" to="/discuss"><i class="comments icon"></i>讨论</router-link>
        <router-link class="item" to="/stock"><i class="payment icon"></i>闹股</router-link>
      </div>
      <div v-if="admin" class="right menu">
        <router-link class="item" to="/character"><i class="users icon"></i>角色</router-link>
        <router-link class="item" to="/competition"><i class="law icon"></i>比赛</router-link>
        <router-link class="item" to="/admin"><i class="desktop icon"></i>后台</router-link>
        <router-link class="item" to="/logout"><i class="sign out icon"></i>退出</router-link>
      </div>
      <div v-else class="right menu">
        <router-link class="item" to="/login"><i class="sign in icon"></i>登录</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'header-component',
  data() {
    return {
      msg: 'Tōyama Nao Saimoe Tournament'
    }
  },
  computed: {
    admin: function() {
      return true
    }
  },
  methods: {
  }
}

</script>

<style scoped>
.fa {
  display: inherit;
}

.router-link-active {
  background: rgba(255, 255, 255, 0.15) !important;
}

a:hover {
  text-decoration: none;
}

</style>
