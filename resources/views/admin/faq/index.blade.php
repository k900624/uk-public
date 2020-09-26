@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.faq.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('content')
    @include('admin.faq.includes.sidebar')

    <div class="col-md-9">
        <section class="block">

            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество вопросов">{{ $countFaq }}</span>
                </h2>
                <div class="action">
                    <a href="{{ route('admin.faq.create', ['cat' => $selectCatId]) }}" class="btn btn-default btn-xs"><span class="hidden-xs">Добавить</span> <i class="fa fa-plus"></i></a>
                </div>
            </header>

            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <tbody>
                    @forelse($faq as $item)
                        @php $published = ($item->published)
                            ? '<a href="'. route('admin.faq.deactivate', $item->id) .'"
                                title="Отключить вопрос"
                                onclick="return confirmMessage(\'Вы подтверждаете отключение? Вопрос будет недоступен пользователям!\')"><span class="label label-success">Вкл.</span></a>'
                            : '<a href="'. route('admin.faq.activate', $item->id) .'"
                                title="Активировать вопрос"
                                onclick="return confirmMessage(\'Вы подтверждаете включение? Вопрос будет доступен пользователям!\')"><span class="label label-grey">Выкл.</span></a>'
                        @endphp
                        <tr>
                            <td class="width-percent-60">
                                <a href="{{ route('admin.faq.edit', $item->id) }}" title="Редактировать">{{ $item->question }}</a>
                                <small>{!! $item->answer !!}</small>
                            </td>
                            <td class="hidden-sm hidden-xs">
                                <span title="{{ format_date($item->created_at, 4) }}">
                                    {{ $item->timeago }}
                                </span>
                            </td>
                            <td class="hidden-xs text-center">{!! $published !!}</td>
                            <td class="col-action">
                                <div class="btn-group">
                                    <a href="{{ route('admin.faq.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{ route('admin.faq.delete', $item->id) }}" class="btn btn-sm btn-danger hidden-xs" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Вопросы не найдены</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>

            @if($faq->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $faq->links() }}
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
