<form action="{{ route('admin.areas.set_meters.store', $area_id) }}" id="set-meters-form" class="contact-form" method="post" accept-charset="utf-8">
	<table class="table">
		<thead>
			<tr>
				<th class="text-center" rowspan="2">Счетчик</th>
				<th class="text-center" colspan="2">Показания</th>
				<th class="text-center" rowspan="2">Расход</th>
			</tr>
			<tr>
				<th class="text-center text-muted" width="15%"><small>Предыдущее</small></th>
				<th class="text-center text-muted" width="15%"><small>Текущее</small></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					Вода, м<sup>3</sup><br>
					<small class="text-muted" style="font-size: 80%;">Серийный номер: {{ $сounters->water_number }}</small>
				</td>
				<td class="text-center" data-prev-meters="{{ $meters_data['prev']['water'] }}">{{ $meters_data['prev']['water'] }}</td>
				<td>
					<input type="text" name="water" class="js-input-meters form-control" value="{{ isset($meters_data['currency']['water']) ? $meters_data['currency']['water'] : 0 }}">
				</td>
				<td class="text-center js-calc-meters"></td>
			</tr>
			<tr>
				<td>
					Электроэнергия, кВт.ч<br>
					<small class="text-muted" style="font-size: 80%;">Серийный номер: {{ $сounters->electr_number }}</small>
				</td>
				<td class="text-center" data-prev-meters="{{ $meters_data['prev']['electricity'] }}">{{ $meters_data['prev']['electricity'] }}</td>
				<td>
					<input type="text" name="electricity" class="js-input-meters form-control" value="{{ isset($meters_data['currency']['electricity']) ? $meters_data['currency']['electricity'] : 0 }}" required="">
				</td>
				<td class="text-center js-calc-meters"></td>
			</tr>
			<tr>
				<td>
					Электроэнергия ночь, кВт.ч<br>
					<small class="text-muted" style="font-size: 80%;">Серийный номер: {{ $сounters->electr_number }}</small>
				</td>
				<td class="text-center" data-prev-meters="{{ $meters_data['prev']['electricity_night'] }}">{{ $meters_data['prev']['electricity_night'] }}</td>
				<td>
					<input type="text" name="electricity_night" class="js-input-meters form-control" value="{{ isset($meters_data['currency']['electricity_night']) ? $meters_data['currency']['electricity_night'] : 0 }}" required="">
				</td>
				<td class="text-center js-calc-meters"></td>
			</tr>
		</tbody>
	</table>
	<div class="text-center">
		<input type="hidden" name="area_id" value="{{ $area_id }}">
		<input type="submit" class="btn btn-primary" name="submit" value="Сохранить">
		<a href="javascript:;" data-dismiss="modal" class="btn btn-default">Отмена</a>
	</div>
</form>

<script>
	$(document).ready(function() {
		$(document).on('input', '.js-input-meters', function(event) {
			event.preventDefault();

			this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
			
			var inputData = $(this).val(),
				prev = $(this).parent().prev().data('prev-meters'),
				calc = 0;

			if (inputData > prev) {
				calc = parseFloat(inputData - prev).toFixed(2);
			}
			
			$(this).parent().next().text(calc);
		});
	});

	$(window).on('shown.bs.modal', function() {

		$('.js-input-meters').each(function( index ) {

			var inputData = $(this).val(),
				prev = $(this).parent().prev().data('prev-meters'),
				calc = 0;

			if (inputData > prev) {
				calc = parseFloat(inputData - prev).toFixed(2);
			}
			
			$(this).parent().next().text(calc);

		});
	});

	$('#set-meters-form').validate();
</script>

<style>
	label.error {
		color: #ff3547;
		font-size: 11px;
		font-weight: normal;
	}
</style>
