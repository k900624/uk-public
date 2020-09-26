<div class="well">
    <table class="table table-condensed">
        <tr>
            <th><strong>Автор:</strong></th>
            <td>
                @if($message->user_id)
                    <a href="{{ route('admin.users.edit', $message->user_id ) }}" target="blank">
                        {{ $message->first_name }} {{ $message->last_name }}
                    </a>
                @else
                    {{ $message->name }}
                @endif
            </td>
        </tr>
        <tr>
            <th><strong>E-mail:</strong></th>
            <td>
                <a href="javascript:;" class="js-modal" data-remote="{{ route('admin.feedback.ajax_send_email') }}" data-email="{{ $message->email }}" data-id="{{ $message->id }}">{{ $message->email }}</a>
            </td>
        </tr>
        <tr>
            <th><strong>IP адрес:</strong></th>
            <td>{{ $message->ip_address }}</td>
        </tr>
        <tr>
            <th><strong>Создано:</strong></th>
            <td>{{ $message->date }}</td>
        </tr>
        <tr>
            <th>Статус:</th>
            <td>
                <span class="label label-{{ $message->status_class }}">{{ $message->status_label }}</span>
            </td>
        </tr>
    </table>
</div>

<h4>Тема: {{ $message->subject }}</h4>
<p class="form-control-static">{{ $message->message }}</p>

@if($message->attach)
    <h6>Прикреплены файлы:</h6>
    <ul>
        @foreach ($message->attach as $file)
            @if (Storage::disk('public')->exists($file->download_link))
                <li><small><a href="{{ url('admin/download/'. $file->download_link .'/'. $file->original_name) }}">{{ $file->original_name }}</a></small></li>
            @endif
        @endforeach
    </ul>
@endif

@if($message->answer)
    <blockquote class="blockquote">
        <p>Ответ</p>
        <small>{{ $message->answer }}</small>
    </blockquote>
@endif

<div class="modal-footer">
    <a href="javascript:;" class="js-modal btn btn-primary" data-remote="{{ route('admin.feedback.ajax_send_email') }}" data-subject="Re: {{ $message->subject }}" data-email="{{ $message->email }}" data-id="{{ $message->id }}"><i class="fa fa-reply"></i> Ответить</a>
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
</div>
