import VueRouter from 'vue-router';
import VeeValidate from 'vee-validate';
import swal from 'sweetalert';

//qr stuff
import Vue from 'vue';
import VueQRCodeComponent from 'vue-qrcode-component';
Vue.component('qr-code', VueQRCodeComponent);
Vue.component('swal', swal);
//



import HeadRoutes from './components/head/Router'
import AdminRoutes from './components/admin/Router'
import TeacherRoutes from './components/teacher/Router'
import StudentRoutes from './components/student/Router'
import SuperAdminRoutes from './components/superAdmin/Router'

require('./bootstrap');


//window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(VeeValidate);

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// const about = require('./components/About.vue').default;
// //--------------Student Routing---------------
// const studentHome = require('./components/student/Home.vue').default;
// const routes =[
//     // {   path : '*', redirect: '/' },
//  //-------------Student Routing----------------
//      {   path : '/student', component : studentHome , meta : {authStudent : true} },
//  ];


var allRoutes = [];
allRoutes = allRoutes.concat(StudentRoutes, TeacherRoutes, AdminRoutes, HeadRoutes, SuperAdminRoutes);

const routes = allRoutes;

const router = new VueRouter({
    //mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    if(to.meta.authStudent){
        const user = window.localStorage.getItem('user');
        console.log(user);
        if (user == 'student' ){
            console.log("here");
            next();
        }else {
            console.log("here2");
            next(from);
        }
    }else if(to.meta.authTeacher){
        const user = window.localStorage.getItem('user');
        console.log(user);
        if (user == 'teacher' ){
            console.log("here");
            next();
        }else {
            console.log("here2");
            next(from);
        }
    }else if(to.meta.authSA){
        const user = window.localStorage.getItem('user');
        console.log(user);
        if (user == 'superAdmin' ){
            console.log("here");
            next();
        }else {
            console.log("here2");
            next(from);
        }
    }else if(to.meta.authHead){
        const user = window.localStorage.getItem('user');
        console.log(user);
        if (user == 'head' ){
            console.log("here");
            next();
        }else {
            console.log("here2");
            next(from);
        }
    }else if(to.meta.authAdmin){
        const user = window.localStorage.getItem('user');
        console.log(user);
        if (user == 'admin' ){
            console.log("here");
            next();
        }else {
            console.log("here2");
            next(from);
        }
    }else{
        next();
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
