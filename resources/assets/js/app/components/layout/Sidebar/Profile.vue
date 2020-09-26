<template>
	<aside class="l-sidebar" role="complementary">
		<div class="sidebar">
			<section class="widget">
				<div class="widget_body">
					<div class="list-group">
						<router-link
							v-for="link in links"
							:key="link.name"
							tag="a"
							active-class="active"
							class="list-group-item list-group-item-action"
							:to="{name: link.name}"
							:exact="link.exact"
						>{{link.title}}</router-link>
						<a class="list-group-item list-group-item-action" href="/logout">Выйти</a>
					</div>
				</div>
			</section>

			<section class="widget">
				<div class="widget_body">
					<a href="javascript:;" @click="setShowModal" class="btn btn-warning">Подать претензию / предложение</a>
				</div>
			</section>
		</div>
		<v-modal
			v-if="showModal"
			@modalclose="modalClose"
		>
			<h3>Заполните форму</h3>
			<br>
			<form @submit.prevent="onSubmitAbuse" class="contact-form" method="post" accept-charset="utf-8">
				<p class="text-mute">Вы можете подавать претензии и предложения как об улучшениях работы сервиса так и по темам поселка</p>
				<div class="form-group">
					<label class="control-label" for="subject">Тема сообщения</label>
					<select type="text" id="subject" class="form-control" v-model="subject">
						<option value="suggestion">Предложение</option>
						<option value="abuse">Претензия</option>
					</select>
					<br>
					<label class="control-label" for="abuse">Сообщение</label>
					<textarea
						id="abuse"
						v-model.trim="abuse"
						rows="5"
						class="form-control"
						@blur="$v.$touch()"
						ref="abuseTextarea"
					></textarea>
					<small
						class="text-danger"
						v-if="$v.abuse.$dirty && !$v.abuse.minLength"
					>Поле должно быть не менее {{$v.abuse.$params.minLength.min}} символов</small>
					<small
						class="text-danger"
						v-if="$v.abuse.$dirty && !$v.abuse.maxLength"
					>Поле должно быть не более {{$v.abuse.$params.maxLength.max}} символов</small>
					<small
						class="text-danger"
						v-if="$v.abuse.$dirty && ! $v.abuse.required"
					>Поле обязательно для заполнения</small>
				</div>
				<input type="submit" class="btn btn-primary" name="submit" value="Отправить">
			</form>
		</v-modal>
	</aside>
</template>

<script>

	import route from '@app/route'
	import { required, minLength, maxLength} from 'vuelidate/lib/validators'
	import { mapActions, mapGetters } from 'vuex'

	export default {
		data() {
			return {
				showModal: false,
				abuse: '',
				subject: 'suggestion',
				links: [
					{ title: 'Общая информация', name: 'profile', exact: true },
					{ title: 'Баланс и оплата', name: 'payments' },
					{ title: 'Показания счетчиков', name: 'meters_data' },
					{ title: 'Заявки', name: 'services' },
					{ title: 'Новости и события', name: 'news_events' },
					{ title: 'Голосования', name: 'polls' },
				]
			}
		},

		validations: {
			abuse: {
				minLength: minLength(10),
				maxLength: maxLength(500),
				required
			}
		},

		computed: {
			...mapGetters({
				USER: 'USER',
			}),
		},

		methods: {
			...mapActions([
				'saveAbuse',
			]),

			async onSubmitAbuse() {
				if (this.$v.$invalid) {
					this.$v.$touch();
					return;
				}

				this.abuse = await this.saveAbuse({abuse: this.abuse, subject: this.subject});
				this.showModal = false;
			},

			modalClose() {
				this.showModal = false;
			},

			setShowModal() {
				this.showModal = true;
				this.$nextTick(() => {
					this.$refs.abuseTextarea.focus();
				});
			}
		}
	}
</script>

<style lang="sass" scoped="">

</style>
