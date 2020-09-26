@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.comments.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('content')

    @include('admin.articles.comments.includes.sidebar')

    <div class="col-md-9">
        <section class="block">
            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество комментариев">{{ $countComments }}</span>
                </h2>
            </header>
            <div class="block_body">

                @if($comments->count())

                    <table class="table table-striped table-condensed">
                        <tbody>
                        @foreach($comments as $comment)
                            @php if ($comment->status == 'on')
                                $status = '<a href="'. route('admin.comments.deactivate', $comment->id) .'"
                                    title="Не показывать комментарий"
                                    onclick="return confirmMessage(\'Вы подтверждаете отключение? Комментарий будет недоступен пользователям!\')"><span class="label label-success">Вкл.</span></a>';
                            elseif ($comment->status == 'off')
                                $status = '<a href="'. route('admin.comments.activate', $comment->id) .'"
                                    title="Показывать комментарий"
                                    onclick="return confirmMessage(\'Вы подтверждаете включение? Комментарий будет доступен пользователям!\')"><span class="label label-grey">Выкл.</span></a>';
                            elseif ($comment->status == 'deleted')
                                $status = '<span class="label label-danger">Удален</span>'
                            @endphp
                            <tr>
                                <td class="width-40 hidden-xs"><img src="{{ $comment->avatar }}" alt="" class="img-circle" style="width: 32px"></td>
                                <td class="nowrap">
                                    @if( ! empty($comment->username))
                                        <a href="{{ route('admin.users.edit', $comment->user_id) }}" target="_blank">{{ $comment->username }}</a>
                                    @else
                                        {{ $comment->name }}
                                        <small class="text-muted hidden-xs">Не зарегистрирован</small>
                                    @endif
                                    <small><a href="javascript:;"
                                              class="js-modal"
                                              data-remote="{{ route('admin.feedback.ajax_send_email') }}"
                                              data-email="{{ $comment->email }}"
                                              data-id="{{ $comment->id }}"
                                        >{{ $comment->email }}</a></small>
                                </td>
                                <td>
                                    @if($comment->contentExists)
                                    <a href="{{ url(rtrim($comment->object_name, 's') .'/'. $comment->alias) }}#comment_{{ $comment->id }}" title="Смотреть на сайте" target="_blank">
                                    @endif
                                        @if( ! $comment->is_view)
                                            <small class="pull-right text-success ml-10"><i class="fa fa-envelope" title="Не прочитано"></i></small>
                                        @endif
                                        @if( ! $comment->contentExists) <s class="text-danger" title="Статья не найдена"> @endif{!! $comment->content !!} @if( ! $comment->contentExists)</s> @endif
                                        <small>{!! $comment->message !!}</small>
                                    @if($comment->contentExists)
                                    </a>
                                    @endif
                                </td>
                                <td class="hidden-sm hidden-xs">
                                    <span title="{{ format_date($comment->created_at, 4) }}">
                                        {{ $comment->timeago }}
                                    </span>
                                </td>
                                <td class="hidden-xs text-center">{!! $status !!}</td>
                                <td class="col-action">
                                    <div class="dropdown">
                                        <a href="javascript:;" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-h"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a data-remote="{{ route('admin.comments.show', $comment->id) }}" class="js-modal" href="javascript:;"><i class="fa fa-search"></i> Смотреть</a></li>
                                            @if($comment->status != 'deleted')
                                                <li>
                                                    @if($comment->status == 'on')
                                                        <a href="{{ route('admin.comments.deactivate', $comment->id) }}" onclick="return confirmMessage('Вы подтверждаете отключение? Комментарий будет недоступен пользователям!')"><i class="fa fa-thumbs-o-down"></i> Выключить</a>
                                                    @else
                                                        <a href="{{ route('admin.comments.activate', $comment->id) }}" onclick="return confirmMessage('Вы подтверждаете включение? Комментарий будет доступен пользователям!')"><i class="fa fa-thumbs-o-up"></i> Включить</a>
                                                    @endif
                                                </li>
                                                <li><a href="{{ route('admin.comments.delete', $comment->id) }}" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i> <span class="hidden-xs">Удалить</span></a></li>
                                            @else
                                                <li><a href="{{ route('admin.comments.restore', $comment->id) }}" onclick="return confirmMessage('Вы подтверждаете восстановление?')"><i class="fa fa-thumbs-o-up"></i> Восстановить</a></li>
                                                <li><a href="{{ route('admin.comments.forceDelete', $comment->id) }}" onclick="return confirmMessage('Вы подтверждаете удаление? Восстановление будет невозможно!')"><i class="fa fa-trash-o"></i> <span class="hidden-xs">Удалить из БД</span></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <p>Комментарии не найдены</p>
                @endif

            </div>

            @if ($comments->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $comments->links() }}
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
