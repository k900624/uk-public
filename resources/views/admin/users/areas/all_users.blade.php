@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.areas.index' => $heading,
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

    <div class="col-md-12">
        <section class="block">
            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество пользователей">{{ $countUsers }}</span>
                </h2>
            </header>
            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th>#ID</th>
                            <th class="width-40"></th>
                            <th>ФИО</th>
                            <th class="hidden-sm">Дата изменения</th>
                            <th></th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
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
                                    @if ($user->main == 'on')
                                        <span class="badge badge-warning ml-20" title="Ответственное лицо"><i class="fa fa-address-card"></i></span>
                                    @endif
                                    <small>
                                        <a href="javascript:;" class="js-modal" data-remote="{{ route('admin.feedback.ajax_send_email') }}" data-email="{{ $user->email }}">
                                            {{ $user->email }}
                                        </a>
                                    </small>
                                </td>
                                <td class="hidden-sm hidden-xs">
                                    <span title="{{ format_date($user->updated_at, 4) }}">
                                        {{ $user->timeago }}
                                    </span>
                                </td>
                                <td>
                                    @if ( ! $user->invited)
                                        <a href="{{ route('admin.users.invite', $user->user_id) }}" title="Пригласить пользователя">
                                            <span class="label label-success">Пригласить</span>
                                        </a>
                                    @endif
                                </td>

                                <td class="col-action">
                                    <div class="dropdown">
                                        <a href="javascript:;" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-h"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ route('admin.users.edit', $user->user_id) }}"><i class="fa fa-pencil-square-o"></i> Редактировать</a></li>
                                            
                                            @if ( ! $user->invited)
                                                <li><a href="{{ route('admin.users.invite', $user->user_id) }}"><i class="fa fa-user-plus"></i> Пригласить</a></li>
                                            @endif
                                            
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

            <div class="form-actions">
                <a href="{{ route('admin.areas.index') }}" class="btn btn-primary">Назад</a>
            </div>

        </section>
    </div>
@endsection
