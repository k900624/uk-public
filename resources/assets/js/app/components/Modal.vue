<template>
	<div class="modal-overlay" :class="classoverlay">
		<div class="modal" :class="classmodal" role="dialog" ref="closeOnClick">
			<div class="modal-dialog">
				<div class="modal-body">
					<span class="modal-close" @click="close()"></span>
					<slot>
						<v-spinner
							:size="spinner_size"
							:speed="spinner_speed"
						/>
					</slot>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'v-modal',
		props: {
			classmodal: {
				type: String,
				default: ''
			},
			classoverlay: {
				type: String,
				default: ''
			},
			showModal: {
				type: Boolean,
				default: true
			}
		},

		data() {
			return {
				spinner_size: 24,
				spinner_speed: 0.8,
			}
		},

		methods: {
			close() {
				this.$emit('modalclose', false);
				document.body.classList.remove('modal-open');
			}
		},

		mounted() {
			let vm = this;
			document.addEventListener('click', function(event) {
				if (event.target === vm.$refs.closeOnClick) {
					vm.close();
				}
			});

			document.body.classList.add('modal-open');

			document.addEventListener('keyup', function(event) {
				if (event.keyCode === 27) {
					vm.close();
				}
			});
		}
	}
</script>

<style>
.modal {
	position: fixed;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	z-index: 1050;
	display: block!important;
}
@media screen and (min-width: 1024px) {
	.modal-dialog {
		max-width: 600px;
	}
}
@media screen and (max-width: 1023px) {
	.modal-dialog {
		max-width: 80%;
	}
}
@media screen and (max-width : 767px) {
	.modal-dialog {
		max-width: 90%;
	}
}
.modal-dialog {
	margin: 50px auto 0;
	pointer-events: auto;
}
.modal.in {
	display: block;
	opacity: 1;
	animation: fade-In 1s forwards;
}
.modal-open {
	overflow: hidden;
}
.modal-body {
	position: relative;
	padding: 30px;
	background-color: #fff;
}
@media screen and (max-width : 767px) {
	.modal-body {
		padding: 30px;
	}
}
.modal-open-scroll {
	padding: 0;
}
.modal-close {
	position: absolute;
	/*right: 12px;*/
	/*top: -41px;*/
	right: 6px;
	top: 6px;
	margin: 0;
	padding: 0;
	width: 32px;
	height: 32px;
	line-height: 32px;
	cursor: pointer;
	opacity: 0.8;
	transition-property: opacity;
	transition-duration: .5s;
}
.modal-close:focus,
.modal-close:hover {
	opacity: 1;
	outline: none;
	transition-property: opacity;
	transition-duration: .5s;
}
.modal-close:before,
.modal-close:after {
	content: ' ';
	position: absolute;
	left: 15px;
	top: 5px;
	height: 22px;
	width: 2px;
	background-color: #000;
}
.modal-close:before {
	transform: rotate(45deg);
}
.modal-close:after {
	transform: rotate(-45deg);
}
.modal-overlay {
	/* overlay will stay fixed and will take all the space available */
	position: fixed;
	bottom: 0;
	left: 0;
	top: 0;
	right: 0;
	z-index: 100;

	/* if modal content doesn't fit inside the overlay, display scrollbars */
	overflow: auto;

	/* allow one-finger iPad scrolling */
	-webkit-overflow-scrolling: touch;
}
/* fix for iPad glitches */
.modal-overlay > * {
	-webkit-transform: translateZ(0px);
}
.modal-overlay {
	background: rgba(0, 0, 0, 0.8);
	/* IE6–IE8 */
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr = #7F000000, endColorstr = #7F000000);
	zoom: 1;
}
</style>
