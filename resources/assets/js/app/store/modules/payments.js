import axios from 'axios'
import route from '@app/route'

const state = {
	payments: [],
	lastPayment: {},
	monthPayment: {},
	balance: {},
	countBalanceRequest: 0
};

const getters = {
	PAYMENTS(state) {
		// return state.payments
		return state.payments.sort((a, b) => a.created_by > b.created_by ? 1 : -1);
	},
	LAST_PAYMENT(state) {
		return state.lastPayment
	},
	MONTH_PAYMENT(state) {
		return state.monthPayment
	},
	BALANCE(state) {
		return state.balance
	},
};

const mutations = {
	SET_PAYMENTS: (state , payments) => {
		state.payments = payments.data.data;
	},
	SET_LAST_PAYMENT: (state , lastPayment) => {
		state.lastPayment = lastPayment.data.data;
	},
	SET_MONTH_PAYMENT: (state , monthPayment) => {
		state.monthPayment = monthPayment.data.data;
	},
	SET_BALANCE: (state , balance) => {
		state.balance = balance.data;
	},
	INCREMENT_BALANCE_COUNT_REQUEST: (state) => {
		state.countBalanceRequest++;
	},
};

const actions = {
	async getPayments({dispatch, commit, state, rootState}, period) {
		return await axios.get(route('api.payments.get_payments'), {
				params: {
					period: period
				}
			})
			.then((response) => {
				commit('SET_PAYMENTS', response);
				return response;
			})
			.catch((e) => {
				if (state.countBalanceRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getPayments')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_BALANCE_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			});
	},
	async getMonthPayment({dispatch, commit, state, rootState}, date) {
		return await axios.get(route('api.payments.get_month_payments'), {
				params: {
					date: date
				}
			})
			.then((response) => {
				commit('SET_MONTH_PAYMENT', response);
				return response;
			})
			.catch((e) => {
				if (state.countBalanceRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getMonthPayment', date)
					}, rootState.maxRequestTiming);
					commit('INCREMENT_BALANCE_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			});
	},
	async getLastPayment({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.payments.get_last_payments'))
			.then((response) => {
				commit('SET_LAST_PAYMENT', response);
				return response;
			})
			.catch((e) => {
				if (state.countBalanceRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getLastPayment')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_BALANCE_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			});
	},
	async getBalance({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.payments.get_balance'))
			.then((response) => {
				commit('SET_BALANCE', response);
				return response;
			})
			.catch((e) => {
				if (state.countBalanceRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getBalance')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_BALANCE_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			});
	}
};

export default {
	state,
	getters,
	mutations,
	actions
}
