import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import users from './modules/users'
import areas from './modules/areas'
import polls from './modules/polls'
import adverts from './modules/adverts'
import meters from './modules/meters'
import payments from './modules/payments'
import abuses from './modules/abuses'
import services from './modules/services'
import settings from './modules/settings'
import news from './modules/news'
import pages from './modules/pages'
import handbook from './modules/handbook'

import { setDocumentTitle } from '@app/helpers/general.helper'

export default new Vuex.Store({
	state: {
		error: null,
		errors: null,
		maxRequests: 3,
		maxRequestTiming: 2000,
	},
	mutations: {
		setError: (state, error) => {
			console.error(error)
			Vue.notify({
				group: 'server',
				type: 'error',
				duration: 6000,
				text: error
			})
			state.error = error
		},
		clearError: (state) => {
			state.error = null
		},
		setErrors: (state, errors) => {
			for (let key in errors) {
				Vue.notify({
					group: 'server',
					type: 'error',
					duration: 6000,
					text: errors[key][0]
				})
			}
			state.errors = errors
		},
		clearErrors: (state) => {
			state.errors = null
		},
		setDocumentTitle: (state, title) => {
			setDocumentTitle(title);
		}
	},
	getters: {
		ERROR: state => state.error,
		ERRORS: state => state.errors,
	},
	modules: {
		users,
		areas,
		polls,
		adverts,
		meters,
		payments,
		abuses,
		services,
		settings,
		news,
		pages,
		handbook,
	}
});
