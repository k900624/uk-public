<template>
	<article class="content">
		<header class="content_header">
			<h1 class="content_title">
				Полезная информация
				<a href="javascript:;" @click="handbookRefresh()" title="Обновить" class="btn btn-success"><i class="fa fa-refresh"></i></a>
			</h1>
		</header>
		<div class="content_body">
			<v-spinner
				v-if="state.handbookLoading"
				:size="spinner_size"
				:speed="spinner_speed"
				:message="spinner_message"
			/>
			<template v-else>
				<template v-if="HANDBOOK.length > 0">
					<ul class="list-unstyled article-list">
						<li class="media article" :key="index" v-for="(handbook, index) in HANDBOOK">
							<div class="media-body item_body">

								<router-link
									tag="a"
									:to="{name: 'handbook_show', params: {alias: handbook.attributes.alias}}"
								>{{ handbook.attributes.title }}
								</router-link>

							</div>
						</li>
					</ul>
					<v-content-pagination
						:pagination="HANDBOOK_PAGINATION"
						@fetchContentFromPagination="fetchHandbook"
					/>
				</template>
				<template v-else>
					<p>Статей нет!</p>
				</template>
			</template>
		</div>
	</article>
</template>

<script>
	import route from '@app/route'
	import types from '@app/helpers/utils/types.utils'
	import vContentPagination from '@pages/NewsEvents/Partials/ContentPagination'
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
				vContentPagination: {},
			}
		},

		components: {
			vContentPagination
		},

		computed: {
			...mapGetters([
				'HANDBOOK',
				'HANDBOOK_PAGINATION',
			]),
		},

		methods: {
			...mapActions([
				'getHandbook',
			]),

			async fetchHandbook(page_url) {
				this.state.handbookLoading = true;
				await this.getHandbook(page_url);
				this.state.handbookLoading = false;
			},

			async handbookRefresh() {
				await this.fetchHandbook(route('api.handbook'));
			}
		},

		async mounted() {
			if (this.HANDBOOK.length === 0) {
				await this.fetchHandbook(route('api.handbook'));
			}
			this.state.handbookLoading = false;

			this.$store.commit('setDocumentTitle', 'Полезная информация');
		}
	}
</script>

<style lang="sass" scoped="">
	.article
		margin-bottom: 10px
</style>
