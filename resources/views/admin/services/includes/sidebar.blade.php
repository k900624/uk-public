
<div class="col-md-3">
    <section class="block block--sidebar">

        <header class="block_header">
            <h2>Группы</h2>
        </header>

        <div class="block_body">

            @if( ! empty($services))

                <ul class="list-group">
                    <li><a href="{{ route('admin.services.index') }}" class="list-group-item{{ ( ! $selectGroup) ? ' active' : '' }}">Все</a></li>
                    @foreach($servicesGroups as $group)
                        <li>
                            <a href="{{ route('admin.services.index', ['group' => $group->id]) }}" class="list-group-item{{ ($selectGroup == $group->id) ? ' active' : '' }}">
                                {{ $group->title }}
                            </a>
                            <span class="list-group-item_actions hidden-xs">
                                <a href="{{ route('admin.services.groups.edit', $group->id) }}" class="btn btn-sm btn-link btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                            </span>
                        </li>
                    @endforeach
                </ul>

                <a href="{{ route('admin.services.groups.create') }}" class="btn btn-success btn-block hidden-xs">
                    Добавить <i class="fa fa-plus"></i>
                </a>

            @else
                <p>Группы не найдены</p>
            @endif

        </div>
    </section>
</div>