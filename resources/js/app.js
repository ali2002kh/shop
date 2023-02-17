require('./bootstrap')
import * as Vue from 'vue'
import Index from './Index'
import router from './routes'

const app = Vue.createApp({})

app.component('index', Index)

app.use(router).mount('#app')

