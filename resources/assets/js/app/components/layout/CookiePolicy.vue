<template>
	<div class="cookiealert" role="alert" :class="{ show: state.cookieAlertShow }" v-if="state.isCookieAlert">
		<div class="cookiealert-container">
			Этот веб-сайт использует куки-файлы для обеспечения большего удобства навигации и предоставления индивидуального обслуживания. Продолжение навигации по сайту предполагает ваше согласие с их использованием. Вы можете изменить конфигурацию браузера или получить дополнительную информацию, ознакомившись с <a href="javascript:;" title="Политика использования Cookie-файлов">нашей политикой конфиденциальности</a>
			<button type="button" class="btn btn-primary btn-sm acceptcookies" @click="cookieAlertHidden()" aria-label="Close">
				Я согласен
			</button>
		</div>
	</div>
</template>

<script>

	import { setCookie, getCookie } from '@app/helpers/cookie.helper'

	export default {
		data() {
			return {
				state: {
					cookieAlertShow: true,
					isCookieAlert: true,
				}
			}
		},

		methods: {
			cookieAlertHidden() {
				this.state.cookieAlertShow = false;
				setCookie('accept_cookies', true, {expires: 7, path: '/'});
			},
		},

		mounted() {
			let acceptCookies = getCookie('accept_cookies');
			if (acceptCookies) {
				this.state.cookieAlertShow = false;
				this.state.isCookieAlert = false;
			}
		}
	}
</script>

<style lang="sass" scoped="">

</style>
