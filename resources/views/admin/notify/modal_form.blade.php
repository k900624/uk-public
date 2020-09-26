
<form action="javascript:;" id="ajax-notify-form" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    @isset ($user)
    <p class="alert alert-info">Уведомление будет отправлено пользователю {{ $user->name }}</p>
    @else
    <p class="alert alert-info">Уведомление будет отправлено всем пользователям</p>
    @endisset
    <div class="form-group">
        <textarea name="text" rows="8" id="text" class="form-control" required="" placeholder="Текст уведомления"></textarea>
    </div>
    <div class="form-group text-center">
        <button class="btn btn-primary has-spinner" type="submit" name="submit">Отправить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#ajax-notify-form').validate();
    });

    var $routeNotify = '{{ $route }}';
</script>