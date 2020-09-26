<template>
	<article class="content">
		<header class="content_header">
			<router-link
				tag="a"
				class="btn btn-primary"
				:to="{name: 'news_events'}"
			>Назад</router-link>
		</header>
		<div class="content_body">

			<header class="content_header">
				<h2 class="content_title">Новости категории "{{ CATEGORY_DATA.title }}"</h2>
			</header>
			<v-spinner
				v-if="state.newsLoading"
				:size="spinner_size"
				:speed="spinner_speed"
				:message="spinner_message"
			/>
			<template v-else>
				<template v-if="CATEGORY_NEWS.length > 0">
					<ul class="list-unstyled article-list">
						<li class="media article article--list-item" :key="index" v-for="(news, index) in CATEGORY_NEWS">
							<router-link
								v-if="news.attributes.image_thumb"
								tag="a"
								class="item_link"
								:to="{name: 'news_show', params: {alias: news.attributes.alias}}"
							>
								<img class="item_media"
									:src="news.attributes.image_thumb"
									:alt="news.attributes.title"
									:title="news.attributes.title">
							</router-link>
							<div class="media-body item_body">
								<h4 class="item_header">
									<router-link
										tag="a"
										:to="{name: 'news_show', params: {alias: news.attributes.alias}}"
									>{{ news.attributes.title }}
									</router-link>
								</h4>
								<ul class="article_meta article_meta--list-item">
									<li><time class="created text-muted">{{ news.attributes.created_at | moment('DD MMMM YYYY') }}</time></li>
									<li>
										<router-link
											tag="a"
											:to="{name: 'news_category_show', params: {alias: news.attributes.category_alias}}"
										>{{ news.attributes.category_title }}</router-link>
									</li>
								</ul>
								<p class="item_intro">
									{{ news.attributes.introtext }}
									<router-link
										tag="a"
										class="item_more"
										:to="{name: 'news_show', params: {alias: news.attributes.alias}}"
									>Подробнее</router-link>
								</p>
							</div>
						</li>
					</ul>
					<v-content-pagination
						:pagination="NEWS_PAGINATION"
						@fetchContentFromPagination="fetchNews"
					/>
				</template>
				<template v-else>
					<p>Новостей для данной категории нет!</p>
				</template>
			</template>
		</div>

	</article>
</template>

<script>
	import vContentPagination from '@pages/NewsEvents/Partials/ContentPagination'
	import route from '@app/route'
	import { mapActions, mapGetters } from 'vuex'

	export default {

		data() {
			return {
				spinner_size: 24,
				spinner_speed: 0.8,
				spinner_message: 'Загрузка',
				state: {
					newsLoading: true
				},
				vContentPagination: {},
			}
		},

		methods: {

			...mapActions([
				'getCategoryData',
			]),

			routes(name, params) {
				return route(name, params);
			},

			async fetchNews(page_url) {
				this.state.newsLoading = true;
				await this.getCategoryData(page_url);
				this.state.newsLoading = false;

				this.$store.commit('setDocumentTitle', 'Новости категории - ' + this.CATEGORY_DATA.title);
			},
		},

		components: {
			vContentPagination
		},

		computed: {
			...mapGetters([
				'CATEGORY_DATA',
				'CATEGORY_NEWS',
				'NEWS_PAGINATION',
			]),
		},

		watch: {
			$route(to, from) {
				this.fetchNews(route('api.news.category.show', this.$route.params.category_alias));
			}
		},

		async mounted() {
			await this.fetchNews(route('api.news.category.show', this.$route.params.category_alias));
		}
	}
</script>
