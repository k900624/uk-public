import axios from 'axios'
import route from '@app/route'
import router from '@app/router'
import Vue from 'vue'

const state = {
	user: {},
	countUserRequest: 0
};

const getters = {
	USER(state) {
		return state.user
	},
	getId(state) {
		return state.user.id
	},
};

const mutations = {
	SET_USER: (state , user) => {
		state.user = user.data.data;
	},
	SET_USER_PROFILE: (state , user) => {
		state.user.profile = user.data.profile;
	},
	SAVE_USER: (state, user) => {
	  state.user = user.data.data;
	},
	INCREMENT_USER_COUNT_REQUEST: (state) => {
		state.countUserRequest++;
	}
};

const actions = {
	async getUser({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.user.show'), {
				params: {
					profile: true
				}
			})
			.then((response) => {
				commit('SET_USER', response);
				commit('SET_USER_PROFILE', response);
				// return response;
			})
			.catch((e) => {
				if (state.countUserRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getUser')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_USER_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			});
	},

	async saveUser({commit}, userData) {
		return axios.post(route('api.user.store'), {
				user: userData
			})
			.then((response) => {
				if (response.status == 200) {
					router.push({name: 'personal'});
					commit('SAVE_USER', response);
					Vue.notify({
						group: 'app',
						type: 'success',
						text: 'Успешно сохранено!'
					});
				}
			})
			.catch((error) => {
				if (error && error.response.status === 422) {
					let errors = error.response.data.errors || {};
					commit('setErrors', errors);
				}
				// return userData;
			});
	},
};

export default {
	state,
	getters,
	mutations,
	actions
}
