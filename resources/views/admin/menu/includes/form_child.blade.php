
@php
    $dash = str_repeat('&ndash; ', $level);
@endphp

<option value="{{ $child_menu->id }}"
    @if($menu->parent_id && $menu->parent_id == $child_menu->id) selected="" @endif
>{!! $dash . $child_menu->title !!}</option>

@if(count($child_menu->children))
    @foreach($child_menu->children as $childMenu)
        {{-- Запрещаем выбор текущей категории и ее дочерних --}}
        @if($menu->id && $menu->id == $childMenu->id) @continue @endif
        @include('admin.menu.includes.form_child', ['child_menu' => $childMenu, 'level' => $level + 1])
    @endforeach
@endif
