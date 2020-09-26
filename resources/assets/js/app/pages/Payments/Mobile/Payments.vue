<template>
	<article class="content">

		<BalanceWidget />

		<header class="content_header">
			<h1 class="content_title">
				Квитанции и платежи
				<a href="javascript:;" @click="paymentsRefresh()" title="Обновить" class="btn btn-success"><i class="fa fa-refresh"></i></a>
			</h1>
		</header>
		<div class="content_body">
			<v-spinner
				v-if="state.paymentsLoading"
				:size="spinner_size"
				:speed="spinner_speed"
				:message="spinner_message"
			/>
			<template v-else>
				<table class="table">
					<thead>
						<tr>
							<th width="20%">Дата</th>
							<th>Операция</th>
							<th>Сумма, руб.</th>
							<th>Баланс, руб.</th>
						</tr>
					</thead>
					<tbody>

						<tr :key="payment.id" v-for="payment in PAYMENTS">
							<td>
								{{ payment.created_at | moment('DD.MM.YYYY') }}
							</td>
							<td>
								<a href="javascript:;" @click="setShowModal(payment.created_at)" v-if="payment.operation == 0"> {{ payment.description }} <i class="fa fa-search"></i></a>
								<span v-else>{{ payment.description }}</span>
							</td>
							<td>{{ payment.operation == 0 ? '-' + payment.amount : payment.amount }}</td>
							<td>{{ payment.balance }}</td>
						</tr>

					</tbody>
				</table>

				<InvoiceModal
					v-if="showModal"
					@modalclose="modalClose"
					:showModalProp="showModal"
					:dataLoading="state.paymentsMonthLoading"
					:modalData="modalData"
				/>

			</template>
			<!-- <h4>Задачи</h4>
			<ul>
				<li>Видеть сумму задолженности/переплаты</li>
				<li>Получать счета на оплату</li>
				<li>Оплачивать счета через сервис</li>
				<li>Видеть историю платежей</li>
			</ul> -->
		</div>
	</article>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'
	import BalanceWidget from '@components/Widgets/Balance'
	import InvoiceModal from '@components/Modals/Invoice'

	export default {

		data() {
			return {
				spinner_size: 24,
				spinner_speed: 0.8,
				spinner_message: 'Загрузка',
				state: {
					paymentsLoading: true,
					paymentsMonthLoading: true
				},
				showModal: false,
				modalData: null,
			}
		},

		components: {
			BalanceWidget,
			InvoiceModal,
		},

		methods: {
			...mapActions([
				'getPayments',
				'getMonthPayment',
			]),

			capitalize(s) {
				if (typeof s !== 'string') return '';
				return s.charAt(0).toUpperCase() + s.slice(1);
			},

			async fetchPayments() {
				this.state.paymentsLoading = true;
				await this.getPayments('year');
				this.state.paymentsLoading = false;
			},

			async paymentsRefresh() {
				await this.fetchPayments();
			},

			async setShowModal(date) {
				this.showModal = true;
				this.state.paymentsMonthLoading = true;
				await this.getMonthPayment(date);
				this.modalData = this.MONTH_PAYMENT;
				this.state.paymentsMonthLoading = false;
			},

			modalClose() {
				this.showModal = false;
			},
		},

		computed: {
			...mapGetters([
				'MONTH_PAYMENT',
				'PAYMENTS'
			]),
		},

		async mounted() {
			if (this.PAYMENTS.length === 0) {
				await this.fetchPayments();
			}
			this.state.paymentsLoading = false;

			this.$store.commit('setDocumentTitle', 'Баланс и оплата');
		}
	}
</script>

<style lang="sass" scoped="">
	.fa-search
		margin-left: 5px
</style>
