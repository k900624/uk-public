
<div class="col-md-3">
    <section class="block block--sidebar">

        <header class="block_header">
            <h2>Категории</h2>
        </header>

        <div class="block_body">

            @if( ! empty($categories))

                <ul class="list-group">
                    <li><a href="{{ route('admin.articles.index') }}" class="list-group-item{{ ( ! $selectCatId) ? ' active' : '' }}">Все</a></li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('admin.articles.index', ['cat' => $category->id]) }}" class="list-group-item{{ ($selectCatId == $category->id) ? ' active' : '' }}">
                                {{ $category->title }}
                            </a>
                            <span class="list-group-item_actions hidden-xs">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-link btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                            </span>
                        </li>
                    @endforeach
                </ul>

                <a href="{{ route('admin.categories.create', ['parent' => 1]) }}" class="btn btn-success btn-block hidden-xs">
                    Добавить <i class="fa fa-plus"></i>
                </a>

            @else
                <p>Категории не найдены</p>
            @endif

        </div>
    </section>
</div>