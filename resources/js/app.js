require('./bootstrap');

window.Vue = require('vue');

import Sidebar    from './components/layout/Sidebar.vue';
import UserIndex  from './components/users/Index.vue';
import UserCreate from './components/users/Create.vue';
import UserEdit   from './components/users/Edit.vue';
import RoleIndex  from './components/roles/Index.vue';
import RoleCreate from './components/roles/Create.vue';
import RoleEdit   from './components/roles/Edit.vue';
import UsersCount from './components/dashboard/UsersCount.vue';
import RolesCount from './components/dashboard/RolesCount.vue';
import Profile    from './components/profile/Profile.vue';
import ProfilePassword from './components/profile/Password.vue';

// Dependencies --------------------------------------

import Toasted from 'vue-toasted';
import VueClip from 'vue-clip';
import Multiselect from 'vue-multiselect';
import swal from 'sweetalert';
import VueContentPlaceholders from 'vue-content-placeholders';

Vue.use(require('vue-moment'));
Vue.use(Toasted);
Vue.toasted.register('error', message => message, {
    position : 'bottom-center',
    duration : 1000
});
Vue.use(VueClip);
Vue.component('multiselect', Multiselect);
Vue.use(VueContentPlaceholders);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Layout
Vue.component('sidebar', Sidebar);

// Dashboard
Vue.component('users-count', UsersCount);
Vue.component('roles-count', RolesCount);

// Profile
Vue.component('profile', Profile);
Vue.component('profile-password', ProfilePassword);

// Users
Vue.component('users-index', UserIndex);
Vue.component('users-create', UserCreate);
Vue.component('users-edit', UserEdit);

// Roles
Vue.component('roles-index', RoleIndex);
Vue.component('roles-create', RoleCreate);
Vue.component('roles-edit', RoleEdit);

const app = new Vue({
    el: '#app'
});
