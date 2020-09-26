<template>
	<v-modal
		v-if="showModal"
		@modalclose="modalClose"
		classmodal="modal--invoice"
	>
		<v-spinner
			v-if="dataLoading"
			:size="spinner_size"
			:speed="spinner_speed"
			:message="spinner_message"
		/>
		<template v-else>
			<table class="invoice">
				<tbody class="printable">
					<tr>
						<td colspan="14">
							Продавец: Дачное некоммерческое партнерство &laquo;Ламбери-Запад&raquo;<br />
							Адрес: 194292 г.Санкт-Петербург, 3-й Верхний переулок, дом 12, корп.1, лит.А, пом.1-Н <br /><br />
							ИНН/КПП: 7802794255 / 780201001<br />
							Расч.счет: 40703810700000023882<br />
							Банк: АО Банк &laquo;ПСКБ&raquo;<br />
							БИК: 044030852 Корр.счет: 30101810000000000852
						</td>
					</tr>
					<tr>
						<td colspan="14" class="invoice-header">
							Квитанция № {{ modalData.meters.currency && modalData.meters.currency.id }} от {{ modalData.meters.currency && modalData.meters.currency.date }} г.
						</td>
					</tr>
					<tr>
						<td colspan="14">Плательщик: {{ USER.attributes && USER.attributes.name }} ({{ AREA.attributes && AREA.attributes.address }})</td>
					</tr>
					<tr>
						<td colspan="2">Назначение платежа: </td>
						<td colspan="12" class="invoice-purpose">
							Членские взносы ДНП &quot;Ламбери-Запад&quot; за {{ modalData.meters.currency && modalData.meters.currency.month }} г.
						</td>
					</tr>
					<tr>
						<td colspan="14" class="invoice-details">Детализация взносов</td>
					</tr>
					<tr class="bordered">
						<th>№<br />п/п</th>
						<th colspan="6">Наименование</th>
						<th>Тариф</th>
						<th>Ед.<br />изм.</th>
						<th>Кол-во</th>
						<th width="10%" colspan="2">Цена</th>
						<th width="12%" colspan="2">Сумма с <br />учетом НДС</th>
					</tr>
					<tr class="bordered">
						<td class="text-right" rowspan="2">1</td>
						<td colspan="6" rowspan="2">Потребленная электроэнергия за {{ modalData.meters.currency && modalData.meters.currency.month }}г.</td>
						<td class="text-center">Т1</td>
						<td class="text-center">кВт.ч</td>
						<td class="text-right">{{ electricityCost }}</td>
						<td class="text-right" colspan="2">{{ modalData.tariff && modalData.tariff.electricity }} &#8381;</td>
						<td class="text-right" colspan="2">{{ electricityTotal }} &#8381;</td>
					</tr>
					<tr class="bordered">
						<td class="text-center">Т2</td>
						<td class="text-center">кВт.ч</td>
						<td class="text-right">{{ electricityNightCost }}</td>
						<td class="text-right" colspan="2">{{ modalData.tariff && modalData.tariff.electricity_night }} &#8381;</td>
						<td class="text-right" colspan="2">{{ electricityNightTotal }} &#8381;</td>
					</tr>
					<tr class="bordered">
						<td class="text-right">2</td>
						<td colspan="6">Потребленное водоснабжение за {{ modalData.meters.currency && modalData.meters.currency.month }}г.</td>
						<td class="text-center"></td>
						<td class="text-center">м<sup>3</sup></td>
						<td class="text-right">{{ calcWaterCost }}</td>
						<td class="text-right" colspan="2">{{ modalData.tariff && modalData.tariff.water }} &#8381;</td>
						<td class="text-right" colspan="2">{{ calcWaterTotal }} &#8381;</td>
					</tr>
					<tr>
						<td class="text-right" colspan="12">Всего по счету</td>
						<td class="bordered text-right total-sum" colspan="2">{{ total }} &#8381;</td>
					</tr>
					<tr>
						<td class="text-right" colspan="12">Задолженность</td>
						<td class="bordered text-right total-sum" colspan="2">0 &#8381;</td>
					</tr>
					<tr>
						<td class="text-right" colspan="12">Итого</td>
						<td class="bordered text-right total-sum" colspan="2">{{ total }} &#8381;</td>
					</tr>
					<tr>
						<td colspan="14"></td>
					</tr>
					<tr>
						<td class="text-right" colspan="2">Управляющий ДНП &quot;Ламбери-Запад&quot;</td>
						<td></td>
						<td></td>
						<td></td>
						<td class="text-center">Емельянов А.М.</td>
						<td colspan="4"></td>
						<td colspan="2">Главный бухгалтер</td>
						<td class="text-right" colspan="1">Крылова Н.И.</td>
					</tr>
					<tr>
						<td></td>
						<td>дов.№1 от 09.01.2020</td>
						<td></td>
						<td class="text-center border-top">Подпись</td>
						<td></td>
						<td class="text-center border-top">Ф.И.О.</td>
						<td></td>
						<td></td>
						<td class="border-top"></td>
						<td class="text-center border-top">Подпись</td>
						<td class="border-top" colspan="2"></td>
						<td class="text-center border-top" colspan="2">Ф.И.О.</td>
					</tr>
				</tbody>
			</table>
			<div class="btn-block">
				<a href="#" onclick="window.print()" class="btn btn-secondary">Печать</a>
				<router-link class="btn btn-success" :to="{name: 'paying'}">Оплатить через сервис</router-link>
			</div>
		</template>
	</v-modal>
