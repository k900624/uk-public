
@php
    $dash = ' style="margin-left: '. 20 * $level .'px;"';

    $published = ($child_category->published)
        ? '<a href="'. route('admin.categories.deactivate', $child_category->id) .'"
            title="Отключить категорию"
            onclick="return confirmMessage(\'Вы подтверждаете отключение? Категория и все дочерние категории будут недоступны пользователям!\')"><span class="label label-success">Вкл.</span></a>'
        : '<a href="'. route('admin.categories.activate', $child_category->id) .'"
            title="Активировать категорию"
            onclick="return confirmMessage(\'Вы подтверждаете включение? Категория будет доступна пользователям!\')"><span class="label label-grey">Выкл.</span></a>'
@endphp

<tr>
    <td>
        <span {!! $dash !!} class="simple-tree">↳</span>
        <a href="{{ route('admin.categories.edit', $child_category->id) }}" title="Редактировать">{{ $child_category->title }}</a>
    </td>
    <td class="hidden-sm hidden-xs" title="Сумма кол-ва статей дочерних категорий">
        @if($child_category->atriclesCount > 0)
            <span class="badge badge-default">{{ $child_category->atriclesCount }}</span>
        @else
            <span class="badge badge-outline-default">0</span>
        @endif
    </td>
    <td class="hidden-xs text-center">
        <div class="js-order-contenteditable"
             data-id="{{ $child_category->id }}"
             data-object="categories"
             contenteditable=""
             title="Кликните, чтобы редактировать">
            {{ $child_category->ordering }}
        </div>
    </td>
    <td class="hidden-xs text-center">{!! $published !!}</td>
    <td class="col-action">
        <div class="btn-group">
            @php $disabled = ($child_category->atriclesCount > 0 || count($child_category->children)) ? ' disabled' : '' @endphp
            <a href="{{ route('admin.categories.edit', $child_category->id) }}"
               class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
            <a href="{{ route('admin.categories.delete', $child_category->id) }}"
               class="btn btn-sm btn-danger hidden-xs{{ $disabled }}"
               onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
        </div>
    </td>
</tr>

@if(count($child_category->children))
    @foreach($child_category->children as $childCategory)
        @php $childCategory->atriclesCount = $categoryRepo->getCategoryArticlesCount($childCategory->id, $childCategory->parent_id) @endphp
        @include('admin.articles.categories.includes.index_child', ['child_category' => $childCategory, 'level' => $level + 1])
    @endforeach
@endif
