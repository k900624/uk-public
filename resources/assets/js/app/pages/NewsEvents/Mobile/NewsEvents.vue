<template>
	<article class="content">
		<div class="content_body">

			<div class="row">
				<div class="col-md-12 mb-4">
					<header class="content_header">
						<h2 class="content_title">
							Объявления
							<a href="javascript:;" @click="advertsRefresh()" title="Обновить" class="btn btn-success"><i class="fa fa-refresh"></i></a>
						</h2>
					</header>
					<v-spinner
						v-if="state.advertsLoading"
						:size="spinner_size"
						:speed="spinner_speed"
						:message="spinner_message"
					/>
					<template v-else>
						<template v-if="ADVERTS.length > 0">
							<ul class="list-unstyled article-list">
								<li class="media article article--list-item" :key="advert.id" v-for="(advert, index) in ADVERTS">
									<div class="media-body item_body">
										<h4 class="item_header">
											{{ advert.attributes.title }}
										</h4>
										<ul class="article_meta article_meta--list-item">
											<li><time class="created text-muted">{{ advert.attributes.created_at | moment('DD MMMM YYYY') }}</time></li>
										</ul>
										<p class="item_intro">
											{{ advert.attributes.introtext }}
											<a href="javascript:;" @click="advertShow(index)" class="item_more">Подробнее</a>
										</p>
										<transition name="slide">
											<div class="item_full" v-if="state.advertIsActive == index" v-html="advert.attributes.fulltext"></div>
										</transition>
									</div>
								</li>
							</ul>
							<v-content-pagination
								:pagination="ADVERTS_PAGINATION"
								@fetchContentFromPagination="fetchAdverts"
							/>
						</template>
						<template v-else>
							<p>Объявлений нет!</p>
						</template>
					</template>
				</div>

				<div class="col-md-12">
					<header class="content_header">
						<h2 class="content_title">
							Новости
							<a href="javascript:;" @click="newsRefresh()" title="Обновить" class="btn btn-success"><i class="fa fa-refresh"></i></a>
						</h2>
					</header>

					<v-spinner
						v-if="state.newsLoading"
						:size="spinner_size"
						:speed="spinner_speed"
						:message="spinner_message"
					/>
					<template v-else>
						<template v-if="NEWS.length > 0">
							<ul class="list-unstyled article-list">
								<li class="media article article--list-item" :key="index" v-for="(news, index) in NEWS">
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
													:to="{name: 'news_category_show', params: {category_alias: news.attributes.category_alias}}"
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
							<p>Новостей нет!</p>
						</template>
					</template>
					<!-- <h4>Задачи</h4>
					<ul>
						<li>Видеть список новостей и событий</li>
					</ul> -->
				</div>
			</div>
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
					advertIsActive: null,
					advertsLoading: true,
					newsLoading: true
				},
				vContentPagination: {},
			}
		},

		methods: {
			...mapActions([
				'getAdverts',
				'getNews'
			]),

			advertShow(index) {
				this.state.advertIsActive = this.state.advertIsActive === index ? null : index;
			},

			async fetchAdverts(page_url) {
				this.state.advertsLoading = true;
				await this.getAdverts(page_url);
				this.state.advertsLoading = false;
			},

			async fetchNews(page_url) {
				this.state.newsLoading = true;
				await this.getNews(page_url);
				this.state.newsLoading = false;
			},

			async advertsRefresh() {
				await this.fetchAdverts(route('api.adverts'));
			},

			async newsRefresh() {
				await this.fetchNews(route('api.news'));
			}
		},

		components: {
			vContentPagination
		},

		computed: {
			...mapGetters([
				'ADVERTS',
				'ADVERTS_PAGINATION',
				'NEWS',
				'NEWS_PAGINATION',
			]),
		},

		async mounted() {
			this.$store.commit('setDocumentTitle', 'Новости и события');

			if (this.ADVERTS.length === 0) {
				await this.fetchAdverts(route('api.adverts'));
			}
			if (this.NEWS.length === 0) {
				await this.fetchNews(route('api.news'));
			}
			this.state.newsLoading = false;
			this.state.advertsLoading = false;
		}
	}
</script>

<style lang="sass" scoped="">
	.item_full
		margin-top: 10px
</style>
