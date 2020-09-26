@php $published = ($child_menu->published)
    ? '<a href="'. route('admin.menu.deactivate', $child_menu->id) .'"
        title="Отключить пункт меню"
        onclick="return confirmMessage(\'Вы подтверждаете отключение? Пункт меню будет недоступен пользователям!\')"><span class="label label-success">Вкл.</span></a>'
    : '<a href="'. route('admin.menu.activate', $child_menu->id) .'"
        title="Активировать пункт меню"
        onclick="return confirmMessage(\'Вы подтверждаете включение? Пункт меню будет доступен пользователям!\')"><span class="label label-grey">Выкл.</span></a>'
@endphp

@php $level = (isset($level)) ? $level : 1; @endphp

<tr>
    <td>
        <span style="margin-left: {{ 20 * ($level) }}px;" class="simple-tree">↳</span>
        <a href="{{ route('admin.menu.edit', $child_menu->id) }}" title="Редактировать">{{ $child_menu->title }}</a>
    </td>
    <td class="hidden-xs">{{ $child_menu->link }}</td>
    <td class="hidden-xs text-center">{!! $published !!}</td>
    <td class="hidden-xs text-center">
        <div class="order-contenteditable js-order-contenteditable" data-id="{{ $child_menu->id }}" data-object="menus" contenteditable="" title="Кликните, чтобы редактировать">
            {{ $child_menu->ordering }}
        </div>
    </td>
    <td class="col-action">
        <div class="btn-group">
            <a href="{{ route('admin.menu.edit', $child_menu->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
            <a href="{{ route('admin.menu.delete', $child_menu->id) }}" class="btn btn-sm btn-danger hidden-xs" onclick="return confirmMessage()">
                <i class="fa fa-trash-o"></i>
            </a>
        </div>
    </td>
</tr>

@if (! empty($child_menu->children))
    @foreach ($child_menu->children as $childMenu)
        @include('admin.menu.includes.index_child', ['child_menu' => $childMenu, 'level' => $level + 1])
    @endforeach
@endif

