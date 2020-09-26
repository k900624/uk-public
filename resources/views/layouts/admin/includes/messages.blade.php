@if($errors->any())
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>

            @foreach($errors->all() as $error)
                {!! $error !!}<br/>
            @endforeach
        </div>
    </div>
@elseif(session()->get('flash_success'))
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>

            @if(is_array(json_decode(session()->get('flash_success'), true)))
                {!! implode('', session()->get('flash_success')->all(':message<br/>')) !!}
            @else
                {!! session()->get('flash_success') !!}
            @endif
        </div>
    </div>
@elseif(session()->get('flash_warning'))
    <div class="col-md-12">
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>

            @if(is_array(json_decode(session()->get('flash_warning'), true)))
                {!! implode('', session()->get('flash_warning')->all(':message<br/>')) !!}
            @else
                {!! session()->get('flash_warning') !!}
            @endif
        </div>
    </div>
@elseif(session()->get('flash_info'))
    <div class="col-md-12">
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>

            @if(is_array(json_decode(session()->get('flash_info'), true)))
                {!! implode('', session()->get('flash_info')->all(':message<br/>')) !!}
            @else
                {!! session()->get('flash_info') !!}
            @endif
        </div>
    </div>
@elseif(session()->get('flash_danger'))
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>

            @if(is_array(json_decode(session()->get('flash_danger'), true)))
                {!! implode('', session()->get('flash_danger')->all(':message<br/>')) !!}
            @else
                {!! session()->get('flash_danger') !!}
            @endif
        </div>
    </div>
@elseif(session()->get('flash_message'))
    <div class="col-md-12">
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>

            @if(is_array(json_decode(session()->get('flash_message'), true)))
                {!! implode('', session()->get('flash_message')->all(':message<br/>')) !!}
            @else
                {!! session()->get('flash_message') !!}
            @endif
        </div>
    </div>
@endif
