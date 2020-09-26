<header class="l-header hidden-print">
    <div class="header">

        <nav class="header_nav">
            <ul class="nav_list">
                <li class="nav_item hidden-xs">
                    <a href="javascript:;" class="nav_link js-sidebar-toggle"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav_item logo">
                    <a href="{{ route('admin.dashboard.index') }}" class="nav_link logo_link" role="logo">SXCore</a>
                </li>
                <li class="nav_item hidden-xs">
                    <a href="{{ route('home') }}" class="nav_link" target="_blank" title="Перейти на сайт"><i class="fa fa-home"></i></a>
                </li>
            </ul>
            
            <ul class="nav_list hidden-xs">

                <li class="nav_item">
                    <a href="{{ route('admin.design.index') }}" class="nav_link" title="Дизайн админки">
                        <i class="fa fa-magic"></i>
                    </a>
                </li>

                <li class="nav_item dropdown">
                    <a href="javascript:;" class="nav_link nav_link--feedback dropdown-toggle" data-toggle="dropdown" title="Сообщения обратной связи">
                        <i class="fa fa-envelope-o"></i>
                        @if ($countNewMessages)
                            <span class="count animated bounceIn">{{ $countNewMessages }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu--big dropdown-menu-right animated fadeInDown">
                        <li>
                            @if ($newMessages)
                            <ul class="menu">
                                @foreach ($newMessages as $item)
                                <li>
                                    <a href="javascript:;" data-remote="{{ route('admin.feedback.show', $item->id) }}" class="js-modal">
                                        <h4>
                                            {{ $item->username }}
                                            <small><i class="fa fa-clock-o"></i> {{ $item->timeago }}</small>
                                        </h4>
                                        <p>{!! $item->message !!}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li class="footer"><a href="{{ route('admin.feedback.index') }}">Смотреть все</a></li>
                    </ul>
                </li>

                {{-- <li class="nav_item dropdown">
                    <a href="javascript:;" class="nav_link nav_link--comments dropdown-toggle" data-toggle="dropdown" title="Комментарии">
                        <i class="fa fa-comments"></i>
                        @if ($countNewComments)
                            <span class="count animated bounceIn">{{ $countNewComments }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu--big dropdown-menu-right animated fadeInDown">
                        <li>
                            @if ($newComments)
                            <ul class="menu">
                                @foreach($newComments as $item)
                                <li>
                                    <a href="javascript:;" data-remote="{{ route('admin.comments.show', $item->id) }}" class="js-modal">
                                        <h4>
                                            {{ $item->name }}
                                            <small><i class="fa fa-clock-o"></i> {{ $item->timeago }}</small>
                                        </h4>
                                        <p>{!! $item->message !!}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li class="footer"><a href="{{ route('admin.comments.index') }}">Смотреть все</a></li>
                    </ul>
                </li> --}}

                <li class="nav_item dropdown">
                    <a href="javascript:;" class="nav_link dropdown-toggle" title="Настройки" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right animated fadeInDown">
                        <li><a href="{{ route('admin.settings.index') }}">Настройки</a></li>
                        <li><a href="{{ route('admin.commands.index') }}">Команды Artisan</a></li>
                        <li><a href="{{ route('admin.logs.index') }}">Логи</a></li>
                        <li><a href="{{ route('admin.feed.index') }}">Журнал событий</a></li>
                    </ul>
                </li>
                
                <li class="nav_item dropdown">
                    <a href="javascript:;" class="nav_link dropdown-toggle" title="Аккаунт" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu--user dropdown-menu-right animated fadeInDown">
                        <li><a href="{{ route('admin.users.account.edit', auth()->id()) }}">Аккаунт</a></li>
                        <li><a href="{{ route('admin.users.edit', auth()->id()) }}">Профиль</a></li>
                        <li><a href="{{ route('admin.logout') }}">Выход</a></li>
                    </ul>
                </li>
            </ul>

            <div class="header-toggle header-toggle--sidebar visible-xs-block">
                <a href="#main-nav" class="hamburger hamburger--elastic" data-toggle="sidebar-show">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </a>
            </div>

            <div class="header-toggle header-toggle--settings visible-xs-block">
                <a href="#main-nav" class="hamburger hamburger--elastic" data-toggle="settings-show">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </a>
            </div>

        </nav>

    </div>
</header>