/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.Vue = require('vue').default;

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
Vue.component('like-component', require('./components/LikeComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


// echo code for broadcasting

window.Echo.private(`App.Models.User.${user_broadcast_id}`)
.notification((data)=>{
    alert(data.body);

    // show new notification without refresh
    $('#notification_list').prepend(` <tr>
    <td>

            <strong>
                <i class="fa fa-star" aria-hidden="true"></i>
            </strong>
        </td>
    <td><i class="${data.icon}"></i></td>
    <td>${data.title}</td>

    <td>${data.body}</td>
    {{-- <td><i class="fa fa-paperclip"></i></td> --}}
    <td> ${data.current_time}</td>
    <td> <a href="${data.url}? notify_id=${data.id}"><i class="fa fa-paperclip"></i></a></td>

  </tr>`)

// second increase the counter of alerts
let count=Number($('#new_notification').text());
count++;
$('#new_notification').text(count);

});
