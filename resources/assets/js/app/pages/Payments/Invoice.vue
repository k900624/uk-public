<template>
	<article class="content">
		<div class="content_body">

			<v-spinner
				v-if="state.lastPaymentsLoading"
				:size="spinner_size"
				:speed="spinner_speed"
				:message="spinner_message"
			/>
			<template v-else>
				<table class="invoice">
					<tbody>
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
								Квитанция № {{ LAST_PAYMENT.payment && LAST_PAYMENT.payment.id }} от {{ LAST_PAYMENT.payment && LAST_PAYMENT.payment.date }} г.
							</td>
						</tr>
						<tr>
							<td colspan="14">Плательщик: {{ USER.attributes && USER.attributes.name }} ({{ AREA.attributes && AREA.attributes.address }})</td>
						</tr>
						<tr>
							<td colspan="2">Назначение платежа: </td>
							<td colspan="12" class="invoice-purpose">
								Членские взносы ДНП &quot;Ламбери-Запад&quot; за {{ LAST_PAYMENT.payment && LAST_PAYMENT.payment.month }} г.
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
							<td colspan="6" rowspan="2">Потребленная электроэнергия за {{ LAST_PAYMENT.payment && LAST_PAYMENT.payment.month }}г.</td>
							<td class="text-center">Т1</td>
							<td class="text-center">кВт.ч</td>
							<td class="text-right">{{ electricityCost }}</td>
							<td class="text-right" colspan="2">{{ LAST_PAYMENT.payment && LAST_PAYMENT.tariff.electricity }} &#8381;</td>
							<td class="text-right" colspan="2">{{ electricityTotal }} &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-center">Т2</td>
							<td class="text-center">кВт.ч</td>
							<td class="text-right">{{ electricityNightCost }}</td>
							<td class="text-right" colspan="2">{{ LAST_PAYMENT.payment && LAST_PAYMENT.tariff.electricity_night }} &#8381;</td>
							<td class="text-right" colspan="2">{{ electricityNightTotal }} &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">2</td>
							<td colspan="6">Потребленное водоснабжение за {{ LAST_PAYMENT.payment && LAST_PAYMENT.payment.month }}г.</td>
							<td class="text-center"></td>
							<td class="text-center">м<sup>3</sup></td>
							<td class="text-right">{{ calcWaterCost }}</td>
							<td class="text-right" colspan="2">{{ LAST_PAYMENT.payment && LAST_PAYMENT.tariff.water }} &#8381;</td>
							<td class="text-right" colspan="2">{{ calcWaterTotal }} &#8381;</td>
						</tr>
						<!-- <tr class="bordered">
							<td class="text-right">3</td>
							<td colspan="6">Обслуживание внутрипоселковых и подъездной дорог, тротуаров, пешеходных дорожек (работа спец. техники )</td>
							<td class="text-center" colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">708,05 &#8381;</td>
							<td class="text-right" colspan="2">708,05 &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">4</td>
							<td colspan="6">Уборка общественной территории</td>
							<td class="text-center" colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">1&nbsp;434,10 &#8381;</td>
							<td class="text-right" colspan="2">1&nbsp;434,10 &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">5</td>
							<td colspan="6">Хозяйственные расходы</td>
							<td class="text-center" colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">528,04 &#8381;</td>
							<td class="text-right" colspan="2">528,04 &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">6</td>
							<td colspan="6">Обслуживание техники</td>
							<td class="text-center" colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">804,05 &#8381;</td>
							<td class="text-right" colspan="2">804,05 &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">7</td>
							<td colspan="6">Обслуживание внутрипоселковых коммунальных сетей</td>
							<td class="text-center" colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">984,07 &#8381;</td>
							<td class="text-right" colspan="2">984,07 &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">8</td>
							<td colspan="6">Уход за живыми насаждениями и зонами отдыха</td>
							<td class="text-center" colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">864,06 &#8381;</td>
							<td class="text-right" colspan="2">864,06 &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">9</td>
							<td colspan="6">Вывоз мусора</td>
							<td class="text-center" colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">600,04 &#8381;</td>
							<td class="text-right" colspan="2">600,04 &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">10</td>
							<td colspan="6">Дежурство в поселке вахтовым методом</td>
							<td class="text-center" colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">1&nbsp;502,12 &#8381;</td>
							<td class="text-right" colspan="2">1&nbsp;502,12 &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">11</td>
							<td colspan="6">Обслуживание противопожарного оборудования</td>
							<td class="text-center"colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">1&nbsp;005,00 &#8381;</td>
							<td class="text-right" colspan="2">1&nbsp;005,00 &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">12</td>
							<td colspan="6">Ведение договорной работы с поставщиками и потребителями коммунальных услуг</td>
							<td class="text-center" colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">367,68 &#8381;</td>
							<td class="text-right" colspan="2">367,68 &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">13</td>
							<td colspan="6">Услуги Управляющего поселка</td>
							<td class="text-center" colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">1&nbsp;788,12 &#8381;</td>
							<td class="text-right" colspan="2">1&nbsp;788,12 &#8381;</td>
						</tr>
						<tr class="bordered">
							<td class="text-right">14</td>
							<td colspan="6">Ведение бухгалтерского учета</td>
							<td class="text-center" colspan="2">усл.</td>
							<td class="text-right">1</td>
							<td class="text-right" colspan="2">660,05 &#8381;</td>
							<td class="text-right" colspan="2">660,05 &#8381;</td>
						</tr> -->
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
		</div>
	</article>
