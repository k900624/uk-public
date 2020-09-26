<template>
	<div class="l-navbar" role="navigation">

		<nav class="navbar">
			<ul class="navbar-nav">
				<li class="nav-item" v-for="link in links" :key="link.name">
					<router-link
						tag="a"
						active-class="active"
						class="nav-link"
						:to="{name: link.name}"
						:exact="link.exact"
					>{{link.title}}</router-link>
				</li>
			</ul>
		</nav>

	</div>
</template>

<script>
	export default {
		data() {
			return {
				links: [
					{ title: 'Главная', name: 'profile', exact: true },
					{ title: 'Полезная информация', name: 'handbook' },
					{ title: 'О нас', name: 'about' },
					{ title: 'Контакты', name: 'contacts' },
					{ title: 'Вопрос-ответ', name: 'faq' },
				]
			}
		},
	}
</script>

<style lang="sass" scoped="">

</style>
