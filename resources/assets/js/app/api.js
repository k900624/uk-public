
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('@/bootstrap');

import Vue from 'vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from '@app/router';
import store from '@app/store';
import momentFilter from '@app/filters/moment.filter'
import Vuelidate from 'vuelidate'
import Notifications from 'vue-notification'

import App from '@app/App.vue';
import '~/app/modules/articles.sass'

// use lodash
import _ from 'lodash';
Vue.prototype.trans = (string, args) => {
	let value = _.get(window.i18n, string);

	_.eachRight(args, (paramVal, paramKey) => {
		value = _replace(value, `:$(paramKey)`, paramVal);
	});
	return value;
};

// usage: created | moment 'DD MMMM YYYY'
Vue.filter('moment', momentFilter)

Vue.use(Vuelidate)
Vue.use(Notifications)

window.axios = require('axios');
window.axios.defaults.headers.common = {
	'Authorization': 'Bearer ' + $apiToken
};

// load all components
import '@components'

new Vue({
	router,
	store,
	components: {App}
}).$mount('#app')
