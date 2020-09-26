<form action="javascript:;" id="ajax-tariff-form" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="tariff_cold_water">Вода, руб. <span class="required">*</span></label>
        <input type="text" name="tariff[water]" value="" id="tariff_cold_water" class="form-control" required="">
    </div>
    <div class="form-group">
        <label for="tariff_electricity">Электроэнергия, руб. <span class="required">*</span></label>
        <input type="text" name="tariff[electricity]" value="" id="tariff_electricity" class="form-control" required="">
    </div>
    <div class="form-group">
        <label for="tariff_electricity_night">Электроэнергия (ночь), руб. <span class="required">*</span></label>
        <input type="text" name="tariff[electricity_night]" value="" id="tariff_electricity_night" class="form-control" required="">
    </div>
    <div class="form-group">
        <label for="tariff_end_day">Дата окончания действия <span class="required">*</span></label>
        <input type="date" name="tariff[end_day]" value="" id="tariff_end_day" class="form-control" required="">
    </div>
    <div class="form-group text-center">
        <button class="btn btn-primary js-tariff-submit has-spinner" type="submit" name="submit">Отправить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#ajax-tariff-form').validate();
    });
</script>