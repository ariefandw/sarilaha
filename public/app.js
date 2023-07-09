// import { Counter } from './Counter.vue';
// import { BmiCalculator } from './bmi-calculator.js';
import { createApp } from 'vue'
import { createRouter, createWebHashHistory } from 'vue-router';

const routes = [
  { path: '/', component: { template: '<div><h2>Home Page</h2><p>Welcome to my Vue 3 app!</p></div>' } },
  { path: '/counter', component: Counter },
  { path: '/bmi-calculator', component: BmiCalculator }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

const app = createApp({})
app.use(router)
app.mount('#app')
