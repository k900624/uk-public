<script>
	export default {
		name: 'v-button',
		props: {
			loading: {
				type: Boolean,
			},
			success: {
				type: Boolean,
			},
			className: {
				type: String,
				default: 'btn-primary'
			},
		},
		methods: {
			onClick() {
				this.$emit('click');
			},
		},
		template: `
			<button type="button" class="btn" :class="className" @click="onClick">
				<transition name="v-btn-label" mode="out-in">
					<div v-if="loading">
						<span class="spinner"></span>
					</div>
					<svg v-else-if="success" width="24" height="24" viewBox="0 0 36 36">
						<path fill="#fff" d="M13.5 24.26L7.24 18l-2.12 2.12 8.38 8.38 18-18-2.12-2.12z" />
					</svg>
					<span v-else>
						<slot></slot>
					</span>
				</transition>
			</button>
		`,
	};
</script>

<style scoped="" lang="scss">
	.spinner {
		display: inline-block;
		margin: -6px 8px;
		border-radius: 50%;
		width: 1.3em;
		height: 1.3em;
		border: .215em solid transparent;
		vertical-align: middle;
		font-size: 16px;
		border-top-color: white;
		animation: spin 1s cubic-bezier(.55, .15, .45, .85) infinite;
	}

	.btn {

		svg {
			margin: -6px 0;
			filter: drop-shadow(2px 3px 6px rgba(0, 0, 0, .4));
		}
	}

	.v-btn-label-enter-active {
		animation: slide-in-down 260ms cubic-bezier(.0, .0, .2, 1);
	}

	.v-btn-label-leave-active {
		animation: slide-out-down 260ms cubic-bezier(.4, .0, 1, 1);
	}

	@keyframes spin {
		0% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(360deg);
		}
	}

	@keyframes slide-in-down {
		0% {
			transform: translateY(-20px);
			opacity: 0;
		}

		50% {
			opacity: .8;
		}

		100% {
			transform: translateY(0);
			opacity: 1;
		}
	}

	@keyframes slide-out-down {
		0% {
			transform: translateY(0);
			opacity: 1;
		}

		40% {
			opacity: .2;
		}

		100% {
			transform: translateY(20px);
			opacity: 0;
		}
	}
</style>
