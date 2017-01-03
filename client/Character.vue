<template>
  <div id="character">

    <div class="ui small hidden modal" id="errorModal">
      <div class="ui attached message"
           :class="{ negative: message.type === 'error',
                     positive: message.type === 'success',
                     hidden: !message.title }">
        <i class="close icon" @click="cleanError"></i>
        <div class="header">
          {{ message.title || '错误' }}
        </div>
        <p>{{ message.text || '' }}</p>
      </div>
    </div>

    <div class="ui small hidden modal" id="delModal">
      <div class="ui icon header">
        <i class="archive icon"></i>
        确定删除角色 {{ nowChara.name || '' }} ？
      </div>
      <div class="content">
        <p>{{ nowChara.name }}@{{ nowChara.title }}</p>
        <p>删除操作不可恢复，确定删除？</p>
      </div>
      <div class="actions">
        <button class="ui cancel button">
          <i class="close icon"></i>
          取消
        </button>
        <button class="ui red ok button">
          <i class="checkmark icon"></i>
          删除
        </button>
      </div>
    </div>

    <div class="ui hidden modal" id="charaModel">
      <div class="header">
        {{ nowChara.id ? '编辑角色 ' + (nowChara.name || '') : '创建角色' }}
      </div>
      <form class="ui form content">
        <div class="field" v-for="input in inputs">
          <label>{{ input.label }}</label>
          <div class="two fields">
            <div class="six wide field">
              <input type="text" placeholder="角色" v-model=nowChara[input.name]>
            </div>
            <div class="seven wide field">
              <input type="text" placeholder="作品" v-model=nowChara[input.title]>
            </div>
          </div>
        </div>
        <div class="field">
          <label>简介</label>
          <textarea rows=3 v-model=nowChara.bio></textarea>
        </div>
      </form>
      <div class="ui attached message"
           :class="{ negative: message.type === 'error',
                     positive: message.type === 'success',
                     hidden: !message.title }">
        <i class="close icon" @click="cleanError"></i>
        <div class="header">
          {{ message.title || '错误' }}
        </div>
        <p>{{ message.text || '' }}</p>
      </div>
      <div class="actions">
        <button class="ui button" @click="closeModal">取消</button>
        <button class="ui button" :class="{ blue: !nowChara.id, green: nowChara.id }"
                @click="addChara">{{ nowChara.id ? '修改' : '创建' }}
        </button>
      </div>
    </div>

    <table class="ui celled striped table">
      <thead>
      <tr>
        <th>ID</th>
        <th>中文</th>
        <th>日文</th>
        <th>英文</th>
        <th>简介</th>
        <th>
          <button class="ui labeled icon blue button" @click="openModal">
            <i class="add icon"></i>
            添加角色
          </button>
        </th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(chara, index) in characters" :key="chara.id">
        <td>{{ chara.id }}</td>
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
        <td>
          {{ chara.bio }}
        </td>
        <td>
          <button class="ui icon green button" @click="openModal(chara)"><i class="edit icon"></i></button>
          <button class="ui icon red button" @click="delChara(chara, index)"><i class="delete icon"></i></button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import $ from 'jquery'
import _ from 'lodash'

const emptyChara = {
  id: null,
  name_c: '',
  title_c: '',
  name_j: '',
  title_j: '',
  name_e: '',
  title_e: ''
}

export default {
  props: ['error'],
  data() {
    return {
      message: {
        type: null,
        title: null,
        text: null
      },
      inputs: [
        {label: '日文', name: 'name_j', title: 'title_j'},
        {label: '中文', name: 'name_c', title: 'title_c'},
        {label: '英文', name: 'name_e', title: 'title_e'}
      ],
      nowChara: emptyChara,
      characters: []
    }
  },
  watch: {
    'nowChara.name_j': function(newName, oldName) {
      if (this.nowChara.id) return
      if (!this.nowChara.name_c || this.nowChara.name_c === oldName) {
        this.nowChara.name_c = newName
      }
      if (!this.nowChara.name_e || this.nowChara.name_e === oldName) {
        this.nowChara.name_e = newName
      }
    },
    'nowChara.title_j': function(newTitle, oldTitle) {
      if (this.nowChara.id) return
      if (!this.nowChara.title_c || this.nowChara.title_c === oldTitle) {
        this.nowChara.title_c = newTitle
      }
      if (!this.nowChara.title_e || this.nowChara.title_e === oldTitle) {
        this.nowChara.title_e = newTitle
      }
    }
  },
  created: function() {
    $('#charaModal').modal('show')
    this.loadCharacterList()
  },
  methods: {
    showError: function(title, text) {
      this.message.type = 'error'
      this.message.title = title
      this.message.text = text
    },
    alertError: function(title, text) {
      this.showError(title, text)
      $('#errorModal').modal('show')
    },
    cleanError: function() {
      this.message.title = null
      $('#errorModal').modal('hide')
    },
    addChara: function() {
      let self = this
      if (this.nowChara.id) {
        this.editChara(this.nowChara)
      } else {
        $.post('/character/add', this.nowChara, function(res) {
          if (res.code === 0) {
            self.characters.push(res.data)
            self.closeModal()
          } else {
            self.showError('添加角色失败', res.info)
          }
        }).fail(function(e) {
          self.showError('添加角色失败', e.message)
        })
      }
    },
    loadCharacterList: function() {
      let self = this
      $.get('/character/list', function(res) {
        if (res.code === 0) {
          self.characters = res.data || []
        }
      })
    },
    openModal: function(chara) {
      this.cleanError()
      if (chara && chara.id) {
        this.nowChara = chara
      } else {
        this.nowChara = emptyChara
      }
      $('#charaModel').modal('show')
    },
    closeModal: function() {
      $('#charaModel').modal('hide')
    },
    editChara: function(chara) {
      let self = this
      $.post('/character/edit', this.nowChara, function(res) {
        if (res.code === 0) {
          let index = _.findIndex(self.characters, 'id', chara.id)
          if (isFinite(index) && index >= 0) {
            self.characters.splice(index, 1, res.data)
          }
          self.closeModal()
        } else {
          self.showError('修改角色失败', res.info)
        }
      }).fail(function(e) {
        self.showError('修改角色失败', e.message)
      })
    },
    delChara: function(chara, index) {
      let self = this
      this.nowChara = chara
      $('#delModal').modal({
        onApprove: function() {
          $.post('/character/del', chara, function(res) {
            if (res.code === 0) {
              self.characters.splice(index, 1)
              self.nowChara = emptyChara
            } else {
              self.alertError('删除角色失败', res.info)
            }
          }).fail(function(e) {
            self.alertError('删除角色失败', e.message)
          })
        }
      }).modal('show')
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