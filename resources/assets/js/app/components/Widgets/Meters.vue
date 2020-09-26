<template>
	<div class="balance-block">

		<a href="javascript:;" @click="showModal = true" class="btn btn-success">Подать показания счетчика водоснабжения за {{ METERS.currencyMonth }} {{ METERS.currencyYear}} года</a>

		<v-modal
			v-if="showModal"
			@modalclose="modalClose"
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
		</v-modal>

	</div>
</template>

<script>
	import types from '@app/helpers/utils/types.utils'
	import { mapGetters } from 'vuex'
	import InvoiceModal from '@components/Modals/Invoice'
	import Cleave from 'cleave.js'

	export default {
		data() {
			return {
				showModal: false,
				state: {
					lastPaymentsLoading: true,
				},
				metersData: {
					water: 0,
				},
				errors: {},
			}
		},

		components: {
			InvoiceModal,
			Cleave
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

		computed: {
			...mapGetters([
				'METERS',
				'AREA',
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

		methods: {

			modalClose() {
				this.showModal = false;
			},
		}
	}
</script>

<style lang="sass" scoped="">
	.balance-block
		margin: 0 auto 20px
		padding: 30px 40px 10px
		display: grid
		grid-template-columns: auto
		grid-column-gap: 35px
		grid-template-rows: auto auto
		border-radius: 3px
		background: #fff4d3
		box-shadow: 0 0 3px 1px rgba(0, 0, 0, .1)

		@media print
			display: none

	.btn ~ .btn
		margin-left: 5px

</style>
