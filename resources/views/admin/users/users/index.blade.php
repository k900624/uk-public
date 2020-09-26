@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.users.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('after-scripts')
<script>
    $(document).on('submit', '#ajax-notify-form', function(e) {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: 'post',
            url: $adminUrl + '/' + window.$routeNotify,
            data: form.serialize(),
            dataType: 'json',
            success: function(response, textStatus, xhr) {
                if (response.type === 'success') {
                    form[0].reset();
                    $('.modal').modal('hide');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                serverError(xhr, ajaxOptions, thrownError);
            }
        });
    });
</script>
@endsection

@section('content')

    @include('admin.users.users.includes.sidebar')

    <div class="col-md-9">
        <section class="block">
            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество пользователей">{{ $countUsers }}</span>
                </h2>
                <div class="action">
                    @if ($selectRoleId != 'all')

                        @if ($selectRoleId == 1) 
                            @php $userDisplay = 'администратора' @endphp 
                        @elseif ($selectRoleId == 2) 
                            @php $userDisplay = 'пользователя' @endphp
                        @elseif ($selectRoleId == 3 || $selectRoleId == 4) 
                            @php $userDisplay = 'менеджера' @endphp
                        @else 
                            @php $userDisplay = '' @endphp
                        @endif
                        <a href="{{ route('admin.users.create', ['role' => $selectRoleId]) }}" class="btn btn-default btn-xs"><span class="hidden-xs">Добавить {{ $userDisplay }}</span> <i class="fa fa-plus"></i></a>
                    @endif
                </div>
            </header>
            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th>#ID</th>
                            <th class="width-40"></th>
                            <th>ФИО</th>
                            <th class="hidden-sm">Последний вход</th>
                            <th></th>
                            {{-- <th>Статус</th> --}}
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            @if ( ! $user->hasArea && $user->role_name == 'user')
                                {{-- в истории --}}
                                @continue
                            @endif
                            <tr>
                                <td class="hidden-xs"><strong>{{ $user->user_id }}</strong></td>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->user_id) }}">
                                        <img src="{{ $user->avatar }}" alt="avatar" class="img-circle" style="width: 32px; height: 32px;">
                                    </a>
                                </td>
                                <td class="nowrap">
                                    <a href="{{ route('admin.users.show', $user->user_id) }}">
                                        {{ $user->name }}
                                    </a>
                                    <small>{{ $user->role_display_name }} 
                                        @if ($user->main == 'on' && $selectRoleId == 2)
                                            <span class="badge badge-warning ml-5" style="display: inline-block; padding: 2px; min-width: 0;" title="Ответственное лицо"></span>
                                        @endif
                                    </small>
                                    <small>
                                        <a href="javascript:;" class="js-modal" data-remote="{{ route('admin.feedback.ajax_send_email') }}" data-email="{{ $user->email }}">
                                            {{ $user->email }}
                                        </a>
                                    </small>
                                </td>
                                <td class="hidden-sm hidden-xs">
                                    <span title="{{ format_date($user->last_login_at, 4) }}">
                                        {!! $user->timeago !!}
                                    </span>
                                </td>
                                <td>
                                    {{-- @if ( ! $user->invited && $user->role_name != 'admin')
                                        <a href="{{ route('admin.users.invite', $user->user_id) }}" title="Пригласить пользователя">
                                            <span class="label label-success">Пригласить</span>
                                        </a>
                                    @endif --}}
                                    @if ( ! $user->last_login_at)
                                        <a href="{{ route('admin.users.invite', $user->user_id) }}" title="Приглашение отправлено, ждет подтверждения">
                                            <span class="label label-success"><i class="fa fa-user-plus"></i></span>
                                        </a>
                                    @endif
                                </td>
                                
                                {{-- <td class="hidden-xs">
                                    @if($user->role_name != 'admin')
                                        @if($user->status == 'on')
                                            <a href="{{ route('admin.users.deactivate', $user->user_id) }}" title="Отключить пользователя" onclick="return confirmMessage('Вы подтверждаете отключение пользователя? Ему будет не доступен вход.')">
                                                <span class="label label-success">Вкл.</span>
                                            </a>
                                        @elseif($user->status == 'off')
                                            <a href="{{ route('admin.users.activate', $user->user_id) }}" title="Активировать пользователя" onclick="return confirmMessage('Вы подтверждаете активирование пользователя? Ему будет доступен вход.')">
                                                <span class="label label-grey">Выкл.</span>
                                            </a>
                                        @elseif($user->status == 'banned')
                                            <a href="{{ route('admin.users.activate', $user->user_id) }}" title="Активировать пользователя" onclick="return confirmMessage('Вы подтверждаете активирование пользователя? Ему будет доступен вход.')">
                                                <span class="label label-warning">Бан</span>
                                            </a>
                                        @elseif($user->status == 'deleted')
                                            <a href="{{ route('admin.users.restore', $user->user_id) }}" title="Восстановить пользователя" onclick="return confirmMessage('Вы подтверждаете восстановление пользователя?')">
                                                <span class="label label-danger">Удален</span>
                                            </a>
                                        @endif
                                    @else
                                        @if($user->status == 'on')
                                            <span class="label label-success">Вкл.</span>
                                        @elseif($user->status == 'off')
                                            <span class="label label-grey">Выкл.</span>
                                        @elseif($user->status == 'deleted')
                                            <span class="label label-danger">Удален</span>
                                        @endif
                                    @endif
                                </td> --}}
                                <td class="col-action">
                                    <div class="dropdown">
                                        <a href="javascript:;" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-h"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ route('admin.users.edit', $user->user_id) }}"><i class="fa fa-pencil-square-o"></i> Редактировать</a></li>
                                            {{-- @if ($user->role_name != 'admin')
                                                @if ( ! $user->invited)
                                                    <li><a href="{{ route('admin.users.invite', $user->user_id) }}"><i class="fa fa-user-plus"></i> Пригласить</a></li>
                                                @endif
                                            @endif --}}
                                            @if (CurrentUser::id() != $user->user_id)
                                                @if ($user->status != 'deleted')
                                                    <li>
                                                        @if($user->status == 'on')
                                                            <a href="{{ route('admin.users.deactivate', $user->user_id) }}" onclick="return confirmMessage('Вы подтверждаете отключение? Комментарий будет недоступен пользователям!')"><i class="fa fa-thumbs-o-down"></i> Выключить</a>
                                                        @else
                                                            <a href="{{ route('admin.users.activate', $user->user_id) }}" onclick="return confirmMessage('Вы подтверждаете включение? Комментарий будет доступен пользователям!')"><i class="fa fa-thumbs-o-up"></i> Включить</a>
                                                        @endif
                                                    </li>
                                                    <li><a href="{{ route('admin.users.delete', $user->user_id) }}" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i> <span class="hidden-xs">Удалить</span></a></li>
                                                @else
                                                    <li><a href="{{ route('admin.users.restore', $user->user_id) }}" onclick="return confirmMessage('Вы подтверждаете восстановление?')"><i class="fa fa-thumbs-o-up"></i> Восстановить</a></li>
                                                    <li><a href="{{ route('admin.users.forceDelete', $user->user_id) }}" onclick="return confirmMessage('Вы подтверждаете удаление? Восстановление будет невозможно!')"><i class="fa fa-trash-o"></i> <span class="hidden-xs">Удалить из БД</span></a></li>
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Пользователи не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            @if($users->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $users->links() }}
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
