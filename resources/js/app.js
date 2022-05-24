require('./bootstrap');

import {createApp} from 'vue';
import router from "./router";
import App from './components/App.vue';



createApp(App).use(router).mount("#treatment");

/*window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});*/
