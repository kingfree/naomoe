<template>
  <div id="character">
    <form class="ui form">
      <div class="field">
        <label>日文</label>
        <div class="two fields">
          <div class="field">
            <input type="text" name="name_j" placeholder="角色" v-model=nowChara.name_j>
          </div>
          <div class="field">
            <input type="text" name="title_j" placeholder="作品" v-model=nowChara.title_j>
          </div>
        </div>
      </div>
      <div class="field">
        <label>中文</label>
        <div class="two fields">
          <div class="field">
            <input type="text" name="name_c" placeholder="角色" v-model=nowChara.name_c>
          </div>
          <div class="field">
            <input type="text" name="title_c" placeholder="作品" v-model=nowChara.title_c>
          </div>
        </div>
      </div>
      <div class="field">
        <label>英文</label>
        <div class="two fields">
          <div class="field">
            <input type="text" name="name_e" placeholder="角色" v-model=nowChara.name_e>
          </div>
          <div class="field">
            <input type="text" name="title_e" placeholder="作品" v-model=nowChara.title_e>
          </div>
        </div>
      </div>
      <button class="ui green button" @click="addChara">{{ addButton }}</button>
    </form>
    <table class="ui celled striped table">
      <thead>
      <tr>
        <th>ID</th>
        <th>头像</th>
        <th>中文</th>
        <th>日文</th>
        <th>英文</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="chara in characters">
        <td>{{ chara.id }}</td>
        <td>

        </td>
        <td>
          <h4 class="ui image header chinese">
            <div class="content">
              {{ chara.name_c }}
              <div class="sub header">{{ chara.title_c }}
              </div>
            </div>
          </h4>
        </td>
        <td>
          <h4 class="ui image header japanese">
            <div class="content">
              {{ chara.name_j }}
              <div class="sub header">{{ chara.title_j }}
              </div>
            </div>
          </h4>
        </td>
        <td>
          <h4 class="ui image header english">
            <div class="content">
              {{ chara.name_e }}
              <div class="sub header">{{ chara.title_e }}
              </div>
            </div>
          </h4>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import $ from 'jquery'

export default {
  data() {
    return {
      addButton: '添加',
      nowChara: {
        id: null,
        name_c: '',
        title_c: '',
        name_j: '',
        title_j: '',
        name_e: '',
        title_e: ''
      },
      characters: []
    }
  },
  watch: {
    'nowChara.name_j': function(newName, oldName) {
      if (!this.nowChara.name_c || this.nowChara.name_c === oldName) {
        this.nowChara.name_c = newName
      }
      if (!this.nowChara.name_e || this.nowChara.name_e === oldName) {
        this.nowChara.name_e = newName
      }
    },
    'nowChara.title_j': function(newTitle, oldTitle) {
      if (!this.nowChara.title_c || this.nowChara.title_c === oldTitle) {
        this.nowChara.title_c = newTitle
      }
      if (!this.nowChara.title_e || this.nowChara.title_e === oldTitle) {
        this.nowChara.title_e = newTitle
      }
    }
  },
  created: function() {
    this.loadCharacterList()
  },
  methods: {
    addChara: function() {
      let self = this
      $.post('/character/add', self.nowChara, function(data) {
        self.characters.push(data)
      }).fail(function() {
        console.error('error')
      })
      return false
    },
    loadCharacterList: function() {
      let self = this
      $.get('/character/list', function(data) {
        self.characters = data
      })
    }
  }
}

</script>
<style>
.chinese * {
  font-family: "Microsoft YaHei UI", "PingFang SC";
}
.japanese * {
  font-family: "Meiryo UI", "Yu Gothc UI", "MS PGothic";
}
.english * {
  font-family: "Seqoe UI", Helvetica;
}

</style>