<template>
	<div class="balance-block">
		<div class="balance-block_title-balance">
			Баланс <span>{{ BALANCE.balanceSum }} руб.</span>
		</div>
		<div class="balance-block_pay-buttons">
			<div class="balance-block_pay-button">
				<router-link class="btn btn-secondary" :to="{name: 'paying'}">Пополнить баланс</router-link>
				<br> <p>Пополнить баланс можно на любую сумму</p>
			</div>
			<a href="javascript:;" class="btn btn-secondary" @click="showModal = true">Квитанция</a>
			<router-link v-if="BALANCE.isDebt" class="btn btn-success" :to="{name: 'paying'}">Оплатить {{ BALANCE.balanceSum }} руб.</router-link>
		</div>

		<InvoiceModal
			v-if="showModal"
			@modalclose="modalClose"
			:showModalProp="showModal"
			:dataLoading="state.lastPaymentsLoading"
			:modalData="LAST_PAYMENT"
		/>
	</div>
</template>

<script>
	import types from '@app/helpers/utils/types.utils'
	import { mapActions, mapGetters } from 'vuex'
	import InvoiceModal from '@components/Modals/Invoice'

	export default {
		data() {
			return {
				showModal: false,
				state: {
					lastPaymentsLoading: true,
				},
			}
		},

		components: {
			InvoiceModal
		},

		computed: {
			...mapGetters([
				'USER',
				'AREA',
				'BALANCE',
				'LAST_PAYMENT',
			]),
		},

		methods: {
			...mapActions([
				'getLastPayment',
			]),

			modalClose() {
				this.showModal = false;
			},
		},

		async mounted() {
			if (types.isEmpty(this.BALANCE)) {
				await this.$store.dispatch('getBalance');
			}

			if (types.isEmpty(this.LAST_PAYMENT)) {
				await this.getLastPayment(this.date);
			}

			this.state.lastPaymentsLoading = false;
		}
	}
</script>

<style lang="sass" scoped="">
	.balance-block
		margin: 0 auto 20px
		padding: 30px 40px 10px
		display: grid
		grid-template-columns: auto auto
		grid-column-gap: 35px
		grid-template-rows: auto auto
		border-radius: 3px
		background: #fff4d3
		box-shadow: 0 0 3px 1px rgba(0, 0, 0, .1)

		@media print
			display: none

		&_pay-buttons
			display: flex

	.balance-block_title-name,
	.balance-block_name,
	.balance-block_title-balance,
	.balance-block_balance,
	.balance-block_title-address,
	.balance-block_address
		padding-bottom: 25px
		display: flex
		align-items: center
		font-size: 16px
		font-weight: normal

	.balance-block_title-name,
	.balance-block_title-balance,
	.balance-block_title-address
		font-weight: bold

		span
			margin-left: 5px

	.btn ~ .btn
		margin-left: 5px

</style>
