<template>
	<article class="content">
		<header class="content_header">
			<h1 class="content_title">
				Мои данные
				<a href="javascript:;" @click="contactsRefresh()" title="Обновить" class="btn btn-success"><i class="fa fa-refresh"></i></a>
			</h1>
		</header>
		<div class="content_body">
			<div class="row">
				<div class="col-md-12" v-if="errorsContacts">
					<ul class="alert alert-danger">
						<li v-if="AREA.attributes && ! AREA.attributes.contract_number">Номер договора не указан!</li>
						<li v-if="USER.attributes && ! USER.attributes.email">Email адрес не указан!</li>
						<li v-if="USER.profile && ! USER.profile.phone">Номер телефона не указан!</li>
					</ul>
				</div>
				<div class="col-md-3">
					<avatar :fullname="USER.attributes && USER.attributes.name" :size="160" v-if="isEmptyAvatar" />
					<avatar :image="'/storage/' + USER.profile.avatar" :size="160" color="#e6e6e6" v-else />
				</div>
				<div class="col-md-8">
					<legend>Персональная информация</legend>
					<table class="table">
						<tr>
							<th>ФИО</th>
							<td class="text-center"><i class="fa fa-user"></i></td>
							<td colspan="2">{{ USER.attributes && USER.attributes.name }}</td>
						</tr>
						<tr>
							<th>Email</th>
							<td class="text-center"><i class="fa fa-envelope"></i></td>
							<td colspan="2"><a :href="`mailto:${ USER.attributes && USER.attributes.email }`">{{ USER.attributes && USER.attributes.email }}</a></td>
						</tr>
						<tr v-if="AREA.attributes && AREA.attributes.address">
							<th>Адрес</th>
							<td class="text-center"><i class="fa fa-map-marker"></i></td>
							<td colspan="2">{{ AREA.attributes.address }}</td>
						</tr>
						<template v-if="USER.attributes && USER.attributes.main_user == 'on'">
							<tr v-if="AREA.attributes && AREA.attributes.contract_number">
								<th>Договор</th>
								<td class="text-center"><i class="fa fa-barcode"></i></td>
								<td colspan="2">{{ AREA.attributes.contract_number }} от {{ AREA.attributes.contract_date }}</td>
							</tr>
							<tr v-if="AREA.attributes && AREA.attributes.land_area">
								<th>Площадь участка / дома, сот.</th>
								<td class="text-center"><i class="fa fa-pie-chart"></i></td>
								<td colspan="2">{{ AREA.attributes.land_area }} / {{ AREA.attributes.house_area }}</td>
							</tr>
							<tr v-if="AREA.attributes && AREA.attributes.quantity_residents">
								<th>Кол-во проживающих</th>
								<td class="text-center"><i class="fa fa-users"></i></td>
								<td colspan="2">{{ AREA.attributes.quantity_residents }}</td>
							</tr>
							<template v-if="AREA.attributes && AREA.attributes.сounters">
								<legend>Счетчики</legend>
								<tr>
									<th>Вода</th>
									<td class="text-center"><i class="fa fa-dashboard"></i></td>
									<td colspan="2">
										<ul>
											<li>№ счетчика: {{ AREA.attributes.сounters.water_number }}</li>
											<li>Дата поверки: {{ AREA.attributes.сounters.water_verify_date | moment('DD.MM.YYYY') }}</li>
											<li>Начальные показания: {{ AREA.attributes.сounters.water_first_meter }} м<sup>3</sup></li>
										</ul>
									</td>
								</tr>
								<tr>
									<th>Электроэнергия</th>
									<td class="text-center"><i class="fa fa-dashboard"></i></td>
									<td colspan="2">
										<ul>
											<li>№ счетчика: {{ AREA.attributes.сounters.electr_number }}</li>
											<li>Дата поверки: {{ AREA.attributes.сounters.electr_verify_date | moment('DD.MM.YYYY') }}</li>
											<li>Начальные показания: {{ AREA.attributes.сounters.electr_first_meter }} м<sup>3</sup></li>
										</ul>
									</td>
								</tr>
							</template>
						</template>

						<legend>Контактная информация</legend>

						<tr v-if="USER.profile && USER.profile.phone">
							<th>Номер телефона</th>
							<td class="text-center"><i class="fa fa-phone"></i></td>
							<td><a :href="`tel:${ tel(USER.profile.phone) }`">{{ USER.profile.phone }}</a></td>
							<td><a href="javascript:;" v-if="USER.profile.phone_verified === false"><small>Подтвердить номер</small></a></td>
						</tr>
						<tr v-if="USER.profile && USER.profile.phone2">
							<th>Номер телефона (экстренный)</th>
							<td class="text-center"><i class="fa fa-phone"></i></td>
							<td colspan="2"><a :href="`tel:${ tel(USER.profile.phone2) }`">{{ USER.profile.phone2 }}</a></td>
						</tr>
						<tr v-if="USER.profile && USER.profile.vkontakte">
							<th>ВКонтакте</th>
							<td class="text-center"><i class="fa fa-vk"></i></td>
							<td colspan="2"><a target="_blank" :href="prepUrl(USER.profile.vkontakte)">{{ USER.profile.vkontakte }}</a></td>
						</tr>
						<tr v-if="USER.profile && USER.profile.facebook">
							<th>Facebook</th>
							<td class="text-center"><i class="fa fa-facebook-official"></i></td>
							<td colspan="2"><a target="_blank" :href="prepUrl(USER.profile.facebook)">{{ USER.profile.facebook }}</a></td>
						</tr>
						<tr v-if="USER.profile && USER.profile.twitter">
							<th>Twitter</th>
							<td class="text-center"><i class="fa fa-twitter"></i></td>
							<td colspan="2"><a target="_blank" :href="prepUrl(USER.profile.twitter)">{{ USER.profile.twitter }}</a></td>
						</tr>
						<tr v-if="USER.profile && USER.profile.odnoklassniki">
							<th>Одноклассники</th>
							<td class="text-center"><i class="fa fa-odnoklassniki"></i></td>
							<td colspan="2"><a target="_blank" :href="prepUrl(USER.profile.odnoklassniki)">{{ USER.profile.odnoklassniki }}</a></td>
						</tr>
						<tr v-if="USER.profile && USER.profile.telegram">
							<th>Telegram</th>
							<td class="text-center"><i class="fa fa-telegram"></i></td>
							<td colspan="2"><a target="_blank" :href="prepUrl(USER.profile.telegram)">{{ USER.profile.telegram }}</a></td>
						</tr>
					</table>

					<router-link class="btn btn-primary" :to="{name: 'editForm'}">Изменить контакты</router-link>

				</div>
			</div>
		</div>
	</article>
