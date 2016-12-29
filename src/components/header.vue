<template>
  <div id="header-component" class="app-viewport">
    <md-toolbar>

      <md-button class="md-icon-button" @click="$refs.sidenav.toggle()">
        <img src="../assets/logo.png"/>
      </md-button>

      <h2 class="md-title" style="flex: 1">闹萌</h2>

      <md-button>投票</md-button>
      <md-button>赛程</md-button>
      <md-button>讨论</md-button>

    </md-toolbar>

    <md-sidenav class="md-left" ref="sidenav">

      <md-toolbar class="md-account-header">
        <md-list class="md-transparent">
          <md-list-item class="md-avatar-list">
            <md-avatar class="md-large">
              <img src="http://en.gravatar.com/userimage/22768784/e0fe7c7b56f2bcc90a19b13432a07c0e.png" alt="People">
            </md-avatar>

            <span style="flex: 1"></span>

          </md-list-item>

          <md-list-item>
            <div class="md-list-text-container">
              <span>咲衣憧</span>
              <span>weibo.com/kingfree</span>
            </div>

            <md-button class="md-icon-button md-list-action">
              <md-icon class="fa fa-angle-down"></md-icon>
            </md-button>
          </md-list-item>
        </md-list>
      </md-toolbar>

      <md-list>
        <md-list-item @click="$refs.sidenav.toggle()">
          <md-icon class="fa fa-user-plus"></md-icon>
          <span>添加角色</span>
        </md-list-item>
        <md-list-item @click="$refs.sidenav.toggle()">
          <md-icon class="fa fa-users"></md-icon>
          <span>角色列表</span>
        </md-list-item>
        <md-list-item @click="$refs.sidenav.toggle()">
          <md-icon class="fa fa-address-card"></md-icon>
          <span>创建比赛</span>
        </md-list-item>
        <md-list-item @click="$refs.sidenav.toggle()">
          <md-icon class="fa fa-address-book"></md-icon>
          <span>比赛管理</span>
        </md-list-item>
        <md-list-item @click="$router.push('about')">
          <md-icon class="fa fa-info"></md-icon>
          <span>关于闹萌</span>
        </md-list-item>
      </md-list>

    </md-sidenav>
  </div>
</template>

<script>
export default {
  name: 'header-component',
  data() {
    return {
      msg: 'Tōyama Nao Saimoe Tournament'
    }
  }
}

</script>

<style scoped>
.fa {
  display: inherit;
}

</style>
