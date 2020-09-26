<template>
	<article class="content">
		<header class="content_header">
			<h1 class="content_title">
				Голосования
				<a href="javascript:;" @click="pollsRefresh()" title="Обновить" class="btn btn-success"><i class="fa fa-refresh"></i></a>
			</h1>
		</header>
		<div class="content_body">
			<v-spinner
				v-if="state.pollsLoading"
				:size="spinner_size"
				:speed="spinner_speed"
				:message="spinner_message"
			/>
			<template v-else>
				<template v-if="POLLS">
					<div class="poll" :key="poll.id" v-for="poll in POLLS">
						<div style="display: flex; justify-content: space-between; align-items: center;">
							<h4>{{ poll.attributes.title }}</h4>
							<p class="text-danger">{{ poll.attributes.started_at | moment('DD MMMM YYYY') }} — {{ poll.attributes.ended_at | moment('DD MMMM YYYY') }}</p>
						</div>
						<div v-html="poll.attributes.description"></div>
						<br>
						<form @submit.prevent="onSubmitPoll($event, poll.id)" class="poll-form" method="post" accept-charset="utf-8">
							<div class="questions">
								<div class="question_item" :key="question.id" v-for="(question, index) in poll.attributes.questions">
									<p><strong>Вопрос {{ index + 1 }}</strong> {{ question.title }}</p>
									<p v-if="question.description">{{ question.description }}</p>
									<div class="answers">
										<div class="answer_item" :key="answer.id" v-for="(answer, key) in poll.attributes.answers[index]">
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
							<template v-if="poll.attributes.status.error"><p class="alert alert-danger">{{ poll.attributes.status.message }}</p></template>
							<button v-else class="btn btn-secondary" type="submit">Голосовать</button>
						</form>
					</div>

				</template>
				<template v-else>
					<p>Голосований нет!</p>
				</template>
			</template>

			<!-- <h4>Задачи</h4>
			<ul>
				<li>Участвовать в голосовании</li>
				<li>Участвовать в опросе</li>
			</ul> -->
		</div>
	</article>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'

	export default {

		data() {
			return {
				spinner_size: 24,
				spinner_speed: 0.8,
				spinner_message: 'Загрузка',
				poll_comment: '',
				answersSelected: [],
				state: {
					pollsLoading: true
				}
			}
		},

		methods: {
			...mapActions([
				'getPolls',
				'savePoll'
			]),

			async pollsRefresh() {
				await this.fetchPolls();
			},

			async fetchPolls() {
				this.state.pollsLoading = true;
				await this.getPolls();
				this.state.pollsLoading = false;
			},

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
		},

		computed: {
			...mapGetters([
				'POLLS',
			]),
		},

		async mounted() {
			if (this.POLLS.length === 0) {
				await this.fetchPolls();
			}

			this.state.pollsLoading = false;

			this.$store.commit('setDocumentTitle', 'Мои голосования');
		}
	}
</script>
