<template>
	<article class="content">
		<div class="content_body">
			<div class="row">
				<div class="col-md-8">
					<div class="adverts">
						<header class="content_header">
							<h2 class="content_title">
								Объявления
								<a href="javascript:;" @click="fetchAdverts()" title="Обновить" class="btn btn-success"><i class="fa fa-refresh"></i></a>
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
								<p><router-link class="" :to="{name: 'news_events'}">Все объявления</router-link></p>
							</template>
							<template v-else>
								<p>Объявлений нет!</p>
							</template>
						</template>
					</div>

					<div class="poll">
						<header class="content_header">
							<h2 class="content_title">Голосование
								<a href="javascript:;" @click="fetchPoll()" title="Обновить" class="btn btn-success"><i class="fa fa-refresh"></i></a>
							</h2>
						</header>

						<v-spinner
							v-if="state.pollLoading"
							:size="spinner_size"
							:speed="spinner_speed"
							:message="spinner_message"
						/>
						<template v-else>

							<template v-if="POLL && POLL.attributes">

								<div style="display: flex; justify-content: space-between; align-items: center;">
									<h4>{{ POLL.attributes.title }}</h4>
									<p class="text-danger">{{ POLL.attributes.started_at | moment('DD MMMM YYYY') }} — {{ POLL.attributes.ended_at | moment('DD MMMM YYYY') }}</p>
								</div>
								<div v-html="POLL.attributes.description"></div>
								<br>
								<form @submit.prevent="onSubmitPoll($event, POLL.id)" class="poll-form" method="post" accept-charset="utf-8">
									<div class="questions">
										<div class="question_item" :key="question.id" v-for="(question, index) in POLL.attributes.questions">
											<p><strong>Вопрос {{ index + 1 }}</strong> {{ question.title }}</p>
											<p v-if="question.description">{{ question.description }}</p>
											<div class="answers">
												<div class="answer_item" :key="answer.id" v-for="(answer, key) in POLL.attributes.answers[index]">
													<div class="form-check form-check-inline">
														<input
															class="form-check-input"
															type="radio"
															:id="'answer-' + index +'-'+ key"
															:value="answer.id"
															v-model.trim="answersSelected[index]"
														>
														<label
															class="form-check-label"
															:for="'answer-' + index +'-'+ key"
														>{{ answer.title }}</label>
													</div>
												</div>
											</div>
										</div>
									</div>
									<textarea
										v-model.trim="poll_comment"
										rows="4" class="form-control mb-4"
										placeholder="Прокомментируйте ваш ответ"
										@blur="$v.$touch()"
									></textarea>
									<template v-if="POLL.attributes.status.error"><p class="alert alert-danger">{{ POLL.attributes.status.message }}</p></template>
									<button v-else class="btn btn-secondary" type="submit">Голосовать</button>
								</form>

								<p><router-link :to="{name: 'polls'}">Все голосования</router-link></p>

							</template>
							<template v-else>
								<p>Голосований нет!</p>
							</template>
						</template>
					</div>
				</div>
				<div class="col-md-4">
					<aside class="r-sidebar" role="complementary">
						<div class="sidebar">
							<section class="widget">
								<header class="widget_header">
									<h4>Горячие телефоны</h4>
								</header>
								<div class="widget_body">
									<table>
										<tbody>
											<tr>
												<th>005</th>
												<td>справочная</td>
											</tr>
											<tr>
												<th>04, <a href="tel:221-51-52">221-51-52</a></th>
												<td>газовая служба </td>
											</tr>
											<tr>
												<th><a href="tel:211-39-63">211-39-63</a></th>
												<td>водоканал</td>
											</tr>
											<tr>
												<th><a href="tel:221-85-51">221-85-51</a></th>
												<td>теплоснабжение</td>
											</tr>
											<tr>
												<th><a href="tel:261-86-18">261-86-18</a></th>
												<td>повреждение наружных сетей канализации</td>
											</tr>
											<tr>
												<th><a href="tel:221-43-81">221-43-81</a></th>
												<td>повреждение уличного освещения, левобережный участок</td>
											</tr>
											<tr>
												<th><a href="tel:236-63-63">236-63-63</a></th>
												<td>повреждение уличного освещения, правобережный участок</td>
											</tr>
										</tbody>
									</table>
								</div>
							</section>
							<section class="widget" style="overflow: hidden;">
								<header class="widget_header">
									<h4>Полезная информация</h4>
								</header>
								<div class="widget_body">
									<v-spinner
										v-if="state.handbookLoading"
										:size="spinner_size"
										:speed="spinner_speed"
										:message="spinner_message"
									/>
									<template v-else>
										<ul class="information">
											<li :key="index" v-for="(handbook, index) in HANDBOOK">
												<router-link
													tag="a"
													:to="{name: 'handbook_show', params: {alias: handbook.attributes.alias}}"
												>{{ handbook.attributes.title }}</router-link>
											</li>
										</ul>
										<router-link style="float: right; color: #878787; font-size: 11px; margin-top: 5px;" class="" :to="{name: 'handbook'}">Вся информация</router-link>
									</template>
								</div>
							</section>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</article>
