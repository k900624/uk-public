@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.design' => $heading,
        ]
     ])
    @endbreadcrumbs
@endsection

@section('after-scripts')
<script src="{{ url('vendor/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ url('vendor/jquery.multi-select/js/jquery.multi-select.js') }}"></script>
<script src="{{ url('vendor/jquery.nouislider/distribute/nouislider.min.js') }}"></script>
<script>
    ! function() {
        'use strict';
        $(function() {
            $('#multiselect1').multiSelect(),
                $('#optgroup').multiSelect({
                    selectableOptgroup: !0
                });
            var c = $('#public-methods').multiSelect();
            $('#select-all').click(function() {
                return c.multiSelect('select_all'),
                    !1
            }),
                $('#deselect-all').click(function() {
                    return c.multiSelect('deselect_all'),
                        !1
                });
            var elements = ['elem_0', 'elem_1', 'elem_2', 'elem_3', 'elem_4', 'elem_5', 'elem_6', 'elem_7', 'elem_8', 'elem_9'];
            $('#select-100').click(function() {
                return c.multiSelect('select', elements),
                    !1
            }),
            $('#deselect-100').click(function() {
                return c.multiSelect('deselect', elements),
                    !1
            }),
            $('#ms-custom').multiSelect({
                selectableHeader: '<div class="bg-primary text-sm py-1 px-2">Selectable items</div>',
                selectionHeader: '<div class="bg-primary text-sm py-1 px-2">Selection items</div>',
                selectableFooter: '<div class="bg-primary text-sm py-1 px-2">Selectable footer</div>',
                selectionFooter: '<div class="bg-primary text-sm py-1 px-2">Selection footer</div>'
            }),

            $('.ui-slider').each(function() {
                noUiSlider.create(this, {
                    start: $(this).data('start'),
                    connect: !0,
                    range: {
                        min: 0,
                        max: 100
                    }
                })
            }),
            $('.ui-slider-range').each(function() {
                noUiSlider.create(this, {
                    start: [25, 75],
                    range: {
                        min: 0,
                        max: 100
                    },
                    connect: !0
                })
            }),
            $('.ui-slider-values').each(function() {
                function el() {
                    var el = t.noUiSlider.get();
                    $('#ui-slider-value-lower').html(el[0]),
                        $('#ui-slider-value-upper').html(el[1])
                }
                var t = this;
                noUiSlider.create(t, {
                    start: [35, 75],
                    connect: !0,
                    step: 1,
                    behaviour: 'tap-drag',
                    range: {
                        min: 0,
                        max: 100
                    }
                }),
                    t.noUiSlider.on('slide', el),
                    el()
            }),

            $('#select2-1').select2({theme: 'bootstrap', placeholder: 'Select a state', width: '100%'}),
            $('#select2-2').select2({theme: 'bootstrap', placeholder: 'Select a state', width: '100%'}),
            $('#select2-3').select2({
                theme: 'bootstrap',
                width: '100%',
                placeholder: 'Select a state',
                allowClear: !0
            }),
            $('#select2-4').select2({
                theme: 'bootstrap',
                width: '100%',
                data: [{
                    id: 0,
                    text: 'enhancement'
                }, {
                    id: 1,
                    text: 'bug'
                }, {
                    id: 2,
                    text: 'duplicate'
                }, {
                    id: 3,
                    text: 'invalid'
                }, {
                    id: 4,
                    text: 'wontfix'
                }]
            })
        })
    }();
</script>

<script>
    (function () {

        var $button = $('<div id="source-button" class="btn btn-primary btn-xs">&lt; &gt;</div>').click(function () {
            var index = $('.bs-component').index($(this).parent());
            $.get(window.location.href, function (data) {
                var html = $(data).find('.bs-component').eq(index).html();
                html = cleanSource(html);
                $('#source-modal pre').text(html);
                $('#source-modal').modal();
            })
        });

        $('.bs-component [data-toggle="popover"]').popover();
        $('.bs-component [data-toggle="tooltip"]').tooltip();

        $('.bs-component').hover(function () {
            $(this).append($button);
            $button.show();
        }, function () {
            $button.hide();
        });

        function cleanSource(html) {
            var lines = html.split(/\n/);

            //lines.shift();
            //lines.splice(-1, 1);

            var indentSize = lines[0].length - lines[0].trim().length,
                re = new RegExp(" {" + indentSize + "}");

            lines = lines.map(function (line) {
                if (line.match(re)) {
                    line = line.substring(indentSize);
                }
                return line;
            });

            lines = lines.join("\n");

            return lines;
        }

        $('.icons-material .icon').each(function () {
            $(this).after('<br><br><code>' + $(this).attr('class').replace('icon ', '') + '</code>');
        });

        $('.js-notify-success').on('click', function(event) {
            event.preventDefault();

            notifyAdd('Hello world', 'success');
        });

        $('.js-notify-error').on('click', function(event) {
            event.preventDefault();

            notifyAdd('Hello world', 'error');
        });

        $('.js-notify-info').on('click', function(event) {
            event.preventDefault();

            notifyAdd('Hello world', 'info');
        });

    })();
</script>
@endsection

@section('after-styles')
<link href="{{ url('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ url('vendor/select2-bootstrap/dist/select2-bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ url('vendor/jquery.multi-select/css/multi-select.dist.css') }}">
<link rel="stylesheet" href="{{ url('vendor/jquery.nouislider/distribute/nouislider.min.css') }}">

