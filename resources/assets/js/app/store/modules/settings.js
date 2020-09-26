import axios from 'axios'
import route from '@app/route'
import Vue from 'vue'

const state = {
	settings: [],
	countSettingsRequest: 0
};

const getters = {
	SETTINGS(state) {
		let foo = {};
		state.settings.forEach(item => {
			foo[item.key] = item.value
		});
		return foo
	},
};

const mutations = {
	SET_SETTINGS: (state , settings) => {
		state.settings = settings.data.data;
	},
	SAVE_SETTINGS: (state, settings) => {
		state.settings = settings.data.data;
	},
	INCREMENT_SETTINGS_COUNT_REQUEST: (state) => {
		state.countSettingsRequest++;
	}
};

const actions = {
	async getSettings({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.settings.index'))
			.then((response) => {
				commit('SET_SETTINGS', response);
				return response;
			})
			.catch((e) => {
				commit('setError', e)
				if (state.countUserRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getSettings')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_SETTINGS_COUNT_REQUEST');
				}
				throw e
			});
	},

	async saveSettings({commit}, settingsData) {
		return await axios.post(route('api.settings.store'), {
				settings: settingsData
			})
			.then((response) => {
				Vue.notify({
					group: 'app',
					type: 'success',
					text: 'Успешно сохранено!'
				});
				commit('SAVE_SETTINGS', response);
			})
			.catch((e) => {
				if (e && e.response.status === 422) {
					let errors = e.response.data.errors || {};
					commit('setErrors', errors)
				}
			});
	},
};

export default {
	state,
	getters,
	mutations,
	actions
}
