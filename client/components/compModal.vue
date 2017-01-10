<template>
  <div class="ui modal" id="compModal">
    <i class="close icon" @click="hide"></i>
    <div class="header">
      {{ comp.id ? '编辑比赛 ' + (comp.title || '') : '创建比赛' }}
    </div>
    <el-form class="ui content" ref="form" label-width="80px" novalidate>
      <el-form-item label="比赛名称">
        <el-input v-model="comp.title"></el-input>
      </el-form-item>
      <el-form-item label="比赛时间">
        <el-date-picker
                v-model="dateRange"
                :picker-options="datePickerOptions"
                type="datetimerange"
                placeholder="选择时间范围">
        </el-date-picker>
      </el-form-item>
      <el-form-item label="比赛阵容">
        <div>
          <div class="ui top attached tabular menu">
            <a v-for="(group, groupIndex) in groups" class="item"
               :class="{ active: groupIndex == nowGroupIndex }" @click="nowGroupIndex = groupIndex">
              {{ group.title }}
              <i class="small close icon" @click="delGroup(groupIndex)"></i>
            </a>
            <a class="item" @click="addGroup"><i class="plus icon"></i></a>
          </div>
          <div class="ui form bottom attached tab segment active">
            <div class="two fields">
              <div class="nine wide field">
                <label>分组名称</label>
                <input v-model="nowGroup.title"></input>
              </div>
              <div class="four wide field">
                <label>最多可选</label>
                <input v-model="nowGroup.choice" type="number" :min="0"
                       :max="nowGroup.characters.length"></input>
              </div>
            </div>
            <div class="two inline fields">
              <div class="eleven wide field">
                <select2 :options="characters" v-model="nowCharaID" style="width: 90%;">
                  <option disabled value="0"></option>
                </select2>
              </div>
              <div class="six wide field">
                <button class="ui green icon button" @click="addChara">
                  <i class="plus icon"></i>
                  {{ nowChara.name }}
                </button>
              </div>
            </div>
            <div class="ui middle aligned divided list">
              <div v-for="(chara, charaGroupIndex) in nowGroup.characters" class="item">
                <div class="right floated content">
                  <button class="ui icon circular button"
                          @click="delChara(charaGroupIndex)">
                    <i class="remove icon"></i></button>
                </div>
                <img class="ui avatar image" :src="chara.image">
                <div class="content">
                  <div class="header">{{ chara.name }}</div>
                  {{ chara.title }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </el-form-item>
      <el-form-item label="活动形式">
        <el-input type="textarea" v-model="comp.bio"></el-input>
      </el-form-item>
    </el-form>
    <div class="actions">
      <button class="ui cancel button" @click="hide">取消</button>
      <button class="ui submit button" :class="{ blue: !comp.id, green: comp.id }"
              @click="save">{{ comp.id ? '修改' : '创建' }}
      </button>
    </div>
  </div>
</template>
<style>
</style>
<script>
import $ from 'jquery'
import _ from 'lodash'
import moment from 'moment'
import uuid from 'uuid'
import vSelect from 'vue-select'
import Group from '../models/Group'
import Comp from '../models/Competition'

function pickToRange(now, picker) {
  const start = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0, 0)
  const end = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 0)
  picker.$emit('pick', [start, end])
}

export default {
  components: {
    vSelect
  },
  props: {
    modal: {
      type: Object,
      default: new Comp()
    },
    characters: {
      type: Array,
      default: []
    },
    show: {
      type: Boolean,
      default: false
    }
  },
  watch: {
    modal: function(value) {
      console.log(JSON.stringify(value))
      this.comp = value || new Comp()
      this.groups = value.groups
      this.nowGroupIndex = 0
      this.nowGroup = this.groups[this.nowGroupIndex]
      this.charaList = this.nowGroup.characters
      this.dateRange = [this.comp.startTime, this.comp.endTime]
    },
    show: function(value) {
      $(this.$el).modal('refresh').modal('toggle')
    },
    characters: function(value) {
      let self = this
      value.forEach(function(chara, index) {
        self.id2index[chara.id] = index
      })
    },
    nowGroupIndex: function(value) {
      this.nowGroup = this.comp.groups[value]
    },
    dateRange: function(value) {
      let [start, end] = value
      this.comp.startTime = start
      this.comp.endTime = end
    }
  },
  data() {
    return {
      datePickerOptions: {
        shortcuts: [{
          text: '今天',
          onClick(picker) {
            const now = new Date()
            now.setTime(now.getTime() + 3600 * 1000 * 24 * 0)
            pickToRange(now, picker)
          }
        }, {
          text: '明天',
          onClick(picker) {
            const now = new Date()
            now.setTime(now.getTime() + 3600 * 1000 * 24 * 1)
            pickToRange(now, picker)
          }
        }, {
          text: '后天',
          onClick(picker) {
            const now = new Date()
            now.setTime(now.getTime() + 3600 * 1000 * 24 * 2)
            pickToRange(now, picker)
          }
        }]
      },
      id2index: {},
      nowCharaID: null,
      comp: this.modal,
      groups: [],
      nowGroupIndex: 0,
      nowGroup: new Group(),
      charaList: [],
      dateRange: ''
    }
  },
  computed: {
    nowChara() {
      return this.characters[this.id2index[this.nowCharaID]] || {}
    }
  },
  methods: {
    save() {
      this.$emit('save', this.comp)
      this.hide()
    },
    hide() {
      this.show = false
    },
    addChara() {
      if (this.nowChara.id) {
        this.charaList.push(this.nowChara)
      }
    },
    delChara(index) {
      if (this.charaList[index]) {
        this.charaList.splice(index, 1)
      }
    },
    addGroup() {
      let group = new Group()
      group.title = '分组' + (this.groups.length + 1)
      this.groups.push(group)
    },
    delGroup(index) {
      if (this.groups[index]) {
        this.groups.splice(index, 1)
      }
    }
  }
}

</script>
