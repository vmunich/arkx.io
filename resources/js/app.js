/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

import ToggleButton from 'vue-js-toggle-button'
Vue.use(ToggleButton)

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

import vueSlider from 'vue-slider-component'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('progressmeter', require('./components/ProgressMeter.vue'))
Vue.component('progressbar', require('./components/ProgressBar.vue'))
Vue.component('notification', require('./components/Notification.vue'))
Vue.component('profitcalculator', require('./components/ProfitCalculator.vue'))

import ChartTransaction from './charts/TransactionSidebar'
import ChartMetrics from './charts/Metrics'

const app = new Vue({
  components: {
    vueSlider,
    ChartTransaction,
    ChartMetrics
  },
  el: '#app',
  data() {
    return {
      value: 50,
      selected: 'Question 2',
      showMobileMenu: false
    }
  },
  methods: {
    toggleMenu () {
      this.showMobileMenu = !this.showMobileMenu
    }
  }
})
