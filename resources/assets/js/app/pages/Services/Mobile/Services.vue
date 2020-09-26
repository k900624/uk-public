<template>
	<article class="content">
		<header class="content_header">
			<h1 class="content_title">
				Заявки
				<a href="javascript:;" @click="servicesRefresh()" title="Обновить" class="btn btn-success"><i class="fa fa-refresh"></i></a>
			</h1>
		</header>
		<div class="content_body">
			<div class="row">
				<div class="col-md-12">
					<!-- <ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="services-tab" data-toggle="tab" href="#services" role="tab" aria-controls="services" aria-selected="true">Услуги</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="false">Заявки</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="services" role="tabpanel" aria-labelledby="services-tab">
							<br>
							<h4>Задачи</h4>
							<ul>
								<li>Заказывать услуги УК, выбирая из списка услуг или в свободной форме</li>
								<li>Видеть статус заявки</li>
								<li>Получать счета на оплату</li>
								<li>Оплачивать счета через сервис</li>
								<li>Видеть историю оказанных услуг</li>
								<li>Видеть список заявок и акты выполненных работ</li>
								<li>Видеть тарифы и прайс-лист на услуги</li>
							</ul>
						</div>
						<div class="tab-pane fade" id="requests" role="tabpanel" aria-labelledby="requests-tab">
							<br> -->
							<a href="javascript:;" @click="setShowModal" class="btn btn-warning btn-add-request">Добавить заявку</a>
							<v-modal
								v-if="showModal"
								@modalclose="modalClose"
							>
								<h3>Заполните форму</h3>
								<br>
								<form @submit.prevent="onSubmitRequest" class="contact-form" method="post" accept-charset="utf-8">
									<p class="text-mute">Максимально подробно опишите ситуацию</p>
									<div class="form-group">
										<textarea
											id="requestText"
											v-model="requestText"
											rows="5"
											class="form-control"
											@blur="$v.$touch()"
											ref="requestTextarea"
										></textarea>
										<small
											class="text-danger"
											v-if="$v.requestText.$dirty && ! $v.requestText.required"
										>Поле обязательно для заполнения</small>
										<small
											class="text-danger"
											v-if="$v.requestText.$dirty && !$v.requestText.minLength"
										>Поле должно быть не менее {{$v.requestText.$params.minLength.min}} символов</small>
										<small
											class="text-danger"
											v-if="$v.requestText.$dirty && !$v.requestText.maxLength"
										>Поле должно быть не более {{$v.requestText.$params.maxLength.max}} символов</small>
									</div>
									<input type="submit" class="btn btn-primary" name="submit" value="Отправить">
								</form>
							</v-modal>

							<table class="table table-striped">
								<thead>
									<tr>
										<th class="hidden-mobi">Номер заявки</th>
										<th class="hidden-mobi">Дата подачи</th>
										<th class="requests_descrip">Описание</th>
										<th>Статус</th>
									</tr>
								</thead>
								<tbody>
									<tr :key="index" v-for="(serviceRequest, index) in SERVICE_REQUESTS">
										<td class="hidden-mobi">{{ serviceRequest.id }}</td>
										<td class="hidden-mobi">{{ serviceRequest.attributes.created_at | moment('DD.MM.YYYY') }}</td>
										<td class="requests_descrip">{{ serviceRequest.attributes.description }}</td>
										<td :title="serviceRequest.attributes.status_title" v-html="serviceRequest.attributes.status"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<!-- </div>
		</div> -->
	</article>
</template>

<script>
	import { required, minLength, maxLength} from 'vuelidate/lib/validators'
	import { mapActions, mapGetters } from 'vuex'

	export default {

		data() {
			return {
				showModal: false,
				requestText: null,
				state: {
					servicesLoading: true,
					serviceRequestsLoading: true,
				}
			}
		},

		validations: {
			requestText: {
				minLength: minLength(10),
				maxLength: maxLength(500),
				required
			}
		},

		methods: {
			...mapActions([
				'saveRequestService',
				'getServiceRequests',
				'getServices',
			]),

			async onSubmitRequest(event) {
				if (this.$v.$invalid) {
					this.$v.$touch();
					return;
				}

				this.requestText = await this.saveRequestService(this.requestText);
			},

			modalClose() {
				this.showModal = false;
			},

			setShowModal() {
				this.showModal = true;
				this.$nextTick(() => {
					this.$refs.requestTextarea.focus();
				});
			},

			async servicesRefresh() {
				// await this.getServices();
				this.state.serviceRequestsLoading = true;
				await this.getServiceRequests();
				this.state.serviceRequestsLoading = false;
			},
		},

		computed: {
			...mapGetters([
				'SERVICE_REQUESTS',
				'SERVICES',
			]),
		},

		async mounted() {
			if (this.SERVICE_REQUESTS.length === 0) {
				await this.getServiceRequests();
			}
			if (this.SERVICES.length === 0) {
				await this.getServices();
			}

			this.state.servicesLoading = false;
			this.state.serviceRequestsLoading = false;

			this.$store.commit('setDocumentTitle', 'Заявки');
		}
	}
</script>

<style lang="sass" scoped="">
	.badge
		font-size: 100%
		font-weight: normal

	.btn-add-request
		margin-bottom: 20px
</style>
