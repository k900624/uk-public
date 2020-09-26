import axios from 'axios'
import route from '@app/route'
import Vue from 'vue'

const state = {
	poll: {},
	polls: [],
	countPollsRequest: 0
};

const getters = {
	POLL(state) {
		return state.poll
	},
	POLLS(state) {
		return state.polls
	},
};

const mutations = {
	SET_POLL: (state , payload) => {
		state.poll = payload.data.data;
	},
	SET_POLLS: (state , payload) => {
		state.polls = payload.data.data;
	},
	INCREMENT_POLLS_COUNT_REQUEST: (state) => {
		state.countPollsRequest++;
	},
};

const actions = {
	async getPoll({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.polls.show'))
			.then((response) => {
				commit('SET_POLL', response);
				// return response;
			})
			.catch((e) => {
				if (state.countPollsRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getPoll')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_POLLS_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			});
	},
	async getPolls({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.polls'))
			.then((response) => {
				commit('SET_POLLS', response);
				// return response;
			})
			.catch((e) => {
				if (state.countPollsRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getPolls')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_POLLS_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			});
	},
	async savePoll({commit}, pollData) {
		return await axios.post(route('api.polls.store'), pollData)
			.then(response => {
				if (response.data.status == 'error') {
					Vue.notify({
						group: 'app',
						type: 'error',
						text: response.data.message
					});
				} else {
					event.target.reset();

					if (response.status == 200) {
						Vue.notify({
							group: 'app',
							type: 'success',
							text: 'Успешно сохранено!'
						});
					}
					// return response;
				}
			})
			.catch((error) => {
				if (error && error.response.status === 422) {
					let errors = error.response.data.errors || {};
					commit('setErrors', errors)
				}
				// return pollData;
			});
	}
};

export default {
	state,
	getters,
	mutations,
	actions
}
