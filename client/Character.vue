<template>
  <div id="character">
    <button class="ui btn" @click="loadCharacterList">刷新</button>
    <table class="ui very basic collapsing celled table">
      <thead>
      <tr><th>角色</th>
        <th>投票数</th>
      </tr></thead>
      <tbody>
      <tr v-for="chara in characters">
        <td>
          <h4 class="ui image header">
            <div class="content">
              {{ chara.name }}
              <div class="sub header">{{ chara.title }}
              </div>
            </div>
          </h4></td>
        <td>
          {{ chara.votes || 0 }}
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import api from './libs/api'

export default {
  data() {
    return {
      title: '角色',
      msg: 'Tōyama Nao Saimoe Tournament',
      characters: []
    }
  },
  methods: {
    loadCharacterList: function() {
      let $this = this
      api.get('/character/list')
        .then(function(response) {
          console.log(response.data)
          let body = response.data
          if (body.code === 0) {
            $this.characters = body.data
          }
        })
        .catch(function(error) {
          console.log(error)
        })
    }
  }
}

</script>
<style>
</style>