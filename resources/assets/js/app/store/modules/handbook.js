import axios from 'axios'
import route from '@app/route'

const state = {
	handbook: [],
	handbookHome: [],
	handbookItem: {},
	pagination: {},
	countHandbookRequest: 0,
};

const getters = {
	HANDBOOK(state) {
		return state.handbook
	},
	HANDBOOK_HOME(state) {
		return state.handbookHome
	},
	HANDBOOK_ITEM(state) {
		return state.handbookItem
	},
	HANDBOOK_PAGINATION(state) {
		return state.pagination
	},
};

const mutations = {
	SET_HANDBOOK: (state , handbook) => {
		state.handbook = handbook.data.data;
	},
	SET_HANDBOOK_HOME: (state , handbook) => {
		state.handbookHome = handbook.data.data;
	},
	SET_HANDBOOK_ITEM: (state , handbookItem) => {
		state.handbookItem = handbookItem.data.data;
	},
	SET_HANDBOOK_PAGINATION: (state, response) => {
		let pagination = {
			current_page: response.meta.current_page,
			last_page: response.meta.last_page,
			next_page_url: response.links.next,
			prev_page_url: response.links.prev
		};

		state.pagination = pagination;
	},
	INCREMENT_HANDBOOK_COUNT_REQUEST: (state) => {
		state.countHandbookRequest++;
	},
};

const actions = {
	async getHandbookItem({dispatch, commit, state, rootState}, alias) {
		return await axios.get(route('api.handbook.show', alias))
			.then((response) => {
				commit('SET_HANDBOOK_ITEM', response);
				return response;
			})
			.catch((e) => {
				if (state.countHandbookRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getHandbookItem')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_HANDBOOK_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			});
	},
	async getHomeHandbook({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.handbook.home'))
			.then((response) => {
				commit('SET_HANDBOOK_HOME', response);
				return response;
			})
			.catch((e) => {
				if (state.countHandbookRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getHomeHandbook')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_HANDBOOK_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			})
	},
	async getHandbook({dispatch, commit, state, rootState}, page_url) {
		return await axios.get(page_url)
			.then((response) => {
				commit('SET_HANDBOOK', response);
				commit('SET_HANDBOOK_PAGINATION', response.data);
				return response;
			})
			.catch((e) => {
				if (state.countHandbookRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getHandbook')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_HANDBOOK_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			})
	},
};

export default {
	state,
	getters,
	mutations,
	actions
}
