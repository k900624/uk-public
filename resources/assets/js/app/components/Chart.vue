<script>
	import { Line } from 'vue-chartjs';

	export default {
		name: 'v-chart',
		extends: Line,
		props: {
			chartdata: {
				type: Object,
				default: null
			},
			options: {
				type: Object,
				default: null
			},
			reRender: {
				type: Boolean,
				type: true,
			}
		},

		methods: {
			renderLineChart() {
				this.renderChart(this.chartdata, this.options);
			}
		},

		watch: {
			chartdata: function() {
				if (this.reRender) {
					this.renderLineChart();
				}
			}
		},

		mounted () {
			this.renderLineChart();
		}
	}
</script>
