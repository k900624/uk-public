
<div class="col-md-3">
    <section class="block block--sidebar">

        <div class="block_body">

            @if( ! empty($categories))

                <ul class="list-group">
                    <li>
                        <a href="{{ route('admin.faq.index') }}" class="list-group-item{{ ( ! $selectCatId) ? ' active' : '' }}">
                            Все
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('admin.faq.index', ['cat' => $category->id]) }}" class="list-group-item{{ ($selectCatId == $category->id) ? ' active' : '' }}">
                                {{ $category->title }}
                            </a>
                            <span class="list-group-item_actions hidden-xs">
                                <a data-remote="{{ route('admin.faq.category.edit', $category->id) }}" href="javascript:;" class="btn btn-sm btn-link btn-primary js-modal"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="{{ route('admin.faq.category.delete', $category->id) }}" class="btn btn-sm btn-link btn-danger" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
                            </span>
                        </li>
                    @endforeach
                </ul>

            @else
                <p>Категории не найдены</p>
            @endif
            
            <a data-remote="{{ route('admin.faq.category.create') }}" href="javascript:;" class="btn btn-success btn-block js-modal hidden-xs">
                Добавить <i class="fa fa-plus"></i>
            </a>

        </div>
    </section>
</div>