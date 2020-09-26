
@php
    $dash = str_repeat('&ndash; ', $level);
@endphp

<option value="{{ $child_category->id }}"
    @if($category->parent_id && $category->parent_id == $child_category->id) selected="" @endif
>{!! $dash . $child_category->title !!}</option>

@if(count($child_category->children))
    @foreach($child_category->children as $childCategory)
        {{-- Запрещаем выбор текущей категории и ее дочерних --}}
        @if($category->id && $category->id == $childCategory->id) @continue @endif
        @include('admin.articles.categories.includes.form_child', ['child_category' => $childCategory, 'level' => $level + 1])
    @endforeach
@endif
