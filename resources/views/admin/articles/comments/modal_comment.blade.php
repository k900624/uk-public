
<form action="{{ route('admin.comments.update', $comment->id) }}" class="form validate" method="post" accept-charset="utf-8">

    {{ method_field('PATCH')}}
    {{ csrf_field() }}
    <div class="well">
        <table class="table table-condensed no-margin">
            <tr>
                <th><strong>Автор:</strong></th>
                <td>
                    @if( ! empty($comment->username))
                        <a href="{{ route('admin.users.edit', $comment->user_id) }}">{{ $comment->username }}</a>
                    @else
                        {{ $comment->name }}
                    @endif
                </td>
            </tr>
            <tr>
                <th><strong>IP адрес:</strong></th>
                <td>
                    {{ $comment->ip_address }}
                    @if($comment->in_blacklist)
                        <a href="{{ route('admin.users.blacklist.remove', $comment->user_id) }}" class="btn btn-success btn-xs pull-right">Удалить из черного списка</a>
                    @else
                        <a href="{{ route('admin.users.blacklist.add', $comment->user_id) }}" class="btn btn-danger btn-xs pull-right">Добавить в черный список</a>
                    @endif
                </td>
            </tr>
            <tr>
                <th><strong>E-mail:</strong></th>
                <td>
                    <a href="javascript:;"
                       class="js-modal"
                       data-remote="{{ route('admin.feedback.ajax_send_email') }}"
                       data-email="{{ $comment->email }}"
                       data-id="{{ $comment->id }}"
                    >{{ $comment->email }}</a>
                </td>
            </tr>
            <tr>
                <th><strong>Дата создания:</strong></th>
                <td>
                    {{ $comment->date }}
                </td>
            </tr>
            <tr>
                <th>Статус</th>
                <td>
                    <select name="status" class="form-control" style="height: 31px;">
                        <option value="off" {{ ($comment->status == 'off') ? 'selected=""' : '' }}>Ожидает одобрения</option>
                        <option value="on" {{ ($comment->status == 'on') ? 'selected=""' : '' }}>Одобрен</option>
                        <option value="deleted" {{ ($comment->status == 'deleted') ? 'selected=""' : '' }}>Удален</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <p><textarea name="message" class="form-control" rows="6">{{ $comment->message }}</textarea></p>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
    </div>

</form>