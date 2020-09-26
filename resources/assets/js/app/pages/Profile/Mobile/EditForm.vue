<template>
	<article class="content">
		<header class="content_header">
			<h1 class="content_title">Мои данные</h1>
		</header>
		<div class="content_body">
			<div v-if="userData">
				<div class="row">
					<div class="col-md-3">
						<div class="avatar">
							<img class="img-rounded img-responsive" v-if="userData.avatar" :src="'/storage/' + userData.avatar">
							<button id="pick-avatar" class="btn btn-primary btn-sm" v-if="userData.avatar">Сменить изображение</button>
							<button id="pick-avatar" class="btn btn-primary btn-sm" v-else>Выбрать изображение</button>
							<avatar-cropper
								@uploaded="avatarHandleUploaded"
								@uploading="avatarHandleUploading"
								@error="avatarHandlerError"
								trigger="#pick-avatar"
								:labels="{ submit: 'Отправить', cancel: 'Отмена'}"
								:upload-url="routes('api.user.avatar.store', USER.id)" />
						</div>
						<div class="text-muted" v-html="message"></div>
					</div>
					<div class="col-md-6">

						<form @submit.prevent="submitForm" method="post" accept-charset="utf-8">
							<fieldset>

								<div class="form-group row">
									<label class="col-sm-4 control-label" for="phone">Телефон</label>
									<div class="col-sm-8">
										<input type="text" v-model.trim="userData.phone" id="phone" class="form-control" @blur="$v.$touch()">
										<small
											class="text-danger"
											v-if="$v.userData.phone.$dirty && ! $v.userData.phone.required"
										>Поле обязательно для заполнения</small>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 control-label" for="phone2">Телефон <small>(экстренный)</small></label>
									<div class="col-sm-8">
										<input type="text" v-model.trim="userData.phone2" id="phone2" class="form-control" @blur="$v.$touch()">
										<small
											class="text-danger"
											v-if="$v.userData.phone2.$dirty && ! $v.userData.phone2.required"
										>Поле обязательно для заполнения</small>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 control-label" for="vkontakte">ВКонтакте</label>
									<div class="col-sm-8">
										<input type="text" v-model.trim="userData.vkontakte" id="vkontakte" class="form-control" @blur="$v.$touch()">
										<small
											class="text-danger"
											v-if="$v.userData.vkontakte.$dirty && ! $v.userData.vkontakte.url"
										>Поле имеет ошибочный формат</small>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 control-label" for="facebook">Facebook</label>
									<div class="col-sm-8">
										<input type="text" v-model.trim="userData.facebook" id="facebook" class="form-control" @blur="$v.$touch()">
										<small
											class="text-danger"
											v-if="$v.userData.facebook.$dirty && ! $v.userData.facebook.url"
										>Поле имеет ошибочный формат</small>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 control-label" for="twitter">Twitter</label>
									<div class="col-sm-8">
										<input type="text" v-model.trim="userData.twitter" id="twitter" class="form-control" @blur="$v.$touch()">
										<small
											class="text-danger"
											v-if="$v.userData.twitter.$dirty && ! $v.userData.twitter.url"
										>Поле имеет ошибочный формат</small>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 control-label" for="odnoklassniki">Одноклассники</label>
									<div class="col-sm-8">
										<input
											type="text"
											v-model.trim="userData.odnoklassniki"
											id="odnoklassniki"
											class="form-control"
											@blur="$v.$touch()"
										>
										<small
											class="text-danger"
											v-if="$v.userData.odnoklassniki.$dirty && ! $v.userData.odnoklassniki.url"
										>Поле имеет ошибочный формат</small>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 control-label" for="telegram">Telegram</label>
									<div class="col-sm-8">
										<input
											type="text"
											@blur="$v.$touch()"
											v-model.trim="userData.telegram"
											id="telegram"
											class="form-control"
										>
										<small
											class="text-danger"
											v-if="$v.userData.telegram.$dirty && ! $v.userData.telegram.url"
										>Поле имеет ошибочный формат</small>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 control-label" for="password_new">Смена пароля</label>
									<div class="col-sm-8">
										<div class="input-group">
											<input
												:type="password.type"
												v-model.trim="password.new"
												@blur="$v.$touch()"
												id="password_new"
												class="form-control">
											<div class="input-group-append">
												<a href="javascript:;" class="btn btn-light" title="Скрыть/Показать" @click="changeType()"><i :class="password.icon"></i></a>
												<a href="javascript:;" class="btn btn-secondary" title="Сгенерировать" @click="generate()"><i class="fa fa-refresh"></i></a>
											</div>
										</div>
										<small
											class="text-danger"
											v-if="$v.password.new.$dirty && !$v.password.new.minLength"
										>Поле должно быть не менее {{$v.password.new.$params.minLength.min}} символов</small>

										<small class="form-text text-muted">Введите новый пароль или сгенерируйте</small>
									</div>
								</div>

							</fieldset>

							<div class="row my-4">
								<div class="form-actions col-sm-8 offset-sm-4">
									<input type="submit" name="submit" value="Сохранить" class="btn btn-success">
									<router-link class="btn btn-secondary" :to="{name: 'personal'}">Отмена</router-link>
								</div>
							</div>

						</form>

					</div>
				</div>
			</div>
		</div>
	</article>
