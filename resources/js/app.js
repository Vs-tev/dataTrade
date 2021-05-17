/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Form from './Form'
window.Form = Form


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app-portfolio', require('./components/portfolio/Portfolio.vue').default);
Vue.component('app-rules', require('./components/rules/Rules.vue').default);
Vue.component('app-strategies', require('./components/strategies/Strategies.vue').default);
Vue.component('app-traderecord', require('./components/trades/Traderecord.vue').default);
Vue.component('app-navbar', require('./components/navbar/Navbar.vue').default);
Vue.component('app-traderecord-chart-table', require('./components/trades/TraderecordChartTable.vue').default);
Vue.component('app-traderecord-history', require('./components/trades/tradeHistory/TradeHistory.vue').default);
Vue.component('register-first_portfolio', require('./components/portfolio/RegisterFIrstPortfolio.vue').default);
Vue.component('app-plans', require('./components/plans/Plans.vue').default);
Vue.component('user-settings', require('./components/user/UserSettings.vue').default);
Vue.component('app-trade-analysis', require('./components/trade_analysis/TradeAnalysis.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if (document.querySelector('#app')) {
    const app = new Vue({
        el: '#app',
    });
}

if (document.querySelector('#register')) {
    const register = new Vue({
        el: '#register',
    });
}



