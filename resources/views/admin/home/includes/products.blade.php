<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
    <div class="block block--full">
        <div class="block_header">
            <h2>
                Товары
                <span class="label label-success animated bounceIn">{{ $countProducts }}</span>
            </h2>
            <div class="action">
                <a href="{{ route('admin.shop.products.create') }}" class="btn btn-default btn-xs" title="Новый товар"><i class="fa fa-plus"></i></a>
                <a href="{{ route('admin.shop.products.index') }}" class="btn btn-default btn-xs" title="Смотреть все"><i class="fa fa-list"></i></a>
            </div>
        </div>
        <div class="block_body">
            <div class="list-group list-group-flush">
                @if($lastProducts)
                    @foreach($lastProducts as $product)

                        <div class="list-group-item list-group-item--static list-group-item--products">
                            <div class="list-group-item-heading">
                                <div class="list-group-item-img">
                                    <a href="{{ route('admin.shop.products.edit', $product->id) }}">
                                        <img src="{{ ImageThumb::get($product->image, 'products', '200') }}"
                                             alt="{{ $product->title }}">
                                    </a>
                                </div>
                                <div class="list-group-item-block">
                                    <a class="list-group-item-text" href="{{ route('admin.shop.products.edit', $product->id) }}" title="{{ $product->title }}">
                                        {!! $product->title !!}
                                    </a>
                                    <small class="text-muted"><i class="fa fa-clock-o"></i>
                                        <time class="timeago"
                                              datetime="{{ date('c', mysql_to_unix($product->created_at)) }}"
                                              title="{{ format_date($product->created_at, 4) }}">
                                            {{ format_date($product->created_at, 4) }}
                                        </time>
                                    </small>
                                </div>
                            </div>
                            
                            <div class="list-group-item-icons">

                                <a href="{{ route('admin.shop.products.edit', $product->id) }}" title="Редактировать" class="list-group-item-icons-item"><i class="fa fa-edit"></i></a>

                                @if($product->published)
                                    <a href="{{ route('admin.shop.products.deactivate', $product->id) }}" title="Выключить" class="list-group-item-icons-item" onclick="return confirmMessage('Вы подтверждаете отключение? Статья будет недоступна пользователям!')"><i class="fa fa-check"></i></a>

                                    <a href="{{ route('product.show', $product->alias) }}" target="_blank" title="Смотреть на сайте" class="list-group-item-icons-item"><i class="fa fa-globe"></i></a>
                                @else
                                    <a href="{{ route('admin.shop.products.activate', $product->id) }}" title="Включить" class="list-group-item-icons-item" onclick="return confirmMessage('Вы подтверждаете включение? Статья будет доступна пользователям!')"><i class="fa fa-ban text-danger"></i></a>
                                @endif

                                @if($product->published)
                                    <div class="pull-right">
                                        <span class="list-group-item-icons-item" title="Кол-во просмотров"><i class="fa fa-eye" aria-hidden="true"></i> {{ $product->hits }}</span>
                                    </div>
                                @else
                                    <div class="pull-right">
                                        <span class="list-group-item-icons-item list-group-item-icons-item--disabled" title="Кол-во просмотров"><i class="fa fa-eye" aria-hidden="true"></i> {{ $product->hits }}</span>
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