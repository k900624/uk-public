<script>
    tinymce.init({
        selector: 'textarea.wysiwyg',

        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor moxiemanager'
        ],
        menubar: false,
        language: 'ru',
        toolbar1: 'undo redo | styleselect fontsizeselect | bold italic | hr | table | alignleft aligncenter alignright alignjustify | link unlink image | forecolor backcolor charmap | bullist numlist | visualblocks code | preview | fullscreen',
        fontsize_formats: '12px 14px 15px 17px 18px 20px 24px 36px',
        style_formats: [
            {title:'Headings',items:[
                    {title:'Heading 2',format:'h2'},
                    {title:'Heading 3',format:'h3'},
                    {title:'Heading 4',format:'h4'},
                    {title:'Heading 5',format:'h5'},
                    {title:'Heading 6',format:'h6'}
                ]},
            {title:'Inline',items:[
                    {title:'Bold',icon:'bold',format:'bold'},
                    {title:'Italic',icon:'italic',format:'italic'},
                    {title:'Underline',icon:'underline',format:'underline'},
                    {title:'Strikethrough',icon:'strikethrough',format:'strikethrough'},
                    {title:'Superscript',icon:'superscript',format:'superscript'},
                    {title:'Subscript',icon:'subscript',format:'subscript'},
                    {title:'Code',icon:'code',format:'code'}
                ]},
            {title:'Blocks',items:[
                    {title:'Paragraph',format:'p'},
                    {title:'Blockquote',format:'blockquote'},
                    // {title:'Div',format:'div'},
                    {title:'Pre',format:'pre'}
                ]},
            {title:'Alignment',items:[
                    {title:'Left',icon:'alignleft',format:'alignleft'},
                    {title:'Center',icon:'aligncenter',format:'aligncenter'},
                    {title:'Right',icon:'alignright',format:'alignright'},
                    {title:'Justify',icon:'alignjustify',format:'alignjustify'}
                ]}
        ],
        image_advtab: true,
        relative_urls : false,
        remove_script_host : false,
        document_base_url : '{{ url('/') }}',
        content_css : '{{ url('/css/admin/tinymce.min.css') }}'
    });
</script>