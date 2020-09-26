@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.adverts.index' => $heading,
        ]
     ])
    @endbreadcrumbs
@endsection

@section('content')

    <div class="col-md-10 col-md-offset-1">
        <section class="block">
            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество объявлений">{{ $countArticles }}</span>
                </h2>
                <div class="action">
                    <a href="{{ route('admin.adverts.create') }}" class="btn btn-default btn-xs">
                        <span class="hidden-xs">Добавить</span> <i class="fa fa-plus"></i>
                    </a>
                </div>
            </header>
            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th>Заголовок</th>
                            <th class="hidden-sm">Дата изменения</th>
                            <th>Статус</th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            @php $published = ($article->published)
                            ? '<a href="'. route('admin.adverts.deactivate', $article->id) .'"
                                title="Отключить статью"
                                onclick="return confirmMessage(\'Вы подтверждаете отключение? Объявление будет недоступно пользователям!\')"><span class="label label-success">Вкл.</span></a>'
                            : '<a href="'. route('admin.adverts.activate', $article->id) .'"
                                title="Активировать статью"
                                onclick="return confirmMessage(\'Вы подтверждаете включение? Объявление будет доступно пользователям!\')"><span class="label label-grey">Выкл.</span></a>'
                            @endphp
                            <tr>
                                <td>
                                    <a href="{{ route('admin.adverts.edit', $article->id) }}" title="Редактировать">{{ $article->title }}</a>
                                    <small>{{ $article->introtext }}</small>
                                </td>
                                <td class="hidden-sm hidden-xs">
                                    <time title="{{ format_date($article->updated_at, 4) }}">
                                        {{ \Carbon\Carbon::parse($article->updated_at)->diffForHumans() }}
                                    </time>
                                </td>
                                <td class="hidden-xs text-center">{!! $published !!}</td>
                                <td class="col-action">
                                    <div class="btn-group">
                                        @haspermission('edit_articles')
                                        <a href="{{ route('admin.adverts.edit', $article->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                        @endauth
                                        @haspermission('delete_articles')
                                        <a href="{{ route('admin.adverts.delete', $article->id) }}" class="btn btn-sm btn-danger hidden-xs" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Объявления не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            @if($articles->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $articles->links() }}
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
