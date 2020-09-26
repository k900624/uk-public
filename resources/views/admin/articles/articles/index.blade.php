@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.articles.index' => $heading,
        ]
     ])
    @endbreadcrumbs
@endsection

@section('content')

    @include('admin.articles.articles.includes.sidebar')

    <div class="col-md-9">
        <section class="block">
            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество статей">{{ $countArticles }}</span>
                </h2>
                <div class="action">
                    @haspermission('create_articles')
                    <a href="{{ route('admin.articles.create', ['cat' => $selectCatId]) }}" class="btn btn-default btn-xs">
                        <span class="hidden-xs">Добавить</span> <i class="fa fa-plus"></i>
                    </a>
                    @endauth
                </div>
            </header>
            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th class="width-60"></th>
                            <th>Заголовок</th>
                            <th class="hidden-sm">Дата изменения</th>
                            <th>Статус</th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            @php $published = ($article->published)
                            ? '<a href="'. route('admin.articles.deactivate', $article->id) .'"
                                title="Отключить статью"
                                onclick="return confirmMessage(\'Вы подтверждаете отключение? Новость будет недоступна пользователям!\')"><span class="label label-success">Вкл.</span></a>'
                            : '<a href="'. route('admin.articles.activate', $article->id) .'"
                                title="Активировать статью"
                                onclick="return confirmMessage(\'Вы подтверждаете включение? Новость будет доступна пользователям!\')"><span class="label label-grey">Выкл.</span></a>'
                            @endphp
                            <tr>
                                <td class="hidden-xs">
                                    <a href="{{ route('admin.articles.edit', $article->id) }}" title="Редактировать">
                                        <img src="{{ ImageThumb::get($article->image, 'articles', '100') }}" alt="{{ $article->title }}">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.articles.edit', $article->id) }}" title="Редактировать">{{ $article->title }}</a>
                                    <small>Категория: <a href="{{ route('admin.articles.index') .'?cat='. $article->cat_id }}">{{ $article->category }}</a></small>
                                    <small class="pull-right text-grey-base">
                                        @if( ! $article->enable_comments)
                                            <i class="fa fa-comment text-danger" title="Комментарии отключены"></i>
                                        @else
                                            <i class="fa fa-comment" title="Кол-во комментариев"></i> {{ $article->commentsCount }}
                                        @endif
                                    </small>
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
                                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                        @endauth
                                        @haspermission('delete_articles')
                                        <a href="{{ route('admin.articles.delete', $article->id) }}" class="btn btn-sm btn-danger hidden-xs" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Новости не найдены</td>
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
