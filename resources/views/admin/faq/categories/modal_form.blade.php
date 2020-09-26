<form action="{{ $action }}" id="ajax-faq-category-form" class="validate" method="post" accept-charset="utf-8">
    @if($category->id)
        {{ method_field('PATCH')}}
    @endif
    {{ csrf_field() }}

    <fieldset>
        <div class="form-group">
            <label for="title">Название категории <span class="required">*</span></label>
            <input type="text" name="title" value="{{ old('title', $category->title) }}" id="title" class="form-control" required="">
        </div>
    </fieldset>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
    </div>
    
</form>
    
<script>
    $(document).ready(function() {
        $('#ajax-faq-category-form').validate();
    });
</script>