</template>

<script>
	import types from '@app/helpers/utils/types.utils'
	import Avatar from 'vue-avatar-component'
	import { mapActions, mapGetters } from 'vuex'

	export default {

		data() {
			return {
				state: {

				},
				errorsContacts: false,
			}
		},

		methods: {

			...mapActions([
				'getUser',
				'getArea',
			]),

			tel(str) {
				return str.replace(/[^0-9+]/g, '');
			},

			prepUrl(url) {
				let prefix = 'http://';
				url = this.trimChar(url, '/');
				if (!/^https?:\/\//i.test(url)) {
					url = prefix + url;
				}
				return url;
			},

			removeHttp(url) {
				url = this.trimChar(url, '/');
				return url.replace(/(^\w+:|^)\/\//, '');
			},

			trimChar(string, charToRemove) {
				while (string.charAt(0) == charToRemove) {
					string = string.substring(1);
				}
				while (string.charAt(string.length-1) == charToRemove) {
					string = string.substring(0, string.length-1);
				}
				return string;
			},

			// TODO перенести логику в store
			isErrorsContacts() {
				this.errorsContacts = false;

				if (this.USER && this.USER.attributes && this.USER.profile) {
					if ('email' in this.USER.attributes === false) this.errorsContacts = true;
					if ('phone' in this.USER.profile === false) this.errorsContacts = true;
				}
				if (this.AREA && this.AREA.attributes) {
					if ('contract_number' in this.AREA.attributes === false) this.errorsContacts = true;
				}
			},

			async contactsRefresh() {
				await this.getUser();
				await this.getArea();
			},
		},

		components: {
			Avatar,
		},

		computed: {
			...mapGetters([
				'USER',
				'AREA',
			]),

			isEmptyAvatar() {
				return ! this.USER.profile || ! this.USER.profile.avatar;
			},
		},

		async mounted() {
			this.$store.commit('setDocumentTitle', 'Мои данные');

			if (types.isEmpty(this.USER)) {
				await this.getUser();
			}
			if (types.isEmpty(this.AREA)) {
				await this.getArea();
			}
			this.isErrorsContacts();
		}
	}
</script>

<style lang="sass" scoped="">
	.table td,
	.table th
		padding: .75rem

	.text-center
		text-align: center
		font-size: 16px
</style>
