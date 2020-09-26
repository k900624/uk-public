<template>
	<article class="content">
		<header class="content_header">
			<h1 class="content_title">Оплата</h1>
		</header>
		<div class="content_body">
			<h3>Квитанция Сбербанка РФ</h3>
			<img src="/images/elements/sberbank.png" alt="">
			<p>Печать квитанции для перевода оплаты через отделение Сбербанка</p>
			<div class="form-inline">
				<div class="form-group mb-2">
					<label for="inputPayment1">Сумма для оплаты</label>
				</div>
				<div class="form-group mx-sm-3 mb-2">
					<input
						v-cleave="{numeral: true, numeralThousandsGroupStyle: 'thousand'}"
						type="text"
						class="form-control"
						id="inputPayment1">&nbsp;&nbsp;руб.
				</div>
				<button type="submit" class="btn btn-primary mb-2">Оплатить</button>
			</div>

			<hr>

			<h3>Яндекс.Деньги</h3>
			<img src="/images/elements/YandexMoney.png" alt="">
			<p>Оплата банковской картой или Яндекс.Деньгами через <a href="">сервис приема платежей Яндекса.</a></p>
			<p>Комиссия: 2%, но не менее 30 руб. <br>Срок зачисления: 2 - 3 рабочих дня.</p>
			<div class="form-inline">
				<div class="form-group mb-2">
					<label for="inputPayment2" >Сумма для оплаты</label>
				</div>
				<div class="form-group mx-sm-3 mb-2">
					<input
						v-cleave="{numeral: true, numeralThousandsGroupStyle: 'thousand'}"
						type="text"
						class="form-control"
						id="inputPayment1">&nbsp;&nbsp;руб.
				</div>
				<button type="submit" class="btn btn-primary mb-2">Оплатить</button>
			</div>
		</div>
	</article>
</template>

<script>
	import Cleave from 'cleave.js'

	export default {

		data() {
			return {
				state: {

				}
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

		},

		mounted() {
			this.$store.commit('setDocumentTitle', 'Оплата');
		}
	}
</script>
