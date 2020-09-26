@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.feed.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('content')

    @include('admin.system.settings.includes.sidebar')

    <div class="col-md-9">
        <section class="block">
            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество событий">{{ $countFeeds }}</span>
                </h2>
                <div class="action">
                    @if ($countFeeds)
                        <a href="{{ route('admin.feed.deleteAll') }}" class="btn btn-default btn-xs" onclick="return confirmMessage()"><span class="hidden-xs">Очистить все</span> <i class="fa fa-trash-o"></i></a>
                    @endif
                </div>
            </header>
            <div class="block_body">

                @if($countFeeds)

                    <div id="feed" class="feed">
                        <div class="wrapper">
                            <div class="vertical-line"></div>
                          
                            @foreach ($feeds as $item)
                                <section class="feed-item">
                                    <div class="icon pull-left">
                                        @if ($item->type == 'success')
                                            <i class="fa fa-check text-success"></i>
                                        @elseif ($item->type == 'error')
                                            <i class="fa fa-ban text-danger"></i>
                                        @elseif ($item->type == 'order')
                                            <i class="fa fa-shopping-cart text-success"></i>
                                        @elseif ($item->type == 'register')
                                            <i class="fa fa-user text-success"></i>
                                        @elseif ($item->type == 'comment')
                                            <i class="fa fa-comment text-success"></i>
                                        @elseif ($item->type == 'feedback')
                                            <i class="fa fa-comment text-success"></i>
                                        @elseif ($item->type == 'review')
                                            <i class="fa fa-comment text-success"></i>
                                        @endif
                                    </div>
                                    <div class="feed-item-body">
                                        <div class="text">
                                            <a href="{{ route('admin.users.show', $item->user_id) }}">{{ $item->name }}</a>
                                            {!! $item->activity !!}
                                        </div>
                                        <div class="time pull-left">
                                            <time title="{{ format_date($item->created_at, 4) }}">
                                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                            </time>
                                        </div>
                                    </div>
                                </section>
                            @endforeach
                          
                        </div>
                    </div>
                    
                @else
                    <p>События не найдены</p>
                @endif

            </div>

            @if ($feeds->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $feeds->links() }}
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
