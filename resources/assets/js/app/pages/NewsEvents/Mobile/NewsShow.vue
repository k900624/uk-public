<template>
	<article class="content">
		<router-link
			tag="a"
			class="btn btn-primary"
			:to="{name: 'news_events'}"
		>Назад</router-link>
		<v-spinner
			v-if="state.newsItemLoading"
			:size="spinner_size"
			:speed="spinner_speed"
			:message="spinner_message"
		/>
		<template v-else>
			<header class="content_header">
				<h1 class="content_title">{{ NEWS_ITEM.attributes.title }}</h1>
			</header>
			<div class="content_body">
				<div class="article">
					<ul class="article_meta">
						<li><time class="created">{{ NEWS_ITEM.attributes.created_at | moment('DD MMMM YYYY') }}</time></li>
						<li><router-link
								tag="a"
								:to="{name: 'news_category_show', params: {category_alias: NEWS_ITEM.attributes.category_alias}}"
							>{{ NEWS_ITEM.attributes.category_title }}</router-link></li>
					</ul>
					<div class="article_media">
						<img class="article_img"
							:src="NEWS_ITEM.attributes.image"
							:alt="NEWS_ITEM.attributes.title"
							:title="NEWS_ITEM.attributes.title"
							itemprop="image">
					</div>
					<p class="article_intro">{{ NEWS_ITEM.attributes.introtext }}</p>

					<div class="article_fulltext" itemprop="description" v-html="NEWS_ITEM.attributes.fulltext"></div>
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
					newsItemLoading: true
				},
			}
		},

		computed: {
			...mapGetters([
				'NEWS_ITEM',
			]),
		},

		methods: {
			...mapActions([
				'getNewsItem',
			]),
		},

		async mounted() {
			await this.getNewsItem(this.$route.params.alias);
			this.state.newsItemLoading = false;

			this.$store.commit('setDocumentTitle', this.NEWS_ITEM.attributes.title);
		}
	}
</script>
