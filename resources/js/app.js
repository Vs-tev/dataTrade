/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Form from './Form'
window.Form= Form
import Portfolio from './components/portfolio/Portfolio'
import Rules from './components/rules/Rules'
import Strategies from './components/strategies/Strategies'
import Traderecord from './components/trades/Traderecord'



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


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if (document.querySelector('#VuePortfolio')) { // this line check if #VuePortfolio exist 
    const app = new Vue({
        el: '#VuePortfolio',
        components:{
            Portfolio,
        },
    });
}

if (document.querySelector('#VueRules')) {
    const rules = new Vue({
        el: '#VueRules',
        components:{
            Rules
        }
    })
}

if (document.querySelector('#VueStrategies')) {
    const strategies = new Vue({
        el: '#VueStrategies',
        components:{
            Strategies,
        }
    })
}

if (document.querySelector('#VueTradeRecord')) {
    const traderecord = new Vue({
        el: '#VueTradeRecord',
        components:{
            Traderecord,
        }
    })
}