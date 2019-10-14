

require('./bootstrap');

//All Import here
import Vue from 'vue';
//router import
import VueRouter from 'vue-router';
//sweet alert 2 import
import Swal from 'sweetalert2';
//routes import from routes.js 
import {routes} from './routes';
//user helper import from helper folder
import User from './helpers/User';

//All window 

window.Swal = Swal
window.User = User


//All import use here
Vue.use(VueRouter)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);




//All imported constant here

//router
let router = new VueRouter({
	routes,
	mode:'history'
})
	

//Sweet alert
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
})
window.Toast = Toast

const app = new Vue({
    el: '#app',
    router
});