</template>

<script>
	import types from '@app/helpers/utils/types.utils'
	import { mapActions, mapGetters } from 'vuex'

	export default {
		props: {
			date: {
				type: String,
				default() {
					return ''
				}
			}
		},

		data() {
			return {
				state: {
					lastPaymentsLoading: true,
				},
				spinner_size: 24,
				spinner_speed: 0.8,
				spinner_message: 'Загрузка',
			}
		},

		methods: {
			...mapActions([
				'getLastPayment',
			]),
		},

		computed: {
			...mapGetters([
				'USER',
				'AREA',
				'LAST_PAYMENT',
			]),

			calcWaterCost: function () {
				if (this.LAST_PAYMENT.meters && this.LAST_PAYMENT.meters.currency) {
					let waterCost = parseFloat(this.LAST_PAYMENT.meters.currency.water - this.LAST_PAYMENT.meters.prev.water).toFixed(2);
					if (waterCost > 0) {
						return waterCost;
					}
					return 0;
				}
			},
			electricityCost: function () {
				if (this.LAST_PAYMENT.meters && this.LAST_PAYMENT.meters.currency) {
					return parseFloat(this.LAST_PAYMENT.meters.currency.electricity - this.LAST_PAYMENT.meters.prev.electricity).toFixed(2);
				}
			},
			electricityNightCost: function () {
				if (this.LAST_PAYMENT.meters && this.LAST_PAYMENT.meters.currency) {
					return parseFloat(this.LAST_PAYMENT.meters.currency.electricity_night - this.LAST_PAYMENT.meters.prev.electricity_night).toFixed(2);
				}
			},
			calcWaterTotal: function () {
				if (this.LAST_PAYMENT.tariff && this.LAST_PAYMENT.tariff.water) {
					return parseFloat(this.LAST_PAYMENT.tariff.water * this.calcWaterCost).toFixed(2);
				}
			},
			electricityTotal: function () {
				if (this.LAST_PAYMENT.tariff && this.LAST_PAYMENT.tariff.electricity) {
					return parseFloat(this.LAST_PAYMENT.tariff.electricity * this.electricityCost).toFixed(2);
				}
			},
			electricityNightTotal: function () {
				if (this.LAST_PAYMENT.tariff && this.LAST_PAYMENT.tariff.electricity_night) {
					return parseFloat(this.LAST_PAYMENT.tariff.electricity_night * this.electricityNightCost).toFixed(2);
				}
			},
			total: function () {
				return (this.calcWaterTotal + this.electricityTotal + this.electricityNightTotal).toFixed(2);
			},
		},

		async mounted() {
			if (types.isEmpty(this.LAST_PAYMENT)) {
				await this.getLastPayment(this.date);
			}

			this.state.lastPaymentsLoading = false;

			this.$store.commit('setDocumentTitle', 'Счет на оплату');
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
					border-top: 1px solid #000
					border-bottom: 1px solid #000
					border-left: 1px solid #000
					border-right: 1px solid #000

			th,
			td
				height: 24px
				padding-right: 10px
				padding-left: 10px
				vertical-align: middle

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
