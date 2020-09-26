
<div class="col-md-3">
    <section class="block block--sidebar">

        <header class="block_header">
            <h2>Группы меню</h2>
        </header>

        <div class="block_body">

            @if( ! empty($groups))

                <ul class="list-group">
                    @foreach($groups as $group)
                        <li>
                            <a href="{{ route('admin.menu.index', ['group' => $group->id]) }}" class="list-group-item{{ ($selectGroupId == $group->id) ? ' active' : '' }}">
                                {{ $group->title }}
                            </a>
                            <span class="list-group-item_actions hidden-xs">
                                <a data-remote="{{ route('admin.menu_group.edit', $group->id) }}" href="javascript:;" class="btn btn-sm btn-link btn-primary js-modal"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="{{ route('admin.menu_group.delete', $group->id) }}" class="btn btn-sm btn-link btn-danger" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
                            </span>
                        </li>
                    @endforeach
                </ul>

            @else
                <p>Группы не найдены</p>
            @endif
            
            <a data-remote="{{ route('admin.menu_group.create') }}" href="javascript:;" class="btn btn-success btn-block js-modal hidden-xs">
                Добавить <i class="fa fa-plus"></i>
            </a>

        </div>
    </section>
</div>