<style>
    .bs-component {
        position: relative
    }

    .bs-component .modal {
        position: relative;
        top: auto;
        right: auto;
        left: auto;
        bottom: auto;
        z-index: 1;
        display: block
    }

    .bs-component .modal-dialog {
        width: 90%
    }

    .bs-component .popover {
        position: relative;
        display: inline-block;
        width: 220px;
        margin: 20px
    }

    .page-header {
        padding-bottom: 9px;
        margin: 20px 0;
        border-bottom: 1px solid #eee;
        font-size: 20px;
    }

    .text-muted {
        color: #a2a2a2!important;
    }

    #source-button {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 100;
        font-weight: bold;
        padding: 5px 10px;
    }
    .color-palette-block h4 {
        position: absolute;
        top: 100%;
        left: 20px;
        margin-top: -16px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        display: block;
        z-index: 7;
    }
    .color-palette {
        height: 35px;
        line-height: 35px;
        text-align: center;
    }
    .color-palette span {
        display: none;
        font-size: 12px;
    }
    .color-palette:hover span {
        display: block;
    }

    .fontawesome-icon-list .fa-hover a {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
        color: #222;
        line-height: 32px;
        height: 32px;
        padding-left: 10px;
    }
    .fontawesome-icon-list .fa-hover a .fa {
        width: 32px;
        font-size: 14px;
        display: inline-block;
        text-align: right;
        margin-right: 10px;
    }
    .noUi-handle {
        border-radius: 50%;
        border: 0;
        box-shadow: 0 0 0 transparent;
        background-color: #1e88e5
    }

    .noUi-horizontal .noUi-handle {
        width: 24px;
        height: 24px;
        top: -10px
    }

    .noUi-horizontal .noUi-handle:after,.noUi-horizontal .noUi-handle:before {
        display: none
    }

    .noUi-connect {
        background-color: #1e88e5
    }

    .noUi-horizontal {
        height: 4px;
        border: 0;
        background-color: rgba(160,160,160,.2);
        box-shadow: 0 0 0 #000;
    }

    .noUi-target.noUi-connect {
        background-color: #1e88e5;
        box-shadow: 0 0 0 transparent
    }

    .ui-slider-success .noUi-handle {
        background-color: #4caf50
    }

    .ui-slider-success .noUi-connect {
        background-color: #4caf50
    }

    .ui-slider-success.noUi-target.noUi-connect {
        background-color: #4caf50
    }

    .ui-slider-info .noUi-handle {
        background-color: #03a9f4
    }

    .ui-slider-info .noUi-connect {
        background-color: #03a9f4
    }

    .ui-slider-info.noUi-target.noUi-connect {
        background-color: #03a9f4
    }

    .ui-slider-warning .noUi-handle {
        background-color: #ff9800
    }

    .ui-slider-warning .noUi-connect {
        background-color: #ff9800
    }

    .ui-slider-warning.noUi-target.noUi-connect {
        background-color: #ff9800
    }

    .ui-slider-danger .noUi-handle {
        background-color: #ff5252
    }

    .ui-slider-danger .noUi-connect {
        background-color: #ff5252
    }

    .ui-slider-danger.noUi-target.noUi-connect {
        background-color: #ff5252
    }
</style>
@endsection

@section('content')
    <div class="col-md-12">
        <ul class="nav nav-pills">

            <li class="active"><a href="#tab-colors" data-toggle="tab">Цвета</a></li>
            <li><a href="#tab-buttons" data-toggle="tab">Кнопки</a></li>
            <li><a href="#tab-blocks" data-toggle="tab">Блоки</a></li>
            <li><a href="#tab-widgets" data-toggle="tab">Виджеты</a></li>
            <li><a href="#tab-forms" data-toggle="tab">Формы</a></li>
            <li><a href="#tab-typography" data-toggle="tab">Типография</a></li>
            <li><a href="#tab-elements" data-toggle="tab">Элементы</a></li>
            <li><a href="#tab-icons" data-toggle="tab">Иконки</a></li>

        </ul><br>
    </div>

    <div class="tab-content">
        <div class="tab-pane fade in active" id="tab-colors">
            @include('admin.dev.design.includes.colors')
        </div>


        <!-- Buttons
        ================================================== -->

        <div class="tab-pane fade" id="tab-buttons">
            @include('admin.dev.design.includes.buttons')
        </div>


        <!-- Widgets
        ================================================== -->

        <div class="tab-pane fade" id="tab-widgets">
            @include('admin.dev.design.includes.widgets')
        </div>


        <!-- Blocks
        ================================================== -->

        <div class="tab-pane fade" id="tab-blocks">
            @include('admin.dev.design.includes.blocks')
        </div>


        <!-- Typography
        ================================================== -->

        <div class="tab-pane fade" id="tab-typography">
            @include('admin.dev.design.includes.typography')
        </div>


        <!-- Forms
        ================================================== -->

        <div class="tab-pane fade" id="tab-forms">
            @include('admin.dev.design.includes.forms')
        </div>


        <!-- Elements
        ================================================== -->

        <div class="tab-pane fade" id="tab-elements">
            @include('admin.dev.design.includes.elements')
        </div>


        <!-- Icons
        ================================================== -->
        <div class="tab-pane fade" id="tab-icons">
            @include('admin.dev.design.includes.icons')
        </div>

    </div>

    <div id="source-modal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Source Code</h4>
                </div>
                <div class="modal-body">
                    <pre></pre>
                </div>
            </div>
        </div>
    </div>

@endsection
