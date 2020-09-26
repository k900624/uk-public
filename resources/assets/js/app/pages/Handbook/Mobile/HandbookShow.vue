<template>
	<article class="content">
		<router-link
			tag="a"
			class="btn btn-primary"
			:to="{name: 'handbook'}"
		>Назад</router-link>
		<v-spinner
			v-if="state.handbookLoading"
			:size="spinner_size"
			:speed="spinner_speed"
			:message="spinner_message"
		/>
		<template v-else>
			<header class="content_header">
				<h1 class="content_title">{{ HANDBOOK_ITEM.attributes.title }}</h1>
			</header>
			<div class="content_body">
				<div class="article">
					<div class="article_fulltext" itemprop="description" v-html="HANDBOOK_ITEM.attributes.fulltext"></div>
				</div>
			</div>
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
					handbookLoading: true
				},
			}
		},

		computed: {
			...mapGetters([
				'HANDBOOK_ITEM',
			]),
		},

		methods: {
			...mapActions([
				'getHandbookItem',
			]),
		},

		async mounted() {
			await this.getHandbookItem(this.$route.params.alias);
			this.state.handbookLoading = false;

			this.$store.commit('setDocumentTitle', this.HANDBOOK_ITEM.attributes.title);
		}
	}
</script>

<style lang="sass" scoped="">

</style>
