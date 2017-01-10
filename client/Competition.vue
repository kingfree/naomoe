<template>
  <div id="competition">
    <table class="ui celled striped table">
      <thead>
      <tr>
        <th>URI</th>
        <th>比赛</th>
        <th>角色列表</th>
        <th>比赛时间</th>
        <th>
          <button class="ui labeled icon blue button" @click="openModal">
            <i class="add icon"></i>
            添加比赛
          </button>
        </th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(comp, index) in competitions" :key="comp.id">
        <td><code>/{{ comp.uri }}</code></td>
        <td>{{ comp.title }}</td>
        <td>
          <div class="ui horizontal list">
            <div class="item" v-for="group in comp.groups">
              <div class="content">
                <div class="header">{{ group.title }}</div>
                {{ group.choice }}/{{ group.characters.length }}
                <div class="ui list">
                  <div class="item" v-for="chara in group.characters">
                    <div class="content">
                      <img class="ui avatar image" :src="chara.image">
                      <div class="content">
                        <div class="header">{{ chara.name }}</div>
                        {{ chara.title }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </td>
        <td>
          {{ format(comp.startTime) }} --<br>
          {{ format(comp.endTime) }}
        </td>
        <td>
          <button class="ui icon green button"
                  @click="openModal(comp)"><i class="edit icon"></i></button>
          <button class="ui icon red button"
                  @click="delComp(comp, index)"><i class="delete icon"></i></button>
        </td>
      </tr>
      </tbody>
    </table>

    <competition-modal :characters="characters" :modal="nowComp" :show="showCompModal" @save="save">
    </competition-modal>

    <div class="ui small modal" id="errorModal">
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

    <div class="ui small modal" id="delModal">
      <div class="ui icon header">
        <i class="archive icon"></i>
        确定删除比赛 {{ selectComp.title || '' }} ？
      </div>
      <div class="content">
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

  </div>
</template>

<script>
import $ from 'jquery'
import _ from 'lodash'
import moment from 'moment'
import uuid from 'uuid'
import CompetitionModal from './components/compModal'
import Comp from './models/Competition'

function Chara() {
  return {
    id: null,
    name: '',
    title: '',
    image: '',
    bio: ''
  }
}

export default {
  data() {
    return {
      message: {
        type: null,
        title: null,
        text: null
      },
      nowComp: new Comp(),
      selectComp: {},
      showCompModal: false,
      competitions: [],
      characters: [],
      nowCharaIndex: null,
      nowGroupIndex: null
    }
  },
  created: function() {
    this.loadCompetitionList()
  },
  methods: {
    format: function(time, fmt) {
      return moment(time).format(fmt || 'MM-DD hh:mm')
    },
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
    loadCompetitionList: function() {
      this.competitions = [
        {
          id: 1,
          title: '本战二回战第一天',
          uri: 't2-1',
          groups: [
            {
              title: 'A组',
              choice: 1,
              characters: [
                {id: 3, name: '新子憧', title: '天才麻将少女', image: 'http://ww1.sinaimg.cn/mw690/6a446ed3jw1fbemjct2ddj20dm0dwwgw.jpg', vote: 0},
                {id: 23, name: '中川花音', title: '只有神知道的世界', image: 'http://ww4.sinaimg.cn/mw690/6a446ed3jw1fbemhn2y4dj207v07vaag.jpg', vote: 0}
              ],
              people: 0,
              vote: 0
            }
          ],
          startTime: new Date(2017, 1, 5, 0, 0, 0),
          endTime: new Date(2017, 1, 5, 23, 0, 0),
          people: 0,
          vote: 0,
          visible: true,
          template: 'common'
        }
      ]
      let self = this
      $.get('/character/list', function(res) {
        if (res.code === 0) {
          self.characters = res.data || []
        }
      })
    },
    openModal: function(comp) {
      this.cleanError()
      if (comp && comp.id) {
        this.nowComp = comp
      } else {
        this.nowComp = new Comp()
      }
      this.showCompModal = !this.showCompModal
    },
    save: function(comp) {
      console.log(comp)
    },
    addComp: function() {
      let self = this
      if (this.nowComp.id) {
        this.editComp(this.nowComp)
      } else {
        $.post('/competition/add', this.nowComp, function(res) {
          if (res.code === 0) {
            self.competitions.push(res.data)
            self.closeModal()
          } else {
            self.showError('添加比赛失败', res.info)
          }
        }).fail(function(e) {
          self.showError('添加比赛失败', e.message)
        })
      }
    },
    editChara: function(chara) {},
    editComp: function(comp) {
      let self = this
      $.post('/competition/edit', this.nowComp, function(res) {
        if (res.code === 0) {
          let index = _.findIndex(self.competitions, 'id', comp.id)
          if (isFinite(index) && index >= 0) {
            self.competitions.splice(index, 1, res.data)
          }
          self.closeModal()
        } else {
          self.showError('修改比赛失败', res.info)
        }
      }).fail(function(e) {
        self.showError('修改比赛失败', e.message)
      })
    },
    delComp: function(comp, index) {
      let self = this
      this.nowComp = comp
      $('#delModal').modal({
        onApprove: function() {
          $.post('/competition/del', comp, function(res) {
            if (res.code === 0) {
              self.competitions.splice(index, 1)
              self.selectComp = {}
            } else {
              self.alertError('删除比赛失败', res.info)
            }
          }).fail(function(e) {
            self.alertError('删除比赛失败', e.message)
          })
        }
      }).modal('show')
    }
  },
  components: {
    'competition-modal': CompetitionModal
  }
}

</script>
<style>
</style>