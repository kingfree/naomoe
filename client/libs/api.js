import axios from 'axios'

let instance = axios.create({
  baseURL: '/',
  headers: {'X-Access-Token': 'kingfree'}
})

module.exports = instance
