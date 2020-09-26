
<div class="col-md-3">
    <section class="block block--sidebar">

        <header class="block_header">
            <h2>Настройки</h2>
        </header>

        <div class="block_body">
                
            <ul class="list-group">
                <li>
                    <a class="list-group-item{{ ($uri_string == '/settings') ? ' active' : '' }}" href="{{ route('admin.settings.index') }}">
                        Настройки
                    </a>
                </li>
                <li>
                    <a class="list-group-item{{ ($uri_string == '/commands') ? ' active' : '' }}" href="{{ route('admin.commands.index') }}">
                        Команды Artisan
                    </a>
                </li>
                <li>
                    <a class="list-group-item{{ ($uri_string == '/logs') ? ' active' : '' }}" href="{{ route('admin.logs.index') }}">
                        Файлы логов
                    </a>
                </li>
                <li>
                    <a class="list-group-item{{ ($uri_string == '/feed') ? ' active' : '' }}" href="{{ route('admin.feed.index') }}">
                        Журнал событий
                    </a>
                </li>
            </ul>

        </div>
    </section>
</div>