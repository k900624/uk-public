
<div class="col-md-3">
    <section class="block block--sidebar">

        <header class="block_header">
            <h2>Группы</h2>
        </header>

        <div class="block_body">

            @if( ! empty($roles))

                <ul class="list-group">
                    <li>
                        <a href="{{ route('admin.users.index', ['role' => 'all']) }}" class="list-group-item{{ ($selectRoleId == 'all') ? ' active' : '' }}">
                            Все
                        </a>
                    </li>
                    @foreach($roles as $role)
                        <li>
                            <a href="{{ route('admin.users.index', ['role' => $role->id]) }}" class="list-group-item{{ ($selectRoleId == $role->id) ? ' active' : '' }}">
                                {{ $role->display_name }}
                            </a>
                            @if ($role->name != 'admin')
                                <span class="list-group-item_actions hidden-xs">
                                    <a href="{{ route('admin.users.roles.edit', $role->id) }}" class="btn btn-sm btn-link btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <a href="{{ route('admin.users.roles.create') }}" class="btn btn-success btn-block hidden-xs">
                    Добавить <i class="fa fa-plus"></i>
                </a>

            @else
                <p>Группы не найдены</p>
            @endif

        </div>
    </section>

</div>