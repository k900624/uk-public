
<table class="table table-striped table-bordered table-condensed">
    <tr>
        <th>IP адрес</th>
        <td>
            <strong>{{ $statistic->ip_address }}</strong>
            @if($statistic->in_blacklist)
                <a href="" class="btn btn-success btn-xs pull-right">Удалить из черного списка</a>
            @else
                <a href="" class="btn btn-danger btn-xs pull-right">Добавить в черный список</a>
            @endif
        </td>
    </tr>
    <tr>
        <th>Местоположение</th>
        <td>
            @if(defined('GEOIP_COUNTRY_EDITION'))
                @if($statistic->geoip_record)
                    <span class="icon icon_flag">
                        <img src="{{ url('images/flags/flat/16/'. $statistic->geoip_record['country_code'] .'.png') }}" alt="{{ $statistic->geoip_record['country_name'] }}">
                    </span>
                    <strong>{{ $statistic->geoip_record['country_name'] }}</strong><br />
                    {{ $statistic->geoip_record['city'] }}
                @endif
            @else
                Нет данных
            @endif
        </td>
    </tr>
    <tr>
        <th>Агент пользователя</th>
        <td>{{ $statistic->user_agent }}</td>
    </tr>
    <tr>
        <th>Последний визит</th>
        <td>
            <time class="timeago" 
                datetime="{{ date('c', mysql_to_unix($statistic->last_visit)) }}" 
                title="{{ format_date($statistic->last_visit, 4) }}">
                {{ format_date($statistic->last_visit, 4) }}
            </time>
        </td>
    </tr>
    <tr>
        <th>Всего посещений</th>
        <td>{{ $statistic->visits }}</td>
    </tr>

    @if( ! empty($statistic->params['browser']))
    <tr>
        <th>Браузер пользователя</th>
        <td>{{ $statistic->params['browser'] .' '. $statistic->params['browser_version'] }}</td>
    </tr>
    @endif

    @if( ! empty($statistic->params['platform']))
    <tr>
        <th>Платформа пользователя</th>
        <td>{{ $statistic->params['platform'] }}</td>
    </tr>
    @endif

    @if( ! empty($statistic->params['mobile']))
    <tr>
        <th>Мобильное устройство</th>
        <td>{{ $statistic->params['mobile'] }}</td>
    </tr>
    @endif

    @if ( ! empty($statistic->params['referrer']))
    <tr>
        <th>Адрес сайта, с которого произошел переход</th>
        <td><span title="{{ $statistic->params['referrer'] }}">{{ ellipsize($statistic->params['referrer'], 50, .7) }}</span></td>
    </tr>
    @endif
</table>

<div class="text-center">
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
</div>