</template>

<script>
	import route from '@app/route'
	import types from '@app/helpers/utils/types.utils'
	import { minLength, maxLength } from 'vuelidate/lib/validators'
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
					pollLoading: true,
					handbookLoading: true,
				},
				poll_comment: '',
				answersSelected: []
			}
		},

		validations: {
			poll_comment: {
				minLength: minLength(10),
				maxLength: maxLength(500)
			},
			answersSelected: {}
		},

		methods: {

			...mapActions([
				'getAdvertsHome',
				'getPoll',
				'getHandbook',
				'getHomeHandbook',
				'savePoll'
			]),

			onSubmitPoll(event, poll_id) {
				event.preventDefault();

				if (this.$v.$invalid) {
					this.$v.$touch();
					return;
				}

				let vm = this;
				this.savePoll({
					poll_id: poll_id,
					comment: vm.poll_comment,
					answers: vm.answersSelected
				});
			},

			advertShow(index) {
				this.state.advertIsActive = this.state.advertIsActive === index ? null : index;
			},

			async fetchAdverts() {
				this.state.advertsLoading = true;
				// await this.$store.dispatch('getAdvertsHome');
				await this.getAdvertsHome();
				this.state.advertsLoading = false;
			},

			async fetchPoll() {
				this.state.pollLoading = true;
				// await this.$store.dispatch('getPoll');
				await this.getPoll();
				this.state.pollLoading = false;
			},

			async fetchHandbook() {
				this.state.handbookLoading = true;
				await this.getHomeHandbook();
				this.state.handbookLoading = false;
			},
		},

		computed: {
			...mapGetters({
				ADVERTS: 'ADVERTS_HOME',
				POLL: 'POLL',
				HANDBOOK: 'HANDBOOK_HOME',
			}),
			// ADVERTS() {
			// 	this.state.advertsLoading = false;
			// 	return this.$store.getters.ADVERTS_HOME;
			// },
			// POLL() {
			// 	this.state.pollLoading = false;
			// 	return this.$store.getters.POLL;
			// },
		},

		async mounted() {
			this.$store.commit('setDocumentTitle', 'Личный кабинет');

			if (this.ADVERTS.length === 0) {
				await this.fetchAdverts();
			}
			if (types.isEmpty(this.POLL)) {
				await this.fetchPoll();
			}
			if (this.HANDBOOK.length === 0) {
				await this.fetchHandbook(route('api.handbook'));
			}
			this.state.handbookLoading = false;
			this.state.advertsLoading = false;
			this.state.pollLoading = false;
		}
	}
</script>

<style lang="sass" scoped="">
	.poll
		margin-top: 20px
		padding: 20px 30px
		background-color: #fef2de

	.poll-form
		margin-bottom: 20px

	.question_item
		margin-bottom: 20px

	.item_full
		margin-top: 10px

	.l-sidebar

		table

			th
				width: 100px

			th,
			td
				vertical-align: top
				padding: 2px 4px

	.r-sidebar
		background-color: #f6f6f6
		padding: 15px

		.information li
			margin-bottom: 10px

		th
			width: 86px
			vertical-align: top

</style>
