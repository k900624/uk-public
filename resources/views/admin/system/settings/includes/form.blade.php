<fieldset>

    @if ($type == 'keys')

        @foreach ($settings as $key => $items)

            <legend>{{ $key }}</legend>

            @foreach ($items as $key => $item)
                @include('admin.system.settings.includes.item', ['item' => $item])
            @endforeach

        @endforeach

    @else
    
        @foreach ($settings as $item)
            @include('admin.system.settings.includes.item', ['item' => $item])
        @endforeach

    @endif

</fieldset>