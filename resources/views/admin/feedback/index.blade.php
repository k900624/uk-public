@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.feedback.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('content')

    @include('admin.feedback.includes.sidebar')

    <div class="col-md-9">
        <section class="block">
            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество сообщений">{{ $countMessages }}</span>
                </h2>
            </header>
            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <tbody>
                    @forelse($messages as $item)

                        <tr>
                            <td class="width-40 hidden-xs"><img src="{{ $item->avatar }}" alt="" class="img-circle" style="width: 32px"></td>
                            <td class="nowrap">
                                @if( ! empty($item->username))
                                    <a href="{{ route('admin.users.edit', $item->user_id) }}">{{ $item->username }}</a>
                                @else
                                    {{ $item->name }}
                                    <small class="text-muted hidden-xs">Не зарегистрирован</small>
                                @endif
                                <small><a href="javascript:;"
                                          class="js-modal"
                                          data-remote="{{ route('admin.feedback.ajax_send_email') }}"
                                          data-email="{{ $item->email }}"
                                          data-id="{{ $item->id }}"
                                    >{{ $item->email }}</a></small>
                            </td>
                            <td>
                                <a href="javascript:;" data-remote="{{ route('admin.feedback.show', $item->id) }}" class="js-modal">
                                    @if( ! $item->is_view)
                                        <small class="pull-right text-success ml-10">
                                            <i class="fa fa-envelope" title="Не прочитано"></i>
                                        </small>
                                    @endif
                                    @if($item->attach)
                                        <small class="pull-right text-grey-darken-1 ml-10">
                                            <i class="fa fa-paperclip" title="Прикреплены файлы"></i>
                                        </small>
                                    @endif
                                    {{ str_limit(strip_tags(html_decode($item->subject)), 35) }}
                                    <small title="{{ $item->message }}">{{ str_limit($item->message, 40) }}</small>
                                </a>
                            </td>
                            <td class="hidden-sm hidden-xs">
                                <span title="{{ format_date($item->created_at, 4) }}">
                                    {{ $item->timeago }}
                                </span>
                            </td>
                            <td class="hidden-xs text-center"><span class="label label-{{ $item->status_class }}">{{ $item->status_label }}</span></td>
                            <td class="col-action">
                                <div class="dropdown">
                                    <a href="javascript:;" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-h"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a data-remote="{{ route('admin.feedback.show', $item->id) }}" class="js-modal" href="javascript:;"><i class="fa fa-search"></i> Смотреть</a></li>
                                        @if($buttons['reply'])
                                          <li><a data-remote="{{ route('admin.feedback.ajax_send_email') }}" class="js-modal" href="javascript:;" data-subject="Re: {{ $item->subject }}" data-email="{{ $item->email }}" data-id="{{ $item->id }}"><i class="fa fa-reply"></i> Ответить</a></li>
                                        @endif
                                        @if($buttons['spam'])
                                          <li><a href="{{ route('admin.feedback.spam', $item->id) }}" onclick="return confirmMessage('Вы действительно хотите отправить письмо в спам?')"><i class="fa fa-bug"></i> Спам</a></li>
                                        @endif
                                        @if($buttons['delete'])
                                          <li><a href="{{ route('admin.feedback.delete', $item->id) }}" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i> <span class="hidden-xs">Удалить</span></a></li>
                                        @endif
                                        @if($buttons['restore'])
                                          <li><a href="{{ route('admin.feedback.restore', $item->id) }}" onclick="return confirmMessage()"><i class="fa fa-share"></i> <span class="hidden-xs">Восстановить</span></a></li>
                                        @endif
                                        @if($buttons['forceDelete'])
                                          <li><a href="{{ route('admin.feedback.forceDelete', $item->id) }}" onclick="return confirmMessage('Вы подтверждаете удаление? Восстановление будет невозможно!')"><i class="fa fa-trash-o"></i> <span class="hidden-xs">Удалить из БД</span></a></li>
                                        @endif
                                    </ul>
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

            @if($messages->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $messages->links() }}
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
