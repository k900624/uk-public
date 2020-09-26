@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.areas.index'  => $heading,
            'admin.areas.create' => $title,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('after-scripts')
    <script src="{{ url('vendor/select2/dist/js/select2.min.js') }}"></script>
    <link href="{{ url('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ url('vendor/select2-bootstrap/dist/select2-bootstrap.min.css') }}" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#main_user').select2({tags: [], theme: 'bootstrap'});
        });
    </script>
@endsection

@section('content')
    <form action="{{ $action }}" class="validate" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        @if ($area->id)
            {{ method_field('PATCH')}}
        @endif
        {{ csrf_field() }}
        <div class="col-md-10 col-md-offset-1">
            <section class="block">
                <header class="block_header">
                    <h2><i class="fa fa-edit"></i> Информация <small>(поля обязательны для заполнения)</small></h2>
                </header>
                <div class="block_body form-horizontal">
                    
                    <fieldset>
                        
                        <div class="col-sm-12">
                            <legend class="section">Информация об участке</legend>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="address">Адрес</label>
                            <div class="col-sm-9">
                                <textarea name="address" id="address" rows="2" class="form-control" required="" autocomplete="off">{{ old('address', $area->address) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="main_user">Ответственное лицо</label>
                            <div class="col-sm-9">
                                <select id="main_user" name="main_user" class="form-control" placeholder="Выберите ответственного">
                                    <option value="0">-- Выбрать --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->user_id }}" @isset($user->selected) selected="" @endisset>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="help-block">Выберите пользователя из списка</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="contract_number">Номер договора</label>
                            <div class="col-sm-3">
                                <input type="text" name="contract_number" value="{{ old('contract_number', $area->contract_number) }}" id="contract_number" class="form-control js-number" required="" autocomplete="off">
                            </div>

                            <label class="col-sm-3 control-label" for="contract_date">Дата договора</label>
                            <div class="col-sm-3">
                                <input type="date" name="contract_date" value="{{ old('contract_date', $area->contract_date) }}" id="contract_date" class="form-control" required="" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="land_area">Площадь участка, сот.</label>
                            <div class="col-sm-3">
                                <input type="text" name="land_area" value="{{ old('land_area', $area->land_area) }}" id="land_area" class="form-control js-number-float" required="" autocomplete="off">
                            </div>
                            
                            <label class="col-sm-3 control-label" for="house_area">Площадь дома, сот.</label>
                            <div class="col-sm-3">
                                <input type="text" name="house_area" value="{{ old('house_area', $area->house_area) }}" id="house_area" class="form-control js-number-float" required="" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="quantity_residents">Кол-во проживающих</label>
                            <div class="col-sm-3">
                                <input type="text" name="quantity_residents" value="{{ old('quantity_residents', $area->quantity_residents) }}" id="quantity_residents" class="form-control js-number" required="" autocomplete="off">
                            </div>
                        
                            <label class="col-sm-3 control-label" for="contract_file">Файл договора</label>
                            <div class="col-sm-3">
                                <input type="file" name="contract_file" id="contract_file" class="form-control" required="" accept="image/bmp,image/jpg,image/jpeg,image/png,application/pdf,application/zip" value="">
                                <small class="form-text text-muted">Допускаются файлы с расширением bmp, jpg, jpeg, png, pdf, zip</small>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <legend>Счетчики</legend>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12"><h5>Вода</h5></div>
                            
                            <label class="col-sm-2 control-label" for="сounter_water_number">№ счетчика</label>
                            <div class="col-sm-2">
                                <input type="text" name="сounters[water_number]" value="{{ old('сounters["water_number"]', $area->сounters->water_number ?? '') }}" id="сounter_water_number" class="form-control js-number" required="" autocomplete="off">
                            </div>

                            <label class="col-sm-2 control-label" for="сounter_water_verify_date">Дата поверки</label>
                            <div class="col-sm-2 p-0">
                                <input type="date" name="сounters[water_verify_date]" value="{{ old('сounters["water_verify_date"]', $area->сounters->water_verify_date ?? '') }}" id="сounter_cold_verify_date" class="form-control" required="" autocomplete="off">
                            </div>

                            <label class="col-sm-2 control-label" style="padding-top: 0" for="сounter_water_first_meter">Начальные показания</label>
                            <div class="col-sm-2">
                                <input type="text" name="сounters[water_first_meter]" value="{{ old('сounters["water_first_meter"]', $area->сounters->water_first_meter ?? 0) }}" id="сounter_water_first_meter" class="form-control js-number-float" required="" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12"><h5>Электроэнергия (дневной тариф)</h5></div>
                            
                            <label class="col-sm-2 control-label" for="сounter_electr_number">№ счетчика</label>
                            <div class="col-sm-2">
                                <input type="text" name="сounters[electr_number]" value="{{ old('сounters["electr_number"]', $area->сounters->electr_number ?? '') }}" id="сounter_electr_number" class="form-control js-number" required="" autocomplete="off">
                            </div>

                            <label class="col-sm-2 control-label" for="сounter_electr_verify_date">Дата поверки</label>
                            <div class="col-sm-2 p-0">
                                <input type="date" name="сounters[electr_verify_date]" value="{{ old('сounters["electr_verify_date"]', $area->сounters->electr_verify_date ?? '') }}" id="сounter_electr_verify_date" class="form-control" required="" autocomplete="off">
                            </div>

                            <label class="col-sm-2 control-label" style="padding-top: 0" for="сounter_electr_first_meter">Начальные показания</label>
                            <div class="col-sm-2">
                                <input type="text" name="сounters[electr_first_meter]" value="{{ old('сounters["electr_first_meter"]', $area->сounters->electr_first_meter ?? 0) }}" id="сounter_electr_first_meter" class="form-control js-number-float" required="" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12"><h5>Электроэнергия (ночной тариф)</h5></div>
                            
                            <label class="col-sm-2 col-md-offset-8 control-label" style="padding-top: 0" for="сounter_electr_first_meter">Начальные показания</label>
                            <div class="col-sm-2">
                                <input type="text" name="сounters[electr_night_first_meter]" value="{{ old('сounters["electr_night_first_meter"]', $area->сounters->electr_night_first_meter ?? 0) }}" id="сounter_electr_night_first_meter" class="form-control js-number-float" required="" autocomplete="off">
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <input type="hidden" name="role_id" value="2">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                        <a class="btn btn-default" href="{{ route('admin.areas.index') }}">Отмена</a>
                    </div>

                </div>
            </section>
        </div>
    </form>
@endsection
