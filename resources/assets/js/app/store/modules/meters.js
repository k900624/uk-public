import axios from 'axios'
import route from '@app/route'

const state = {
	meters: [],
	metersHistoryDataMeters: [],
	metersHistoryDataLabels: [],
	metersHistoryPeriod: 'year',
	countMetersRequest: 0,
	countMetersHistoryRequest: 0,
};

const getters = {
	METERS(state) {
		return state.meters
	},
	ALL_METERS(state) {
		return state.meters.all.sort((a, b) => a.created_by > b.created_by ? 1 : -1)
	},
	METERS_HISTORY_PERIOD(state) {
		return state.metersHistoryPeriod
	},
	CHART_DATA(state) {
		return [
			{
				label: 'Вода, м3',
				borderColor: 'rgba(50, 115, 220, 1)',
				backgroundColor: 'rgba(50, 115, 220, 1)',
				data: state.metersHistoryDataMeters.water,
				fill: false
			},
			{
				label: 'Электроэнергия, кВт.ч',
				borderColor: 'rgba(255, 56, 96, 1)',
				backgroundColor: 'rgba(255, 56, 96, 1)',
				data: state.metersHistoryDataMeters.electricity,
				fill: false
			},
			{
				label: 'Электроэнергия ночь, кВт.ч',
				borderColor: 'rgba(68, 68, 68, 1)',
				backgroundColor: 'rgba(68, 68, 68, 1)',
				data: state.metersHistoryDataMeters.electricity_night,
				fill: false

			}
		]
	},
	CHART_LABELS(state) {
		return state.metersHistoryDataLabels
	}
};

const mutations = {
	SET_METERS: (state, meters) => {
		state.meters = meters.data.data;
	},
	SET_METERS_HISTORY_DATA_METERS(state, meters) {
		state.metersHistoryDataMeters = meters;
	},
	SET_METERS_HISTORY_DATA_LABELS(state, labels) {
		state.metersHistoryDataLabels = labels;
	},
	SET_METERS_HISTORY_PERIOD(state, period) {
		state.metersHistoryPeriod = period;
	},
	INCREMENT_METERS_COUNT_REQUEST: (state) => {
		state.countMetersRequest++;
	},
	INCREMENT_METERS_HISTORY_COUNT_REQUEST: (state) => {
		state.countMetersHistoryRequest++;
	},
};

const actions = {
	async getMeters({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.meters_data.get_meters'))
			.then((response) => {
				commit('SET_METERS', response);
				return response;
			})
			.catch((e) => {
				if (state.countMetersRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getMeters')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_METERS_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			});
	},
	async getMetersHistory({dispatch, commit, state, rootState}, period) {
		return await axios.get(route('api.meters_data.get_meters_history'), {
				params: {
					period: period
				}
			})
			.then((response) => {
				commit('SET_METERS_HISTORY_DATA_METERS', response.data.data.meters);
				commit('SET_METERS_HISTORY_DATA_LABELS', response.data.data.labels);
				commit('SET_METERS_HISTORY_PERIOD', period);
				return response;
			})
			.catch((e) => {
				if (state.countMetersHistoryRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getMetersHistory', period)
					}, rootState.maxRequestTiming);
					commit('INCREMENT_METERS_HISTORY_COUNT_REQUEST');
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
