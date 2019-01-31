
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import store from './store/index.js';

import Element from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'

Vue.use(Element, {locale});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('notification', require('./components/modules/Notification').default);

Vue.component('user-list', require('./components/management/user/List').default);
Vue.component('user-create', require('./components/management/user/FormCreate').default);
Vue.component('user-edit', require('./components/management/user/FormEdit').default);

Vue.component('modal-confirm', require('./components/modules/modals/ModalConfirm').default);
Vue.component('modal-confirm-delete', require('./components/modules/modals/ModalConfirmDelete').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
