<template>
	<article class="content">
		<header class="content_header">
			<h1 class="content_title">Вопрос-ответ</h1>
		</header>
		<div class="content_body">

            <a href="javascript:;" class="btn btn-success js-modal" data-remote="faq/add">Задать вопрос</a>

            <h2>Категория 1</h2>

				<ul id="faq-list" class="faq_list">

					<li class="faq_item">
						<a class="faq_item-question" data-toggle="collapse" href="#question-1" aria-expanded="true" aria-controls="question-1">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit.
						</a>
						<div id="question-1" class="faq_item-answer collapse show" role="tabpanel" data-parent="#faq-list" style="">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis repellat excepturi eius voluptate vel! Earum ea optio debitis iusto, odit id nam voluptate, dicta possimus obcaecati aliquam delectus recusandae enim.</p>  <p>Eveniet labore illo, odio dolorem aliquam sapiente, nam corrupti in ea debitis id fugit deleniti non, praesentium maxime quod natus possimus odit aspernatur cupiditate itaque suscipit fugiat consectetur? Hic, aliquid?</p>  <p>Nihil, provident expedita repudiandae exercitationem maxime rem commodi neque nisi architecto cumque nam enim! Officia ea nulla ex incidunt commodi, praesentium asperiores sequi nam! Ex ab magnam vero nulla iusto.</p>
						</div>
					</li>

					<li class="faq_item">
						<a class="faq_item-question collapsed" data-toggle="collapse" href="#question-2" aria-expanded="false" aria-controls="question-2">
							Eligendi incidunt numquam repudiandae eaque?
						</a>
						<div id="question-2" class="faq_item-answer collapse" role="tabpanel" data-parent="#faq-list">
							<p>Itaque, eligendi! Eligendi incidunt numquam repudiandae eaque? Labore a, nostrum cum ratione laudantium impedit obcaecati, quibusdam dicta iure tempora ad inventore tempore aliquid. Accusantium repellat repellendus iste totam odit vel.</p>
						</div>
					</li>
			</ul>
        </div>
	</article>
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

		methods: {

		},

		watch: {

		},

		computed: {

		},

		mounted() {

		}
	}
</script>

<style lang="sass" scoped="">
	.faq_item
		margin-top: 20px

	.faq_item-question
		display: block
		margin-bottom: 10px
		font-size: 18px
		font-family: RobotoBold, sans-serif, arial, verdana, Lucida Sans

	.faq_item-answer
		padding-left: 20px
		border-left: 3px solid #eee
</style>
