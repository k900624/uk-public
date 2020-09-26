
<div class="col-md-3">
    <section class="block block--sidebar">

        <div class="block_body">

            <div class="list-group">
                <a href="{{ route('admin.comments.index') }}" class="list-group-item{{ ( ! $selectStatus) ? ' active' : '' }}">Все</a>
                <a href="{{ route('admin.comments.index', ['status' => 'new']) }}" class="list-group-item{{ ($selectStatus == 'new') ? ' active' : '' }}">Новые</a>
                <a href="{{ route('admin.comments.index', ['status' => 'active']) }}" class="list-group-item{{ ($selectStatus == 'active') ? ' active' : '' }}">Включенные</a>
                <a href="{{ route('admin.comments.index', ['status' => 'unactive']) }}" class="list-group-item{{ ($selectStatus == 'unactive') ? ' active' : '' }}">Выключенные</a>
                <a href="{{ route('admin.comments.index', ['status' => 'deleted']) }}" class="list-group-item{{ ($selectStatus == 'deleted') ? ' active' : '' }}">Удаленные</a>
            </div>

        </div>
    </section>
</div>