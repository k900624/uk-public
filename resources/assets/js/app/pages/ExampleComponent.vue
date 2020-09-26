<template>
	<div class="page-content">component</div>
</template>

<script>
	export default {
		props: {
			item: {
				type: Object,
				default() {
					return {}
				}
			}
		},

		data() {
			return {

			}
		},

		components: {

		},

		methods: {
			modalClose() {
				this.showModal = false;
			},
		},

		watch: {

		},

		computed: {
			sum: function () {
				return sum
			}
		},

		mounted() {
			console.log('Component mounted');
		}
	}
</script>

<style lang="sass" scoped="">

</style>
