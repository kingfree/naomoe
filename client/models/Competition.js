import Group from './Group'

module.exports = function Comp() {
  return {
    id: null,
    title: '',
    uri: '',
    groups: [new Group()],
    startTime: null,
    endTime: null,
    visible: false,
    template: 'common',
    bio: ''
  }
}
