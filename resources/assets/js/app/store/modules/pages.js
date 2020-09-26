import axios from 'axios'
import route from '@app/route'

const state = {
	page: [],
	countPageRequest: 0,
};

const getters = {
	PAGE(state) {
		return state.page
	},
};

const mutations = {
	SET_PAGE: (state , page) => {
		state.page = page.data.data;
	},
	INCREMENT_PAGE_COUNT_REQUEST: (state) => {
		state.countPageRequest++;
	},
};

const actions = {
	async getPage({dispatch, commit, state, rootState}, alias) {
		return await axios.get(route('api.page.show', alias))
			.then((response) => {
				commit('SET_PAGE', response);
				return response;
			})
			.catch((e) => {
				if (state.countPageRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getPage')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_PAGE_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			})
	}
};

export default {
	state,
	getters,
	mutations,
	actions
}
