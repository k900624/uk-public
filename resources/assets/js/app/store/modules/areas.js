import axios from 'axios'
import route from '@app/route'

const state = {
	area: {},
	countAreaRequest: 0
};

const getters = {
	AREA(state) {
		return state.area
	}
};

const mutations = {
	SET_AREA: (state , area) => {
		state.area = area.data;
	},
	INCREMENT_AREA_COUNT_REQUEST: (state) => {
		state.countAreaRequest++;
	},
};

const actions = {
	async getArea({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.area.show'))
			.then((response) => {
				commit('SET_AREA', response);
				return response;
			})
			.catch((e) => {
				if (state.countAreaRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getArea')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_AREA_COUNT_REQUEST');
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
