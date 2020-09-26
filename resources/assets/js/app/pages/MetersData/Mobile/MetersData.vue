<template>
	<article class="content">

		<div class="non-printable">
			<MetersWidget />

			<header class="content_header">
				<h1 class="content_title">
					Показания счетчиков
					<a href="javascript:;" @click="metersDataRefresh()" title="Обновить" class="btn btn-success"><i class="fa fa-refresh"></i></a>
				</h1>
			</header>
			<div class="content_body">

				<v-spinner
					v-if="state.metersLoading"
					:size="spinner_size"
					:speed="spinner_speed"
					:message="spinner_message"
				/>
				<template v-else>
					<!-- <template v-if=" ! METERS.metersDataPeriodNotStarted && ! METERS.metersDataPeriodEnded"> -->
					<template>
						<!-- <a href="javascript:;" @click="showModal = true" class="btn btn-link">Подать показания счетчика водоснабжения за {{ METERS.currencyMonth }} {{ METERS.currencyYear}} года</a> -->
						<!-- <br><br> -->
						<!-- <v-modal
							v-if="showModal"
							@modalclose="modalCloseEmitted"
							classmodal="modal--meter-data"
						>
							<h3>Данные счетчиков за {{ METERS.currencyMonth }} {{ METERS.currencyYear}} года</h3>
							<br>

							<form @submit.prevent="onSubmitMeters" class="meters-data-form" method="post" accept-charset="utf-8">
								<template v-if="errors">
									<div :key="category.id" v-for="category in errors">
										<div class="alert alert-danger" role="alert" :key="error.id" v-for="error in category">
											<span>{{ error }}</span>
										</div>
									</div>
								</template>
								<p class="alert alert-danger" v-if="state.metersWaterError && metersWaterErrorMsg" v-html="metersWaterErrorMsg"></p>
								<table class="table">
									<thead>
										<tr>
											<th class="text-center" rowspan="2">Счетчик</th>
											<th class="text-center" rowspan="2">Тариф, руб.</th>
											<th class="text-center" colspan="2">Показания</th>
											<th class="text-center" rowspan="2">Расход</th>
											<th class="text-center" rowspan="2">Итого <br> к оплате, руб.</th>
										</tr>
										<tr>
											<th class="text-center text-muted" width="15%"><small>Предыдущее</small></th>
											<th class="text-center text-muted" width="15%"><small>Текущее</small></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												Вода, м<sup>3</sup><br>
												<small class="text-muted">Серийный номер: {{ AREA.attributes.сounters.water_number }}</small>
											</td>
											<td class="text-center">{{ METERS.tariff.water }}</td>
											<td class="text-center">{{ METERS.prev.water }}</td>
											<td>
												<input
													type="text"
													v-model.trim="metersDataWater"
													v-cleave="{numeral: true, numeralThousandsGroupStyle: 'thousand', delimiter: '', numeralIntegerScale: 5}"
													class="form-control">
											</td>
											<td class="text-center">{{ calcWaterCost }}</td>
											<td class="text-center">{{ calcWaterTotal }}</td>
										</tr>
										<tr>
											<td>
												Электроэнергия, кВт.ч<br>
												<small class="text-muted">Серийный номер: {{ AREA.attributes.сounters.electr_number }}</small>
											</td>
											<td class="text-center">{{ METERS.tariff.electricity }}</td>
											<td class="text-center">{{ METERS.prev.electricity }}</td>
											<td class="text-center">{{ METERS.currency.electricity }}</td>
											<td class="text-center">{{ electricityCost }}</td>
											<td class="text-center">{{ electricityTotal }}</td>
										</tr>
										<tr>
											<td>
												Электроэнергия ночь, кВт.ч<br>
												<small class="text-muted">Серийный номер: {{ AREA.attributes.сounters.electr_number }}</small>
											</td>
											<td class="text-center">{{ METERS.tariff.electricity_night }}</td>
											<td class="text-center">{{ METERS.prev.electricity_night }}</td>
											<td class="text-center">{{ METERS.currency.electricity_night }}</td>
											<td class="text-center">{{ electricityNightCost }}</td>
											<td class="text-center">{{ electricityNightTotal }}</td>
										</tr>
										<tr>
											<td class="text-right" colspan="5">Итого за расч. период:</td>
											<td class="text-center"><strong>{{ total }}</strong></td>
										</tr>
									</tbody>
								</table>
								<div class="text-center">
									<v-button className="btn-secondary" @click="modalClose">Отмена</v-button>
									<input :disabled="this.state.metersWaterError" type="submit" class="btn btn-primary" name="submit" value="Сохранить">
								</div>
							</form>
						</v-modal> -->
					</template>

					<v-spinner
						v-if="state.metersHistoryLoading"
						:size="spinner_size"
						:speed="spinner_speed"
						:message="spinner_message"
					/>
					<template v-else>

						<h3>Диаграммы потребления ресурсов</h3>

						<div class="btn-group btn-group-toggle" data-toggle="buttons">
							<label class="btn btn-primary" :class="{ active : METERS_HISTORY_PERIOD == 'year'}" @click.prevent="changePeriod('year')">
								<input type="radio" name="period" checked=""> За год
							</label>
							<label class="btn btn-primary" :class="{ active : METERS_HISTORY_PERIOD == 'allTimes'}" @click.prevent="changePeriod('allTimes')">
								<input type="radio" name="period"> За все время
							</label>
						</div>

						<v-chart
							:chartdata="{labels: CHART_LABELS, datasets: CHART_DATA}"
							:options="chartOptions"
							:reRender="state.reRenderMetersHistory"
						></v-chart>
					</template>

					<br>
					<br>
					<h2>История показаний</h2>
					<table class="table">
						<thead>
							<tr>
								<th width="20%">Дата</th>
								<th>Тип ресурса</th>
								<th>Тариф, руб.</th>
								<th>Объем</th>
								<th>Стоимость, руб.</th>
								<th>Квитанция</th>
							</tr>
						</thead>
						<tbody>
							<tr :key="index" v-for="(meter, index) in ALL_METERS">
								<td>
									{{ meter.created_at | moment('DD.MM.YYYY') }}
								</td>
								<td>
									<ul>
										<li>Электроэнергия, кВт.ч</li>
										<li>Электроэнергия ночь, кВт.ч</li>
										<li>Вода, м<sup>3</sup></li>
									</ul>
								</td>
								<td>
									<ul>
										<li>{{ METERS.tariff.electricity }}</li>
										<li>{{ METERS.tariff.electricity_night }}</li>
										<li>{{ METERS.tariff.water }}</li>
									</ul>
								</td>
								<td>
									<ul>
										<li>{{ meter.electricityMeters > 0 ? meter.electricityMeters : 0 }}</li>
										<li>{{ meter.electricityNightMeters > 0 ? meter.electricityNightMeters : 0 }}</li>
										<li>{{ meter.waterMeters > 0 ? meter.waterMeters : 0 }}</li>
									</ul>
								</td>
								<td>
									<ul>
										<li>{{ allMetersCost(meter.electricityMeters, METERS.tariff.electricity) }}</li>
										<li>{{ allMetersCost(meter.electricityNightMeters, METERS.tariff.electricity_night) }}</li>
										<li>{{ allMetersCost(meter.waterMeters, METERS.tariff.water) }}</li>
									</ul>
								</td>
								<td>
									<a href="javascript:;" @click="setShowModal(meter.created_at)"> {{ meter.month }} <i class="fa fa-search"></i></a>
								</td>
							</tr>

						</tbody>
					</table>



				</template>

				<!-- <h4>Задачи</h4>
				<ul>
					<li>Видеть диаграммы потребления ресурсов в различных периодах (месяц, год, все время)</li>
				</ul> -->
			</div>

		</div>

		<InvoiceModal
			v-if="showModalMeters"
			@modalclose="modalClose"
			:showModalProp="showModalMeters"
			:dataLoading="state.paymentsMonthLoading"
			:modalData="modalData"
		/>

	</article>
