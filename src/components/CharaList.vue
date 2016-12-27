<template>
  <div>
    <input v-model="newChara.name" placeholder="角色">
    <input v-model="newChara.title" placeholder="作品">
    <button v-on:click='addNewChara'>添加</button>
    <ul>
      <li v-for="(chara, index) in characters" v-bind:title="chara.name"
          v-on:remove="characters.splice(index, 1)">
        {{ chara.name }}@{{ chara.title }}
        <button v-on:click='$emit("remove")'>X</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'chara-list',
  data() {
    return {
      newChara: {id: null, name: '', title: ''},
      characters: [
        {id: 1, name: '中川花音', title: '只有神知道的世界'},
        {id: 2, name: '新子憧', title: '天才麻将少女'}
      ]
    }
  },
  methods: {
    addNewChara: function() {
      this.characters.push(this.newChara)
      this.newChara = {id: null, name: '', title: ''}
    }
  }
}

</script>

<style scoped>
</style>
