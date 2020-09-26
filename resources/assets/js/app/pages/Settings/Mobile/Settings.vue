<template>
	<article class="content">
		<header class="content_header">
			<h1 class="content_title">Настройки</h1>
		</header>
		<div class="content_body">
			<div class="row">
				<div class="col-md-12">
					<form method="post" accept-charset="utf-8">
						<div class="form-group">
							<h4>Уведомления от сервиса и администратора</h4>
							<div class="tumbler">
								<div class="smalltext hide-640">На email</div>
								<label class="tarif-label">
									<input @change="submitForm" type="checkbox" true-value="sms" false-value="email" v-model="settings.user_notification_method" class="tarif-checkbox">
									<span class="but"></span>
								</label>
								<div class="smalltext hide-640">По смс</div>
							</div>
						</div>
						<div class="form-group">
							<h4>Получать уведомления о новостях и событиях в поселке</h4>
							<label class="toggle-element">
								<input @change="submitForm" type="checkbox" true-value="1" false-value="0" v-model="settings.user_notification_news_events">
								<span class="icon-element-toggle-wrapper"><i class="icon-element-toggle"></i></span><br>
							</label>
						</div>
						<div class="form-group">
							<h4>Высылать письмо с квитанцией на оплату услуг ЖКХ.</h4>
							<label class="toggle-element">
								<input @change="submitForm" type="checkbox" true-value="1" false-value="0" v-model="settings.user_send_billing">
								<span class="icon-element-toggle-wrapper"><i class="icon-element-toggle"></i></span><br>
							</label>
						</div>
						<div class="form-group">
							<h4>Желаемое время для напоминаний сдачи показаний</h4>
							<div class="row">
								<div class="col-sm-7 row">
									<label class="col-sm-1">От</label>
									<div class="col-sm-4">
										<input @blur="submitForm" class="form-control" type="time" v-model="settings.user_notification_time_from">
									</div>
									<label class="col-sm-1">До</label>
									<div class="col-sm-4">
										<input @blur="submitForm" class="form-control" type="time" v-model="settings.user_notification_time_to">
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</article>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'
	import types from '@app/helpers/utils/types.utils'
	import Cleave from 'cleave.js';

	export default {

		data() {
			return {}
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
				'getSettings',
				'saveSettings'
			]),

			async submitForm() {
				this.saveSettings(this.settings);
			},
		},

		computed: {
			...mapGetters(['SETTINGS']),

			settings() {
				return this.SETTINGS;
			}
		},

		async mounted() {
			this.$store.commit('setDocumentTitle', 'Настройки');
			if (types.isEmpty(this.SETTINGS)) {
				await this.getSettings();
			}
		}
	}
</script>

<style lang="sass" scoped="">
	.form-group
		margin-bottom: 2rem

	.tumbler
		margin: 15px 0
		display: flex
		align-items: center

	.tarif-label
		display: inline-block
		width: 38px
		height: 14px
		position: relative
		border: 1px solid #ccd3db
		border-radius: 8px
		cursor: pointer
		padding: 0
		margin: 0 20px

	.tumbler .but
		width: 20px
		height: 20px
		position: absolute
		left: -2px
		top: -3px
		background-image: url(/images/icons/element-toggle-1.png)
		transition: .2s

	.tarif-checkbox:checked + .but
		left: 20px

	input[type=checkbox],
	input[type=radio]
		display: none

	.smalltext
		color: #5d6978
		font-size: 13px

	.icon-element-toggle-wrapper
		display: inline-block
		width: 38px
		height: 14px
		position: relative
		border: 1px solid #ccd3db
		border-radius: 8px
		cursor: pointer

	.icon-element-toggle-wrapper .icon-element-toggle
		width: 20px
		height: 20px
		position: absolute
		left: 0
		top: -3px
		background-image: url(/images/icons/element-toggle-0.png)
		transition: .2s

	.toggle-element
		cursor: pointer
		display: inline-block

		[type="checkbox"]:checked,
		[type="checkbox"]:not(:checked)
			position: relative
			-webkit-appearance: none
			width: 1px
			height: 1px
			clip: rect(0 0 0 0)
			padding-left: 0px
			cursor: pointer
			display: inline-block

		[type="checkbox"]:checked:focus,
		[type="checkbox"]:checked:active,
		[type="checkbox"]:not(:checked):focus,
		[type="checkbox"]:not(:checked):active
			outline: none

		/*.toggle-element.active .icon-payment-toggle {*/
		[type="checkbox"]:checked ~ .icon-element-toggle-wrapper .icon-element-toggle
			left: 20px
			background-image: url(/images/icons/element-toggle-1.png)
</style>
