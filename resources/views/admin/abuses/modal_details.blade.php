<div class="well">
    <table class="table table-condensed">
        <tr>
            <th><strong>Автор:</strong></th>
            <td>
                @if($abuse->user_id)
                    <a href="{{ route('admin.users.edit', $abuse->user_id ) }}" target="blank">
                        {{ $abuse->username }}
                    </a>
                @else
                    {{ $abuse->name }}
                @endif
            </td>
        </tr>
        <tr>
            <th><strong>E-mail:</strong></th>
            <td>
                <a href="javascript:;" class="js-modal" data-remote="{{ route('admin.feedback.ajax_send_email') }}" data-email="{{ $abuse->email }}" data-id="{{ $abuse->id }}">{{ $abuse->email }}</a>
            </td>
        </tr>
        <tr>
            <th><strong>Создано:</strong></th>
            <td>{{ $abuse->created_at }}</td>
        </tr>
    </table>
</div>

<p class="form-control-static">{{ $abuse->text }}</p>

<div class="modal-footer">
    <a href="javascript:;" class="js-modal btn btn-primary" data-remote="{{ route('admin.feedback.ajax_send_email') }}" data-email="{{ $abuse->email }}" data-id="{{ $abuse->id }}"><i class="fa fa-reply"></i> Ответить</a>
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
</div>
