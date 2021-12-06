/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const {toJSON} = require("lodash/seq");

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const counter = { counter: 1 };
let APP_LOG_LIFECYCLE_EVENTS = true;

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//Vue.component('user-info', require('./components/UserInfo.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    methods: {
        userDataChanged(user, token) {
            let fd = new FormData();
            fd.append('userData', JSON.stringify(user));
            fd.append('_token', token)
            $.ajax({
                url: "users/update",
                data: fd,
                type: "POST",
                processData: false,
                contentType: false,
                cash: true,
                success: function (response) {
                    console.log(response);
                },
                error: function (response) {
                    console.log('Failure');
                }
            })
        }
    },
    data() {
        return {
            depth: 3,
        }
    },

});
