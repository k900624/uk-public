<div class="modal{{ ! empty($class) ? ' '. $class : '' }} fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog{{ ! empty($size) ? ' '. $size : '' }}" role="document">
        <div class="modal-content">
            @if ( ! empty($title))
                <div class="modal-header">
                    <div class="close" data-dismiss="modal" aria-hidden="true"></div>
                    <h4 class="modal-title">{{ $title }}</h4>
                </div>
            @endif

            @if ( ! empty($body))
                <div class="modal-body clearfix">
                    {!! $body !!}
                </div>
            @endif

            @if ( ! empty($footer))
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>