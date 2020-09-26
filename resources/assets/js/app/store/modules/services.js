import axios from 'axios'
import route from '@app/route'
import Vue from 'vue'

const state = {
	services: [],
	serviceRequests: [],
	countServicesRequest: 0,
	countServicesRequestsRequest: 0,
};

const getters = {
	SERVICES(state) {
		return state.services
	},
	SERVICE_REQUESTS(state) {
		return state.serviceRequests
	},
};

const mutations = {
	SET_SERVICES: (state , services) => {
		state.services = services.data.data;
	},
	SET_SERVICE_REQUESTS(state, serviceRequests) {
		state.serviceRequests = serviceRequests.data.data;
	},
	SAVE_SERVICE_REQUESTS: (state, serviceRequest) => {
		// state.serviceRequests.push(serviceRequest.data.data);
		state.serviceRequests.unshift(serviceRequest.data.data);
	},
	INCREMENT_SERVICES_COUNT_REQUEST: (state) => {
		state.countServicesRequest++;
	},
	INCREMENT_SERVICES_COUNT_REQUESTS_REQUEST: (state) => {
		state.countServicesRequestsRequest++;
	},
};

const actions = {
	async getServices({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.services'))
			.then((response) => {
				commit('SET_SERVICES', response);
				return response;
			})
			.catch((e) => {
				if (state.countServicesRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getServices')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_SERVICES_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			})
	},
	async getServiceRequests({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.services.requests'))
			.then((response) => {
				commit('SET_SERVICE_REQUESTS', response);
				return response;
			})
			.catch((e) => {
				if (state.countServicesRequestsRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getServiceRequests')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_SERVICES_COUNT_REQUESTS_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			})
	},
	async saveRequestService({commit}, requestData) {
		return await axios.post(route('api.services.requests.store'), {
				requestText: requestData
			})
			.then(response => {
				if (response.data.status == 'error') {
					Vue.notify({
						group: 'app',
						type: 'error',
						text: response.data.message
					});
					return requestData;
				} else {
					Vue.notify({
						group: 'app',
						type: 'success',
						text: 'Успешно сохранено!'
					});
					commit('SAVE_SERVICE_REQUESTS', response);
					return null;
				}
			})
			.catch((error) => {
				if (error && error.response.status === 422) {
					let errors = error.response.data.errors || {};
					commit('setErrors', errors)
				}
				// return requestData;
			});
	},
};

export default {
	state,
	getters,
	mutations,
	actions
}
