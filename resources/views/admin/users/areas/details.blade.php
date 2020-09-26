@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.areas.index'     => 'Участки',
            'admin.areas.show'      => $title,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('after-scripts')

@endsection

@section('content')
<div class="col-md-12">
    <section class="block">
        <header class="block_header">
            <h2><i class="fa fa-edit"></i> Основные данные</h2>
        </header>
        <div class="block_body">
            
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">

                        <li class="active"><a href="#tab-profile" data-toggle="tab">Информация</a></li>
                        <li><a href="#tab-meters-data" data-toggle="tab">Показания счетчиков</a></li>
                        <li><a href="#tab-services" data-toggle="tab">Услуги</a></li>
                        <li><a href="#tab-requests" data-toggle="tab">Заявки</a></li>
                        <li><a href="#tab-notifications" data-toggle="tab">Уведомления</a></li>
                        <li><a href="#tab-messages" data-toggle="tab">Личные сообщения</a></li>

                    </ul>
                </div>

                <div class="col-md-9">

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-profile">
                            <table class="table table-striped">
                                <tr>
                                    <th>ФИО ответственного лица</th>
                                    <td><a href="{{ route('admin.users.show', $user->user_id) }}">
                                        {{ $user->name }}
                                    </a></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><a href="javascript:;" class="js-modal" data-remote="{{ route('admin.feedback.ajax_send_email') }}" data-email="{{ $user->email }}">{{ $user->email }}</a></td>
                                </tr>
                                <tr>
                                    <th>Телефон @if ($user->role_name != 'admin') / экстренный @endif</th>
                                    <td>{{ $user->phone }} @if ($user->role_name != 'admin') / {{ $user->phone2 }} @endif</td>
                                </tr>
                                @if ($user->vkontakte)
                                <tr>
                                    <th>ВКонтакте</th>
                                    <td><a target="_blank" href="{{ prep_url($user->vkontakte) }}">{{ $user->vkontakte }}</a></td>
                                </tr>
                                @endif
                                @if ($user->odnoklassniki)
                                <tr>
                                    <th>Одноклассники</th>
                                    <td><a target="_blank" href="{{ prep_url($user->odnoklassniki) }}">{{ $user->odnoklassniki }}</a></td>
                                </tr>
                                @endif
                                @if ($user->facebook)
                                <tr>
                                    <th>Facebook</th>
                                    <td><a target="_blank" href="{{ prep_url($user->facebook) }}">{{ $user->facebook }}</a></td>
                                </tr>
                                @endif
                                @if ($user->twitter)
                                <tr>
                                    <th>Twitter</th>
                                    <td><a target="_blank" href="{{ prep_url($user->twitter) }}">{{ $user->twitter }}</a></td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Адрес</th>
                                    <td>{{ $area->address }}</td>
                                </tr>
                                <tr>
                                    <th>Договор</th>
                                    <td>
                                        №{{ $area->contract_number }} от {{ $area->contract_date }}
                                        @if ($area->contract_file)
                                            <a class="badge badge-success ml-40" href="{{ url('admin/download/'. $area->contract_file) }}">Скачать</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Площадь участка / дома, сот.</th>
                                    <td>{{ $area->land_area }} / {{ $area->house_area }}</td>
                                </tr>
                                <tr>
                                    <th>Кол-во проживающих</th>
                                    <td>{{ $area->quantity_residents }}</td>
                                </tr>
                                <tr>
                                    <th>Счетчики</th>
                                    <td>
                                        <h5>Вода</h5>
                                        <ul>
                                            <li>№ счетчика: {{ $area->сounters->water_number }}</li>
                                            <li>Дата поверки: {{ $area->сounters->water_verify_date }}</li>
                                            <li>Начальные показания: {{ $area->сounters->water_first_meter }} м<sup>3</sup></li>
                                        </ul>
                                        <h5>Электроэнергия</h5>
                                        <ul>
                                            <li>№ счетчика: {{ $area->сounters->electr_number }}</li>
                                            <li>Дата поверки: {{ $area->сounters->electr_verify_date }}</li>
                                            <li>Начальные показания день/ночь: {{ $area->сounters->electr_first_meter }} / {{ $area->сounters->electr_night_first_meter }} м<sup>3</sup></li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="tab-pane fade in" id="tab-meters-data">
                            <h3>Показания счетчиков</h3>
                            @if ($noMetersData && ! $metersDataPeriodEnded && ! $metersDataPeriodNotStarted)
                            <br>
                            <a href="javascript:;" class="js-modal btn btn-primary" data-remote="{{ route('admin.areas.ajax_set_meters', $area->id) }}">Внести показания за {{ getCurrencyMonth() }}</a>
                            <br><br>
                            @endif
                            <table class="table table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Вода, м<sup>3<sub></th>
                                        <th>Электроэнергия, кВт.ч</th>
                                        <th>Электроэнергия (ночь), кВт.ч</th>
                                        <th>Дата внесения</th>
                                        <th>Статус</th>
                                        <th class="col-action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($meters_data as $item)
                                    <tr>
                                        <td>{!! $item->water ?? '&mdash;' !!}</td>
                                        <td>{{ $item->electricity }}</td>
                                        <td>{{ $item->electricity_night }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ($item->status)
                                                {!! $item->status !!}
                                            @else
                                                @if ( ! is_null($item->paid_at))
                                                    <span class="label label-success">Оплачено</span>
                                                @else
                                                    <span class="label label-danger">Не оплачено</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="col-action">
                                            <div class="btn-group">
                                                @if (! $metersDataPeriodEnded && ! $metersDataPeriodNotStarted)
                                                    {{-- <a href="{{ route('admin.areas.meters_data.edit', $area->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a> --}}
                                                    <a href="javascript:;" class="js-modal btn btn-sm btn-primary" data-remote="{{ route('admin.areas.ajax_set_meters', $area->id) }}"><i class="fa fa-pencil-square-o"></i></a>
                                                @endif
                                                <a href="{{ route('admin.areas.invoice', $area->id) }}" title="Выставить счет" class="btn btn-sm btn-default"><i class="fa fa-file-text-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Показания не найдены</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade in" id="tab-services">
                            <h3>Услуги</h3>
                            <br>
                            <table class="table table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">Текст</th>
                                        <th>Дата уведомления</th>
                                        <th>Статус</th>
                                        <th class="col-action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($services as $item)
                                    <tr>
                                        <td>{{ $item->text }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ( ! is_null($item->pivot->read_at))
                                                <span class="label label-success">Просмотрено</span>
                                            @else
                                                <span class="label label-grey">Не просмотрено</span>
                                            @endif
                                        </td>
                                        <td class="col-action">
                                            <div class="btn-group">
                                                <a href="" title="Отправить повторно" class="btn btn-sm btn-default"><i class="fa fa-paper-plane"></i></a>
                                                <a href="" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Услуги не найдены</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade in" id="tab-requests">
                            <h3>Заявки</h3>
                            <br>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="hidden-mobi">Номер заявки</th>
                                        <th class="hidden-mobi">Дата подачи</th>
                                        <th class="requests__descrip">Описание</th>
                                        <th>Статус</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="hidden-mobi">8</td>
                                        <td class="hidden-mobi">21.02.2020</td>
                                        <td class="requests__descrip">
                                            Домофон срабатывает через раз.
                                        </td>
                                        <td title="Заявка еще не рассмотрена"><p class="badge badge-info">Новая заявка</p></td>
                                    </tr>
                                    <tr>
                                        <td class="hidden-mobi">3</td>
                                        <td class="hidden-mobi">21.02.2020</td>
                                        <td class="requests__descrip">
                                            Пассажирский лифт не работает. Стоит на 1 этаже, двери открыты, кнопки не срабатывают.
                                        </td>
                                        <td title="Заявка находится в стадии выполнения">
                                            <p class="badge badge-warning">Принята на исполнение</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hidden-mobi">2</td>
                                        <td class="hidden-mobi">21.02.2020</td>
                                        <td class="requests__descrip">
                                            Разбито стекло в подъезде №3 между 4 и 5м этажом.
                                        </td>
                                        <td title="Заявка выполнена">
                                            <p class="badge badge-success">Выполнена</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hidden-mobi">4</td>
                                        <td class="hidden-mobi">21.02.2020</td>
                                        <td class="requests__descrip">
                                            Вышел из строя ПУ.
                                        </td>
                                        <td title="Заявка передана в подрядную организацию">
                                            <p class="badge badge-secondary">Передана на исполнение</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hidden-mobi">1</td>
                                        <td class="hidden-mobi">21.02.2020</td>
                                        <td class="requests__descrip">
                                            На первом этаже перегорела лампочка. Ничего не видно!
                                        </td>
                                        <td title="Заявка выполнена">
                                            <p class="badge badge-success">Выполнена</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade in" id="tab-notifications">
                            <h3>Уведомления</h3>
                            <br>
                            <table class="table table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">Текст</th>
                                        <th>Дата уведомления</th>
                                        <th>Статус</th>
                                        <th class="col-action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($notifications as $item)
                                    <tr>
                                        <td>{{ $item->text }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ( ! is_null($item->pivot->read_at))
                                                <span class="label label-success">Просмотрено</span>
                                            @else
                                                <span class="label label-grey">Не просмотрено</span>
                                            @endif
                                        </td>
                                        <td class="col-action">
                                            <div class="btn-group">
                                                <a href="" title="Отправить повторно" class="btn btn-sm btn-default"><i class="fa fa-paper-plane"></i></a>
                                                <a href="" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Уведомления не найдены</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade in" id="tab-messages">
                            <h3>Личные сообщения</h3>
                            <table class="table table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">Текст</th>
                                        <th>Дата уведомления</th>
                                        <th>Статус</th>
                                        <th class="col-action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($messages as $item)
                                    <tr>
                                        <td>{{ $item->text }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ( ! is_null($item->pivot->read_at))
                                                <span class="label label-success">Просмотрено</span>
                                            @else
                                                <span class="label label-grey">Не просмотрено</span>
                                            @endif
                                        </td>
                                        <td class="col-action">
                                            <div class="btn-group">
                                                <a href="" title="Отправить повторно" class="btn btn-sm btn-default"><i class="fa fa-paper-plane"></i></a>
                                                <a href="" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Сообщения не найдены</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a class="btn btn-primary" href="{{ route('admin.areas.edit', $area->id) }}">Редактировать</a>
                <a class="btn btn-default" href="{{ url()->previous() }}">Назад</a>
            </div>
        </div>
    </section>
</div>
@endsection
