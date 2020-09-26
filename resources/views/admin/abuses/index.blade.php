@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.abuses.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('content')
    <div class="col-md-9 col-md-offset-1">
        <section class="block">

            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество претензий">{{ $countAbuses }}</span>
                </h2>
            </header>

            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th>Отправитель</th>
                            <th class="hidden-sm">Дата изменения</th>
                            <th class="hidden-sm">Текст</th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($abuses as $item)
                            <tr>
                                <td class="nowrap">
                                    @if( ! empty($item->username))
                                        <a href="{{ route('admin.users.edit', $item->user_id) }}">{{ $item->username }}</a>
                                    @else
                                        {{ $item->name }}
                                        <small class="text-muted hidden-xs">Не зарегистрирован</small>
                                    @endif
                                    <small><a href="javascript:;"
                                              class="js-modal"
                                              data-remote="{{ route('admin.feedback.ajax_send_email') }}"
                                              data-email="{{ $item->email }}"
                                              data-id="{{ $item->id }}"
                                        >{{ $item->email }}</a></small>
                                </td>
                                <td class="hidden-sm hidden-xs">
                                    <time title="{{ format_date($item->created_at, 4) }}">
                                        {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    </time>
                                </td>
                                <td><p>{{ str_limit($item->text, 40) }}</p></td>
                                <td class="col-action">
                                    <div class="btn-group">
                                        <a data-remote="{{ route('admin.abuses.show', $item->id) }}" class="js-modal btn btn-sm btn-default" href="javascript:;"><i class="fa fa-search"></i></a>
                                        <a href="{{ route('admin.abuses.delete', $item->id) }}" class="btn btn-sm btn-danger hidden-xs" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Претензии не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            @if ($abuses->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $abuses->links() }}
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
