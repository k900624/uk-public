<aside class="l-sidebar hidden-print @isset($_COOKIE['hideSidebarState'])) {{ $_COOKIE['hideSidebarState'] == 1 ? ' is_hidden' : '' }}@endisset">
    <div class="sidebar">
        <div class="sidebar-wrap">
            <ul class="sidebar-nav" id="sidebar-accordion" role="tablist">

                <li class="panel sidebar-nav-item sidebar-nav-item--avatar clearfix">
                    <a href="{{ route('admin.users.edit', auth()->id()) }}" class="sidebar-nav-item_link">
                        @php
                            $nameLine = (App\Services\CurrentUser::first_name())
                                ? App\Services\CurrentUser::first_name() .' '. App\Services\CurrentUser::last_name()
                                : App\Services\CurrentUser::name();
                            $avatar = (App\Services\CurrentUser::avatar())
                                ? url('storage/'. App\Services\CurrentUser::avatar())
                                : new \YoHang88\LetterAvatar\LetterAvatar($nameLine, 'circle', 50);
                        @endphp
                        <img src="{{ $avatar }}" alt="{{ $nameLine }}" class="user_avatar img-circle" style="width: 50px">
                        <div class="sidebar-nav-item_username">{{ App\Services\CurrentUser::name() }}</div>
                        <div class="sidebar-nav-item_username-group">{{ App\Services\CurrentUser::role_display_name() }}</div>
                    </a>
                </li>

                @php $i = 1 @endphp
                
                @foreach($getAdminNavigation as $item)

                    @php $active = false @endphp
                    @if(count($item->children))

                        @foreach($item->children as $child)
                            @php $active = (preg_match('#^'. $child->link .'#', $uri_string)) ? true : false @endphp
                            @php if ($active) break @endphp
                        @endforeach

                    @else
                        @php if (Request::is('admin')) $active = true; @endphp
                    @endisset

                    <li class="panel sidebar-nav-item{{ ($active) ? ' active' : '' }}">
                        @if(count($item->children))
                            <a class="sidebar-nav-link{{ ($active) ? '' : ' collapsed' }}"
                               role="button"
                               data-toggle="collapse"
                               data-parent="#sidebar-accordion"
                               href="#collapse_{{ $i }}"
                               aria-expanded="{{ ($active) ? 'true' : 'false' }}"
                               aria-controls="collapse_{{ $i }}">
                                @if($item['icon'])
                                    <i class="{{ $item['icon'] }}"></i>
                                @endif
                                {{ $item['title'] }}
                                <i class="fa fa-angle-down pull-right"></i>
                            </a>
                            
                            <ul id="collapse_{{ $i }}" class="sidebar-subnav collapse{{ ($active) ? ' in' : '' }}" aria-expanded="{{ ($active) ? 'true' : 'false' }}">
                            @foreach($item->children as $child)

                                @php $active_item = false; @endphp
                                @php $active_item = preg_match('#^'. $child->link .'#', $uri_string) @endphp
                                @if($child->link == '/users')
                                    @php $active_item = ($child->link == $uri_string || preg_match('#(users/edit|users/create)#', $uri_string)) ? true : false @endphp
                                @endif

                                <li class="sidebar-subnav-item{{ $active_item ? ' active' : '' }}">
                                    <a class="sidebar-subnav-link" href="{{ url('admin'. $child->link) }}">{{ $child->title }}</a>
                                </li>
                            @endforeach
                            </ul>
                        @else
                            <a class="sidebar-nav-link" href="{{ url('admin'. $item['link']) }}">
                                @if($item['icon'])
                                    <i class="{{ $item['icon'] }}"></i>
                                @endif
                                {{ $item['title'] }}
                            </a>
                        @endisset
                    </li>
                
                    @php $i++ @endphp
                @endforeach

            </ul>
        </div>

        <div class="sidebar_footer">
            &copy; SXCore
        </div>
    </div>
</aside>

<aside class="settings-block visible-xs-block">
    <ul class="settings-list">

        <li class="settings-item">
            <a href="javascript:;" class="settings-link" title="Настройки">
                <i class="fa fa-cog"></i> Настройки
            </a>
            <ul class="settings-sublist">
                <li><a class="settings-link" href="{{ route('admin.settings.index') }}">Настройки</a></li>
                <li><a class="settings-link" href="{{ route('admin.commands.index') }}">Команды Artisan</a></li>
                <li><a class="settings-link" href="{{ route('admin.logs.index') }}">Логи</a></li>
                <li><a class="settings-link" href="{{ route('admin.feed.index') }}">Журнал событий</a></li>
            </ul>
        </li>
        
        <li class="settings-item">
            <a href="javascript:;" class="settings-link dropdown-toggle" title="Аккаунт">
                <i class="fa fa-user"></i> Аккаунт
            </a>
            <ul class="settings-sublist">
                <li><a class="settings-link" href="{{ route('admin.users.account.edit', auth()->id()) }}">Аккаунт</a></li>
                <li><a class="settings-link" href="{{ route('admin.users.edit', auth()->id()) }}">Профиль</a></li>
                <li><a class="settings-link" href="{{ route('admin.logout') }}">Выход</a></li>
            </ul>
        </li>
    </ul>
</aside>