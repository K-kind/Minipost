/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

(function() {
'use strict';

let del = document.getElementsByClassName('del');
let i;

for(i = 0; i < del.length; i++){
    del[i].addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('退会すると全データは削除されます。よろしいですか？')) {
            document.getElementById(`form-${this.dataset.id}`).submit();
        }
    })
}
})();

(function() {
'use strict';

let like = document.getElementsByClassName('like');
let i;

for(i = 0; i < like.length; i++){
    like[i].addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById(`form-${this.dataset.id}`).submit();
    })
}
})();
