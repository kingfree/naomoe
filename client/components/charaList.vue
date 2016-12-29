<template>
  <div id='chara-list'>
    <div>
      <md-input-container>
        <label>角色</label>
        <md-input v-model="newChara.name"></md-input>
      </md-input-container>
      <md-input-container>
        <label>作品</label>
        <md-input v-model="newChara.title"></md-input>
      </md-input-container>
      <md-button class="md-raised md-primary" @click='addChara'>{{ addButton }}</md-button>
    </div>
    <md-list>
      <md-list-item v-for="(chara, index) in characters">
        <md-button class="md-icon-button md-raised md-list-action" @click="editChara(chara)">
          <i class="fa fa-edit"></i>
        </md-button>
        {{ chara.name }}@{{ chara.title }}
        <md-button class="md-icon-button md-primary md-raised md-list-action" @click="removeChara(chara)">
          <i class="fa fa-remove"></i>
        </md-button>
      </md-list-item>
    </md-list>
  </div>
</template>

<script>
export default {
  name: 'chara-list',
  data() {
    return {
      maxId: 3,
      addButton: '添加',
      newChara: {id: null, name: '', title: ''},
      characters: [
        {id: 1, name: '中川花音', title: '只有神知道的世界'},
        {id: 2, name: '新子憧', title: '天才麻将少女'}
      ]
    }
  },
  methods: {
    addChara: function() {
      if (this.newChara.name && this.newChara.title) {
        if (!this.newChara.id) {
          this.newChara.id = this.maxId++
          this.characters.push(this.newChara)
        }
        this.newChara = {id: null, name: '', title: ''}
        this.addButton = '添加'
      }
    },
    editChara: function(chara) {
      this.newChara = chara
      this.addButton = '修改'
    },
    removeChara: function(chara) {
      this.characters.splice(this.characters.indexOf(chara), 1)
    }
  }
}

</script>

<style scoped>
    #chara-list {
      margin: 20px;
    }

</style>
