<template>
	<nav aria-label="Page navigation example" v-if="pagination.last_page > 1">
		<ul class="pagination pagination-pager justify-content-center">
			<li :class="[{disabled: ! pagination.prev_page_url}]" class="page-item">
				<a 
					class="page-link"
					href="javascript:;"
					@click.prevent="fetchContentFromPagination(pagination.prev_page_url)"
				>Previous</a>
			</li>
			<li class="page-item disabled">
				<a 
					class="page-link text-dark"
					href="javascript:;"
				>Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
			</li>
			<li :class="[{disabled: ! pagination.next_page_url}]" class="page-item">
				<a 
					class="page-link"
					href="javascript:;"
					@click.prevent="fetchContentFromPagination(pagination.next_page_url)"
				>Next</a>
			</li>
		</ul>
	</nav>
</template>

<script>
	export default {

		props: {
			pagination: {
				type: Object,
				default() {
					return {}
				}
			}
		},

		data() {
			return {}
		},

		methods: {

			fetchContentFromPagination(page_url) {
				this.$emit('fetchContentFromPagination', page_url);
			}

		},

	}
</script>
