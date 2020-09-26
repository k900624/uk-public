
<form action="javascript:;" id="ajax-email-form" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="email" name="email" value="{{ $email }}" id="email" class="form-control" required="" placeholder="Email">
    </div>
    <div class="form-group">
        <input type="text" name="subject" value="{{ $subject }}" id="subject" class="form-control" required="" placeholder="Тема письма">
    </div>
    <div class="form-group">
        <textarea name="message" rows="8" id="message" class="form-control" required="" placeholder="Сообщение"></textarea>
    </div>
    <div class="form-group text-center">
        @if($message_id)
            <input type="hidden" name="message_id" value="{{ $message_id }}">
        @endif
        <button class="btn btn-primary js-feedback-submit has-spinner" type="submit" name="submit">Отправить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#ajax-email-form').validate();
    });
</script>