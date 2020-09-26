@if($errors->any())
    <script>
        $(document).ready(function() {
            Messenger.options = {
                extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
                theme: 'air'
            }
            @foreach($errors->all() as $error)
            Messenger().post({
                message: '{{ $error }}',
                type: 'error',
                hideAfter: 10,
                showCloseButton: true
            });
            @endforeach
        });
    </script>
@endif

