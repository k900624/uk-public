<template>
	<article class="content">
		<v-spinner
			v-if="state.pageItemLoading"
			:size="spinner_size"
			:speed="spinner_speed"
			:message="spinner_message"
		/>
		<template v-else>
			<header class="content_header">
				<h1 class="content_title">{{ PAGE.attributes.title }}</h1>
			</header>
			<div class="content_body" v-html="PAGE.attributes.fulltext"></div>
		</template>
	</article>
</template>

<script>
	import types from '@app/helpers/utils/types.utils'
	import { mapActions, mapGetters } from 'vuex'

	export default {

		data() {
			return {
				spinner_size: 24,
				spinner_speed: 0.8,
				spinner_message: 'Загрузка',
				state: {
					pageItemLoading: true
				},
			}
		},

		methods: {
			...mapActions([
				'getPage',
			]),

			async fetchPage() {
				this.state.pageItemLoading = true;
				await this.getPage(this.alias);
				this.state.pageItemLoading = false;
				this.$store.commit('setDocumentTitle', this.PAGE.attributes.title);
			}
		},

		computed: {
			alias() {
				return (this.$route.meta.alias || '')
			},

			...mapGetters([
				'PAGE',
			]),
		},

		watch: {
			$route(to, from) {
				this.fetchPage();
			}
		},

		async mounted() {
			this.fetchPage();
		}
	}
</script>
