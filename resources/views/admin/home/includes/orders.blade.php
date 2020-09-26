<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
    <div class="block block--full">
        <div class="block_header">
            <h2>
                Новые заказы
                <span class="label label-success animated bounceIn">{{ $countOrders }}</span>
            </h2>
            <div class="action">
                <a href="{{ route('admin.shop.orders.index') }}" class="btn btn-default btn-xs" title="Смотреть все"><i class="fa fa-list"></i></a>
            </div>
        </div>
        <div class="block_body">
            <div class="list-group list-group-flush">
                @if($lastOrders)
                    @foreach($lastOrders as $order)

                        <div class="list-group-item list-group-item--static">
                            <div class="list-group-item-heading clearfix">
                                <div class="pull-left">
                                    {{ Str::words($order->name, 2) }}
                                    <small class="flex">
                                        <a href="javascript:;"
                                           class="js-modal text-grey-darken-1"
                                           data-remote="{{ route('admin.feedback.ajax_send_email') }}"
                                           data-email="{{ $order->email }}"
                                           data-id="{{ $order->id }}">{{ $order->email }}
                                        </a>
                                    </small>
                                    {{--<small class="flex text-grey-darken-2">{{ $order->phone }}</small>--}}
                                </div>

                                <div class="pull-right">
                                    <small class="text-muted"><i class="fa fa-clock-o"></i>
                                        <time class="timeago"
                                              datetime="{{ date('c', mysql_to_unix($order->created_at)) }}"
                                              title="{{ format_date($order->created_at, 4) }}">
                                            {{ format_date($order->created_at, 4) }}
                                        </time>
                                    </small>
                                </div>
                            </div>
                            <div class="list-group-item-text">
                                <a href="{{ route('admin.shop.orders.show', $order->id) }}" title="Смотреть">
                                    Заказ #{{ $order->id }}</a> на <strong>{!! $order->sum !!}</strong>
                                <span class="label pull-right" style="background-color: {{ $order->status_color}}" title="{{ $order->status_description }}">
                                    {{ $order->status_text }}
                                </span>
                            </div>
                        </div>

                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>