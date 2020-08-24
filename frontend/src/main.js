import Vue from 'vue'
import App from './App.vue'


import './assets/styles/index.css';

Vue.config.productionTip = false


import Question from '@/components/Question.vue'
Vue.component('question', Question);

import InputNumber from '@/components/inputs/number.vue'
Vue.component('input-number', InputNumber);

import InputCheckbox from '@/components/inputs/checkbox.vue'
Vue.component('input-checkbox', InputCheckbox);

new Vue({
  render: h => h(App),
}).$mount('#app')
