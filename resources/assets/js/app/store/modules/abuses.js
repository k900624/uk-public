import axios from 'axios'
import route from '@app/route'
import Vue from 'vue'

const actions = {
	async saveAbuse({commit}, abuseData) {
		return await axios.post(route('api.abuse.store'), abuseData)
			.then((response) => {
				if (response.status === 201) {
					Vue.notify({
						group: 'app',
						type: 'success',
						text: 'Успешно отправлено!'
					});
					return null;
				}
			})
			.catch((e) => {
				if (e && e.response.status === 422) {
					let errors = e.response.data.errors || {};
					commit('setErrors', errors)
				}
				// return abuseData;
			});
	},
};

export default {
	actions
}
