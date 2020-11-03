require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './components/App';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

import store from './store';


// Views
    import home from './components/views/home.vue';
    import category from './components/views/category.vue';
    import story from './components/views/story.vue';
    import storyCreate from './components/views/storyCreate.vue';
    import storyEdit from './components/views/storyEdit.vue';

    import RegisterUser from './components/views/register.vue';
    import LoginUser from './components/views/login.vue';

    import ProfileUser from './components/views/profile.vue';
    


const routes = [
    { path: '/home', name: 'Home', component: home },
    { path: '/category', name: 'Category', component: category },

    { path: '/story', name: 'Story', component: story },
    { path: '/story/create', name: 'StoryCreate', component: storyCreate },
    { path: '/story/edit/:id', name: 'StoryEdit', component: storyEdit },

    { path: '/register', name: 'Register', component: RegisterUser },
    { path: '/login', name: 'Login', component: LoginUser, meta: { checkLogin: true} },

    { path: '/profile', name: 'Profile', component: ProfileUser, meta: { requiresAuth: true} },

    
];

//router nằm phía dưới
const router = new VueRouter({
    mode: 'history',
    routes: routes
    // redirect: {
    //     '*' : '/'
    // }   
});

// router.beforeEach((to, from, next) => {
//     if (to.meta.requiresAuth) {
//       const authUser = JSON.parse(window.localStorage.getItem('authUser'))
//       if (!(authUser && authUser.access_token )) {
//         next({ name: 'Login' })
//       }
//     }
//     next()
// })

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
      const authUser = window.localStorage.getItem('token_user');
      if (!authUser) {
        next({ name: 'Login' })
      }
    }
    next()
}) //nếu chưa login thì khi vào url profile sẽ đẩy sang login

router.beforeEach((to, from, next) => {
    if (to.meta.checkLogin) {
      const check_login = window.localStorage.getItem('token_user');
      if (check_login) {
        next({ name: 'Profile' })
      }
    }
    next()
}) //nếu login rồi thì khi vào url login lại sẽ đẩy sang profile

Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

var vm = new Vue({
    el: '#app',
    router: router,
    store,
    render: h => h(App)
})

// new Vue(Vue.util.extend({router}, App)).$mount('#app');

// new Vue({
//     router,
//     store,
//     render: h => h(App)
//   }).$mount('#app')