</template>

<script>
	import types from '@app/helpers/utils/types.utils'
	import { mapActions, mapGetters } from 'vuex'

	export default {
		props: {
			showModalProp: {
				type: Boolean,
				default() {
					return false
				}
			},
			dataLoading: {
				type: Boolean,
				default() {
					return false
				}
			},
			modalData: {
				type: Object,
				default() {
					return {}
				}
			}
		},

		data() {
			return {
				spinner_size: 24,
				spinner_speed: 0.8,
				spinner_message: 'Загрузка',
				showModal: this.showModalProp,
			}
		},

		methods: {
			modalClose() {
				this.showModal = false;
				this.$emit('modalclose', false);
			},
		},

		computed: {
			...mapGetters([
				'USER',
				'AREA',
			]),

			calcWaterCost: function () {
				if (this.modalData.meters && this.modalData.meters.currency) {
					let waterCost = parseFloat(this.modalData.meters.currency.water - this.modalData.meters.prev.water).toFixed(2);
					if (waterCost > 0) {
						return waterCost;
					}
					return 0;
				}
			},
			electricityCost: function () {
				if (this.modalData.meters && this.modalData.meters.currency) {
					return parseFloat(this.modalData.meters.currency.electricity - this.modalData.meters.prev.electricity).toFixed(2);
				}
			},
			electricityNightCost: function () {
				if (this.modalData.meters && this.modalData.meters.currency) {
					return parseFloat(this.modalData.meters.currency.electricity_night - this.modalData.meters.prev.electricity_night).toFixed(2);
				}
			},
			calcWaterTotal: function () {
				if (this.modalData.tariff && this.modalData.tariff.water) {
					return parseFloat(this.modalData.tariff.water * this.calcWaterCost).toFixed(2);
				}
			},
			electricityTotal: function () {
				if (this.modalData.tariff && this.modalData.tariff.electricity) {
					return parseFloat(this.modalData.tariff.electricity * this.electricityCost).toFixed(2);
				}
			},
			electricityNightTotal: function () {
				if (this.modalData.tariff && this.modalData.tariff.electricity_night) {
					return parseFloat(this.modalData.tariff.electricity_night * this.electricityNightCost).toFixed(2);
				}
			},
			total: function () {
				return (this.calcWaterTotal + this.electricityTotal + this.electricityNightTotal).toFixed(2);
			},
		},

		mounted() {

		}
	}
</script>

<style lang="sass" scoped="">

	.invoice
		width: 100%
		margin-bottom: 40px
		border-collapse: collapse
		color: #000
		font-family: Calibri, Verdana, Arial

		tr

			&.bordered

				th,
				td
					border-top: 1px solid #000!important
					border-bottom: 1px solid #000
					border-left: 1px solid #000
					border-right: 1px solid #000

			th,
			td
				height: 24px
				padding-right: 10px
				padding-left: 10px
				vertical-align: middle

				&:not([class])
					border-top: none
					padding: 0 10px

				&.bordered
					border-top: 1px solid #000
					border-bottom: 1px solid #000
					border-left: 1px solid #000
					border-right: 1px solid #000

				&.border-top
					border-top: 1px solid #000!important

				&.total-sum
					font-weight: bold
					font-size: 14px

			th
				height: 40px
				text-align: center
				font-family: inherit!important

	.invoice-header
		padding-top: 24px
		padding-bottom: 20px
		font-size: 18px
		font-weight: bold
		text-align: center

	.invoice-purpose
		font-weight: bold
		text-decoration: underline
		font-size: 16px

	.invoice-details
		padding-top: 24px
		padding-bottom: 24px
		text-align: center
		font-weight: bold
		font-size: 16px
		text-transform: uppercase

	.btn-block

		@media print
			display: none

</style>
