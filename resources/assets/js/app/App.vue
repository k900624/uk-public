<template>
	<div class="l-wrapper">

		<notifications group="server" classes="server-notification" position="top left" />
		<notifications group="app" classes="app-notification" />

		<Header />

		<div class="l-middle primary">
			<div class="l-content">

				<div class="wrapper">

					<component :is="sidebar"></component>

					<transition name="fade" mode="out-in">
						<router-view v-if=" ! isMobile" />
						<router-view v-else name="mobile" />
					</transition>

				</div>
			</div>
		</div>

		<Footer />

		<CookiePolicy />

	</div>
</template>

<script>
	import DeviceHelper from '@app/helpers/device.helper'
	import types from '@app/helpers/utils/types.utils'
	import { mapActions, mapGetters } from 'vuex'

	import Header from '@components/Layout/Header'
	import ProfileSidebar from '@components/Layout/Sidebar/Profile'
	import FaqSidebar from '@components/Layout/Sidebar/Faq'
	import NewsSidebar from '@components/Layout/Sidebar/News'
	import Navbar from '@components/Layout/Navbar'
	import Footer from '@components/Layout/Footer'
	import CookiePolicy from '@components/Layout/CookiePolicy'

	export default {
		data() {
			return {

			}
		},

		components: {
			Header,
			ProfileSidebar,
			FaqSidebar,
			NewsSidebar,
			Navbar,
			Footer,
			CookiePolicy,
		},

		methods: {

			...mapActions([
				'getUser',
				'getArea',
			]),

		},

		computed: {
			sidebar() {
				return (this.$route.meta.sidebar || 'profile') + '-sidebar'
			},

			...mapGetters([
				'USER',
				'AREA',
			]),

			isMobile() {
				return DeviceHelper.isMobile()
			},
		},

		async mounted() {

			if (types.isEmpty(this.USER)) {
				await this.getUser();
			}

			if (types.isEmpty(this.AREA)) {
				await this.getArea();
			}
		}
	}
</script>

<style lang="sass" scoped="">

	.wrapper
		display: flex
</style>
