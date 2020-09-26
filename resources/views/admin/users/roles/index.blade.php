@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.users.roles.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('content')

    <div class="col-md-8 col-md-offset-1">
        <section class="block">
            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество пользователей">{{ $countRoles }}</span>
                </h2>
                <div class="action">
                    <a href="{{ route('admin.users.roles.create') }}" class="btn btn-default btn-xs"><span class="hidden-xs">Добавить</span> <i class="fa fa-plus"></i></a>
                </div>
            </header>
            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th>#ID</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Кол-во пользователей</th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td class="hidden-xs"><strong>{{ $role->id }}</strong></td>
                                <td><a href="{{ route('admin.users.roles.edit', $role->id) }}" title="Редактировать">{{ $role->name }}</a></td>
                                <td class="hidden-xs">{{ $role->display_name }}</td>
                                <td class="hidden-xs text-center">{{ $role->users->count() }}</td>
                                <td class="col-action">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.users.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        @php $disabled = ($role->name == 'admin' || $role->users->count() > 0) ? ' disabled' : '' @endphp
                                        <a href="{{ route('admin.users.roles.delete', $role->id) }}" class="btn btn-sm btn-danger hidden-xs{{ $disabled }}" onclick="return confirmMessage()">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Группы не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            @if($roles->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $roles->links() }}
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
