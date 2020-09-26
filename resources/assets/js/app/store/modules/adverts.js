import axios from 'axios'
import route from '@app/route'

const state = {
	advertsHome: [],
	adverts: [],
	pagination: {},
	countAdvertsRequest: 0
};

const getters = {
	ADVERTS_HOME(state) {
		return state.advertsHome
	},
	ADVERTS(state) {
		return state.adverts
	},
	ADVERTS_PAGINATION(state) {
		return state.pagination
	}
};

const mutations = {
	SET_ADVERTS_HOME: (state , adverts) => {
		state.advertsHome = adverts.data.data;
	},
	SET_ADVERTS: (state , adverts) => {
		state.adverts = adverts.data.data;
	},
	SET_ADVERTS_PAGINATION: (state, response) => {
		let pagination = {
			current_page: response.meta.current_page,
			last_page: response.meta.last_page,
			next_page_url: response.links.next,
			prev_page_url: response.links.prev
		};

		state.pagination = pagination;
	},
	INCREMENT_ADVERTS_COUNT_REQUEST: (state) => {
		state.countAdvertsRequest++;
	}
};

const actions = {
	async getAdvertsHome({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.adverts.home'))
			.then((response) => {
				commit('SET_ADVERTS_HOME', response);
			})
			.catch((e) => {
				if (state.countAdvertsRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getAdvertsHome')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_ADVERTS_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			});
	},
	async getAdverts({dispatch, commit, state, rootState}, page_url) {
		return await axios.get(page_url)
			.then((response) => {
				commit('SET_ADVERTS', response);
				commit('SET_ADVERTS_PAGINATION', response.data);
				// return response;
			})
			.catch((e) => {
				if (state.countAdvertsRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getAdvertsHome')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_ADVERTS_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
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
