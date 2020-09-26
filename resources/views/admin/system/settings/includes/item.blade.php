<div class="form-group">
    <label for="{{ $item->key }}" class="col-sm-4 control-label">{{ $item->description }} 
        <br><small class="text-info" style="font-weight: normal; font-family: RobotoRegular, sans-serif, arial, verdana, Lucida Sans;">config('settings.{{ $item->key }}')</small>
    </label>
    <div class="col-sm-8">

        @if ($item->field == 'input')

            <input id="{{ $item->key }}" type="text" class="form-control" name="{{ $item->key }}" value="{{ $item->value }}">

        @elseif ($item->field == 'textarea')

            <textarea id="{{ $item->key }}" type="text" class="form-control" rows="5" name="{{ $item->key }}">{{ $item->value }}</textarea>

        @elseif ($item->field == 'checkbox')

            <input type="hidden" name="{{ $item->key }}" value="0">
            <input id="{{ $item->key }}" type="checkbox" class="form-control" name="{{ $item->key }}" value="1"@php checked($item->value == 1) @endphp>

        @endif

        @if ($item->help)
            <span class="help-block">{!! $item->help !!}</span>
        @endif

    </div>
</div>