</template>

<script>
	import route from '@app/route'
	import vChart from '@components/Chart'
	import Cleave from 'cleave.js'
	import { mapActions, mapGetters } from 'vuex'
	import InvoiceModal from '@components/Modals/Invoice'
	import MetersWidget from '@components/Widgets/Meters'

	Number.prototype.toFixed = function(x){ return Math.round(this * Math.pow(10, x)) / Math.pow(10, x);}

	export default {
		data() {
			return {
				spinner_size: 24,
				spinner_speed: 0.8,
				spinner_message: 'Загрузка',
				state: {
					metersWaterError: false,
					metersLoading: true,
					metersHistoryLoading: true,
					reRenderMetersHistory: false,
					paymentsMonthLoading: true
				},
				showModalMeters: false,
				modalData: null,
				metersWaterErrorMsg: '',
				showModal: false,
				metersData: {
					water: 0,
				},
				// errors: {},
				chartOptions: {
					responsive: true,
					maintainAspectRatio: false,
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					},
					tooltips: {
						callbacks: {
							label(tooltipItem, data) {
								// Get the dataset label.
								const label = data.datasets[tooltipItem.datasetIndex].label;

								// Format the y-axis value.
								const value = tooltipItem.yLabel;

								return `${label}: ${value}`;
							}
						}
					}
				},
			}
		},

		directives: {
			cleave: {
				inserted: (el, binding) => {
					el.cleave = new Cleave(el, binding.value || {})
				},
				update: (el) => {
					const event = new Event('input', {bubbles: true});
					setTimeout(function () {
						el.value = el.cleave.properties.result
						el.dispatchEvent(event)
					}, 100);
				}
			}
		},

		methods: {

			...mapActions([
				'getMeters',
				'getMetersHistory',
				'getMonthPayment',
			]),

			async changePeriod(period = 'year') {
				// this.state.reRenderMetersHistory = true;
				await this.getMetersHistory(period);
				this.state.reRenderMetersHistory = true;
			},

			onSubmitMeters() {
				if (this.metersData.water == 0) {
					this.errors = {water: ["Поле Вода обязательно для заполнения."]};
					return false;
				}
				axios.post(route('api.metersData.store'), {
						water: this.metersData.water,
						token: $apiToken,
					}).then(response => {
						this.$notify({
							group: 'app',
							type: 'success',
							text: 'Ваши показания успешно обновлены!'
						});
						this.showModal = false;
					}).catch(error => {
						if (error.response.status === 422) {
							this.errors = error.response.data.errors || {};
						}
					});
			},

			modalCloseEmitted() {
				this.showModal = false;
			},

			modalClose() {
				this.showModal = false;
				this.showModalMeters = false;
				document.body.classList.remove('modal-open');
			},

			async metersDataRefresh() {
				await this.fetchMeters();
				await this.fetchMetersHistory();
			},

			async fetchMeters() {
				this.state.metersLoading = true;
				await this.getMeters();
				this.state.metersLoading = false;
			},

			async fetchMetersHistory(period = 'year') {
				this.state.metersHistoryLoading = true;
				await this.getMetersHistory(period);
				this.state.metersHistoryLoading = false;
			},

			async setShowModal(date) {
				this.showModalMeters = true;
				this.state.paymentsMonthLoading = true;
				await this.getMonthPayment(date);
				this.modalData = this.MONTH_PAYMENT;
				this.state.paymentsMonthLoading = false;
			},

			allMetersCost(current, prev) {
				let result = (current * prev).toFixed(2);
				if (result > 0) {
					return result
				}
				return 0;
			}

			// truncated(num) {
			// 	return Math.trunc(num * 100) / 100;
			// }

		},

		components: {
			vChart,
			InvoiceModal,
			MetersWidget
		},

		computed: {
			...mapGetters([
				'METERS',
				'ALL_METERS',
				'AREA',
				'CHART_DATA',
				'CHART_LABELS',
				'METERS_HISTORY_PERIOD',
				'MONTH_PAYMENT',
			]),

			calcWaterCost: function () {
				this.state.metersWaterError = false;
				let abs = Math.abs(this.metersData.water - this.METERS.prev.water);
				if (this.metersData.water < this.METERS.prev.water) {
					this.state.metersWaterError = true;
					this.metersWaterErrorMsg = '';
					return 0;
				} else {
					if (abs >= 50) {
						this.state.metersWaterError = true;
						this.metersWaterErrorMsg = 'Возможна ошибка при вводе! Показания не могут быть больше 50 м<sup>3</sup>';
						return 'error';
					}
					return abs.toFixed(2);
				}
			},
			electricityCost: function () {
				return parseFloat(this.METERS.currency.electricity - this.METERS.prev.electricity).toFixed(2);
			},
			electricityNightCost: function () {
				return parseFloat(this.METERS.currency.electricity_night - this.METERS.prev.electricity_night).toFixed(2);
			},
			calcWaterTotal: function () {
				if (this.calcWaterCost == 'error') {
					return 'error';
				}
				return parseFloat(this.METERS.tariff.water * this.calcWaterCost).toFixed(2);
			},
			electricityTotal: function () {
				return parseFloat(this.METERS.tariff.electricity * this.electricityCost).toFixed(2);
			},
			electricityNightTotal: function () {
				return parseFloat(this.METERS.tariff.electricity_night * this.electricityNightCost).toFixed(2);
			},
			total: function () {
				if (this.calcWaterTotal == 'error') {
					return 'error';
				}
				return (this.calcWaterTotal + this.electricityTotal + this.electricityNightTotal).toFixed(2);
			},

			metersDataWater: {
				get() {
					return this.metersData.water
				},
				set(newData) {
					this.metersData.water = newData
				}
			},

		},

		watch: {
			showModal: function () {
				if (this.showModal === true) {
					this.state.reRenderMetersHistory = false;
				}
			}
		},

		async mounted() {
			this.$store.commit('setDocumentTitle', 'Показания счетчиков');

			if (this.METERS.length === 0) {
				await this.fetchMeters();
				await this.fetchMetersHistory();
			}

			this.state.metersHistoryLoading = false;
			this.state.metersLoading = false;
		}
	}
</script>

<style lang="sass" scoped="">
.table thead th
	vertical-align: middle

.table td, .table th
	vertical-align: middle

.btn-group-toggle
	margin-bottom: 40px
</style>
