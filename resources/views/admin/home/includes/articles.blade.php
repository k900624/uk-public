<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
    <div class="block block--full">
        <div class="block_header">
            <h2>
                Статьи
                <span class="label label-success animated bounceIn">{{ $countArticles }}</span>
            </h2>
            <div class="action">
                <a href="{{ route('admin.articles.create') }}" class="btn btn-default btn-xs" title="Новая статья"><i class="fa fa-plus"></i></a>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-default btn-xs" title="Смотреть все"><i class="fa fa-list"></i></a>
            </div>
        </div>
        <div class="block_body">
            <div class="list-group list-group-flush">
                @if($lastArticles)
                    @foreach($lastArticles as $article)

                        <div class="list-group-item list-group-item--static list-group-item--articles">
                            <div class="list-group-item-heading">
                                <div class="list-group-item-img">
                                    <a href="{{ route('admin.articles.edit', $article->id) }}">
                                        <img src="{{ ImageThumb::get($article->image, 'articles', '100') }}"
                                            alt="{{ $article->title }}">
                                    </a>
                                </div>
                                <div class="list-group-item-block">
                                    <a class="list-group-item-text" href="{{ route('admin.articles.edit', $article->id) }}" title="{{ $article->title }}">
                                        {!! $article->title !!}
                                    </a>
                                    <small class="text-muted"><i class="fa fa-clock-o"></i>
                                        <time class="timeago"
                                              datetime="{{ date('c', mysql_to_unix($article->created_at)) }}"
                                              title="{{ format_date($article->created_at, 4) }}">
                                            {{ format_date($article->created_at, 4) }}
                                        </time>
                                    </small>
                                </div>
                            </div>
                            <div class="list-group-item-icons">

                                <a href="{{ route('admin.articles.edit', $article->id) }}" title="Редактировать" class="list-group-item-icons-item"><i class="fa fa-edit"></i></a>

                                @if($article->published)
                                    <a href="{{ route('admin.articles.deactivate', $article->id) }}" title="Выключить" class="list-group-item-icons-item" onclick="return confirmMessage('Вы подтверждаете отключение? Статья будет недоступна пользователям!')"><i class="fa fa-check"></i></a>

                                    <a href="{{ route('article.show', $article->alias) }}" target="_blank" title="Смотреть на сайте" class="list-group-item-icons-item"><i class="fa fa-globe"></i></a>
                                @else
                                    <a href="{{ route('admin.articles.activate', $article->id) }}" title="Включить" class="list-group-item-icons-item" onclick="return confirmMessage('Вы подтверждаете включение? Статья будет доступна пользователям!')"><i class="fa fa-ban text-danger"></i></a>
                                @endif

                                @if($article->published)
                                    <div class="pull-right">
                                        @if( ! $article->enable_comments)
                                            <span class="list-group-item-icons-item" title="Комментарии отключены"><i class="fa fa-comment text-danger"></i></span>
                                        @else
                                            <span class="list-group-item-icons-item" title="Кол-во комментариев"><i class="fa fa-comment"></i> {{ $article->count_comments }}</span>
                                        @endif
                                        <span class="list-group-item-icons-item" title="Кол-во просмотров"><i class="fa fa-eye" aria-hidden="true"></i> {{ $article->hits }}</span>
                                    </div>
                                @else
                                    <div class="pull-right">
                                        @if( ! $article->enable_comments)
                                            <span class="list-group-item-icons-item list-group-item-icons-item--disabled" title="Комментарии отключены"><i class="fa fa-ban"></i></span>
                                        @else
                                            <span class="list-group-item-icons-item list-group-item-icons-item--disabled" title="Кол-во комментариев"><i class="fa fa-comment"></i> {{ $article->count_comments }}</span>
                                        @endif
                                        <span class="list-group-item-icons-item list-group-item-icons-item--disabled" title="Кол-во просмотров"><i class="fa fa-eye" aria-hidden="true"></i> {{ $article->hits }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>