</template>

<script>
	import types from '@app/helpers/utils/types.utils'
	import AvatarCropper from "vue-avatar-cropper"
	import route from '@app/route'
	import { url, required, minLength } from 'vuelidate/lib/validators'
	import { mapActions, mapGetters } from 'vuex'

	export default {

		data() {
			return {
				state: {
					password_show: false
				},
				message: "",
				password: {
					new: '',
					type: 'password',
					icon: 'fa fa-eye-slash',
					characters: 'a-z,A-Z,0-9',
					size: 8
				}
			}
		},

		validations: {
			userData: {
				phone: { required },
				phone2: { required },
				vkontakte: { url },
				facebook: { url },
				twitter: { url },
				odnoklassniki: { url },
				telegram: { url },
			},
			password: {
				new: { minLength: minLength(8) }
			}
		},

		methods: {

			...mapActions([
				'getUser',
				'saveUser'
			]),

			async submitForm() {
				if (this.$v.$invalid) {
					this.$v.$touch();
					return;
				}

				this.userData.password_new = this.password.new;

				this.saveUser(this.userData);
			},

			avatarHandleUploading(form, xhr) {
				this.message = "Uploading...";
			},
			avatarHandleUploaded(response) {
				if (response.status == "success") {
					this.userData.avatar = response.url;
					this.message = "User avatar updated.";
				}
			},
			avatarHandlerError(message, type, xhr) {
				this.message = "Oops! Something went wrong...";
			},

			routes(name, params) {
				return route(name, params);
			},

			generate() {
				let charactersArray = this.password.characters.split(','),
					characterSet = '',
					password = '';

				if (charactersArray.indexOf('a-z') >= 0) {
					characterSet += 'abcdefghijklmnopqrstuvwxyz';
				}
				if (charactersArray.indexOf('A-Z') >= 0) {
					characterSet += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				}
				if (charactersArray.indexOf('0-9') >= 0) {
					characterSet += '0123456789';
				}
				if (charactersArray.indexOf('#') >= 0) {
					characterSet += '![]{}()%&*$#^<>~@|';
				}

				for (let i=0; i < this.password.size; i++) {
					password += characterSet.charAt(Math.floor(Math.random() * characterSet.length));
				}
				this.password.new = password;
			},

			changeType() {
				this.state.password_show = ! this.state.password_show;
				this.password.type = this.state.password_show ? 'text' : 'password';
				this.password.icon = this.state.password_show ? 'fa fa-eye' : 'fa fa-eye-slash';
			},
		},

		components: {
			AvatarCropper,
		},

		computed: {
			...mapGetters([
				'USER',
			]),

			userData() {
				if (this.USER) {
					return this.USER.profile;
				}
			},
		},

		async mounted() {
			this.$store.commit('setDocumentTitle', 'Редактирование данных');

			if (types.isEmpty(this.USER)) {
				await this.getUser();
			}
		}
	}
</script>

<style lang="sass" scoped="">
	.avatar
		width: 160px
		height: 160px
		border-radius: 6px
		display: flex
		align-items: center
		justify-content: center
		border: 1px solid #ddd
		margin: 20px auto
		background-color: #e6e6e6

	.btn-sm
		position: absolute
		background-color: rgba(0, 98, 204, .5)
		border-color: rgba(0, 98, 204, .6)

	.input-group .btn
		color: #6c757d
		background-color: transparent
		border-color: #6c757d
		min-width: auto

	.input-group .btn:hover,
	.input-group .btn:active
		color: #fff
		background-color: #6c757d
		border-color: #6c757d

	.input-group .form-control
		height: calc(1.5em + .75rem + 3px)

</style>
