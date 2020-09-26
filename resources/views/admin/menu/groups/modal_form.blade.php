<form action="{{ $action }}" id="ajax-menu-group-form" class="validate" method="post" accept-charset="utf-8">
    @if($menu_group->id)
        {{ method_field('PATCH')}}
    @endif
    {{ csrf_field() }}
    
    <fieldset>
        <div class="form-group">
            <label for="title">Заголовок <span class="required">*</span></label>
            <input type="text" name="title" value="{{ $menu_group->title }}" id="title" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="name">Имя группы меню <span class="required">*</span></label>
            <input type="text" name="name" value="{{ $menu_group->name }}" id="name" class="form-control" required="">
        </div>
    </fieldset>
    
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#ajax-menu-group-form').validate();
    });
</script>