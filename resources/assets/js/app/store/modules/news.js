import axios from 'axios'
import route from '@app/route'

const state = {
	news: [],
	categoryNews: [],
	categoryData: {},
	newsItem: {},
	pagination: {},
	countNewsRequest: 0,
	categories: [],
	countCategoriesRequest: 0,
};

const getters = {
	NEWS(state) {
		return state.news
	},
	CATEGORY_NEWS(state) {
		return state.categoryNews
	},
	NEWS_ITEM(state) {
		return state.newsItem
	},
	CATEGORY_DATA(state) {
		return state.categoryData
	},
	CATEGORIES(state) {
		return state.categories
	},
	NEWS_PAGINATION(state) {
		return state.pagination
	},
};

const mutations = {
	SET_NEWS: (state, news) => {
		state.news = news.data.data;
	},
	SET_CATEGORY_NEWS: (state, news) => {
		state.categoryNews = news.data.data;
	},
	SET_NEWS_ITEM: (state, newsItem) => {
		state.newsItem = newsItem.data.data;
	},
	SET_CATEGORY_DATA: (state, news) => {
		state.categoryData = news.data.relationships.category;
	},
	SET_CATEGORIES: (state, categories) => {
		state.categories = categories.data.data;
	},
	SET_NEWS_PAGINATION: (state, response) => {
		let pagination = {
			current_page: response.meta.current_page,
			last_page: response.meta.last_page,
			next_page_url: response.links.next,
			prev_page_url: response.links.prev
		};

		state.pagination = pagination;
	},
	INCREMENT_NEWS_COUNT_REQUEST: (state) => {
		state.countNewsRequest++;
	},
	INCREMENT_CATEGORIES_COUNT_REQUEST: (state) => {
		state.countCategoriesRequest++;
	},
};

const actions = {
	async getNewsItem({dispatch, commit, state, rootState}, alias) {
		return await axios.get(route('api.news.show', alias))
			.then((response) => {
				commit('SET_NEWS_ITEM', response);
				return response;
			})
			.catch((e) => {
				if (state.countNewsRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getNewsItem')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_NEWS_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			});
	},
	async getNews({dispatch, commit, state, rootState}, page_url) {
		return await axios.get(page_url)
			.then((response) => {
				commit('SET_NEWS', response);
				commit('SET_NEWS_PAGINATION', response.data);
				return response;
			})
			.catch((e) => {
				if (state.countNewsRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getNews')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_NEWS_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			})
	},
	async getCategoryData({dispatch, commit, state, rootState}, page_url) {
		return await axios.get(page_url)
			.then((response) => {
				commit('SET_CATEGORY_NEWS', response);
				commit('SET_CATEGORY_DATA', response);
				commit('SET_NEWS_PAGINATION', response.data);
				return response;
			})
			.catch((e) => {
				if (state.countNewsRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getCategoryData')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_NEWS_COUNT_REQUEST');
				} else {
					commit('setError', e)
					throw e
				}
			})
	},
	async getCategories({dispatch, commit, state, rootState}) {
		return await axios.get(route('api.news.categories'))
			.then((response) => {
				commit('SET_CATEGORIES', response);
				return response;
			})
			.catch((e) => {
				if (state.countCategoriesRequest < rootState.maxRequests) {
					setTimeout(function() {
						dispatch('getCategories')
					}, rootState.maxRequestTiming);
					commit('INCREMENT_CATEGORIES_COUNT_REQUEST');
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
