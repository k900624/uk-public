
<div class="col-md-3">
    <section class="block block--sidebar">

        <div class="block_body">

            <div class="list-group">
                <a href="{{ route('admin.feedback.index') }}" class="list-group-item{{ ( ! $selectStatus) ? ' active' : '' }}">Входящие</a>
                <a href="{{ route('admin.feedback.index', ['status' => 'new']) }}" class="list-group-item{{ ($selectStatus == 'new') ? ' active' : '' }}">Новые</a>
                <a href="{{ route('admin.feedback.index', ['status' => 'no_answer']) }}" class="list-group-item{{ ($selectStatus == 'no_answer') ? ' active' : '' }}">Без ответа</a>
                <a href="{{ route('admin.feedback.index', ['status' => 'answer']) }}" class="list-group-item{{ ($selectStatus == 'answer') ? ' active' : '' }}">С ответом</a>
                <a href="{{ route('admin.feedback.index', ['status' => 'spam']) }}" class="list-group-item{{ ($selectStatus == 'spam') ? ' active' : '' }}">Спам</a>
                <a href="{{ route('admin.feedback.index', ['status' => 'deleted']) }}" class="list-group-item{{ ($selectStatus == 'deleted') ? ' active' : '' }}">Удаленные</a>
            </div>
            
            <a href="javascript:;" data-remote="{{ route('admin.feedback.ajax_send_email') }}" class="js-modal btn btn-success btn-block">
                Новое сообщение <i class="fa fa-plus"></i>
            </a>

        </div>
    </section>
</div>