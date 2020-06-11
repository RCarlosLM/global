require('./bootstrap');

window.Vue = require('vue');

import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'

Vue.component('admin', require('./components/admin/Admin.vue').default);
Vue.component('activo-user', require('./components/admin/ActivoUser.vue').default);
Vue.component('cliente', require('./components/cliente/Cliente.vue').default);

import Snotify, { SnotifyPosition } from 'vue-snotify'
import VeeValidate, { Validator } from 'vee-validate';
import es from 'vee-validate/dist/locale/es';

const options = {
  toast: { position: SnotifyPosition.rightTop }
}

Vue.use(Snotify, options)
Vue.use(VeeValidate, { fieldsBagName: 'vvFields' });
Validator.localize('es', es);

const app = new Vue({
    el: '#app'
});
