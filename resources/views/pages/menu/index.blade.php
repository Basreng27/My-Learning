@extends('layout.app')

@section('title', 'Menu')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.css">

    <style type="text/css">
        .nestable-lists {
            display: block;
            clear: both;
            padding: 30px 0;
            width: 100%;
            border: 0;
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
        }

        #nestable-menu {
            padding: 0;
            margin: 20px 0;
        }

        #nestable-output,
        #nestable2-output {
            width: 100%;
            height: 7em;
            font-size: 0.75em;
            line-height: 1.333333em;
            font-family: Consolas, monospace;
            padding: 5px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        #nestable2 .dd-handle {
            color: #fff;
            border: 1px solid #999;
            background: #bbb;
            background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
            background: -moz-linear-gradient(top, #bbb 0%, #999 100%);
            background: linear-gradient(top, #bbb 0%, #999 100%);
        }

        #nestable2 .dd-handle:hover {
            background: #bbb;
        }

        #nestable2 .dd-item>button:before {
            color: #fff;
        }

        @media only screen and (min-width: 700px) {

            .dd {
                float: left;
                width: 100%;
            }

            .dd+.dd {
                margin-left: 2%;
            }

        }

        .dd {
            max-width: 100% !important;
        }

        .dd-hover>.dd-handle {
            background: #2ea8e5 !important;
        }

        .dd3-content {
            display: block;
            height: 41.5px;
            margin: 5px 0;
            padding: 5px 10px 5px 40px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd3-content:hover {
            color: #2ea8e5;
            background: #fff;
        }

        .dd-dragel>.dd3-item>.dd3-content {
            margin: 0;
        }

        .dd3-item>button {
            margin-left: 30px;
        }

        .dd3-handle {
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: pointer;
            width: 30px;
            height: 41.5px;
            text-indent: 30px;
            white-space: nowrap;
            overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .dd3-handle:before {
            content: '≡';
            display: block;
            position: absolute;
            left: 0;
            top: 3px;
            width: 100%;
            text-align: center;
            vertical-align: : middle;
            text-indent: 0;
            color: #fff;
            font-size: 20px;
            font-weight: normal;
        }

        .dd3-handle:hover {
            background: #ddd;
        }

        .input-otority table tbody tr td {
            padding: 0px;
        }

        .input-otority .checkbox-otority {
            display: inline-block;
            width: 100%;
            height: 100%;
            padding: 15px 30px;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="dashboard_graph">
                    <div class="row x_title">
                        <div class="col-md-6">
                            <a href="{{ route('create-' . $module) }}" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-lg"><i class="fa fa-plus"></i> {{ __('Tambah') }}</a>
                        </div>

                        <div class="col-md-6">
                            <div class="btn-group btn-group-sm float-right" role="Table row actions">
                                <div class="btn-group" data-toggle="buttons">
                                    <button class="btn btn-secondary" data-toggle-class="btn-primary"
                                        data-toggle-passive-class="btn-default">
                                        {{ __('Tutup Semua') }}
                                    </button>
                                    <button class="btn btn-primary" data-toggle-class="btn-primary"
                                        data-toggle-passive-class="btn-default">
                                        {{ __('Melebarkan Semua') }}
                                    </button>
                                </div>
                                {{-- <button type="button" class="btn btn-danger btn-sm"
                                    data-action="collapse-all">{{ __('Tutup Semua') }}</button>
                                <button type="button" class="btn btn-success btn-sm"
                                    data-action="expand-all">{{ __('Melebarkan semua') }}</button> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 ">
                        <div class="row">
                            <div class="col">
                                <div id="nestable-empty" class="alert alert-warning alert-dismissible fade" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Oops!</strong> {{ __('Tidak ada menu yang tersedia') }}.
                                </div>

                                <div id="nestable-change-order" class="alert alert-info alert-dismissible fade show pr-3"
                                    role="alert" style="display:none;">
                                    <div class="row">
                                        <div class="col-10 align-self-center">
                                            <i class="fa fa-exclamation-triangle"></i>
                                            {{ __('Urutan menu telah diubah, klik tombol dibawah untuk meperbaharui urutan') }}.
                                        </div>

                                        <div class="col-2 text-right">
                                            {{ Form::open(['id' => 'form-order-menus', 'route' => [$module . '-saveOrder'], 'method' => 'put', 'autocomplete' => 'off']) }}
                                            <textarea style="display:none;" id="nestable-menu-output-ori"></textarea>
                                            <textarea name="sequence" style="display:none;" id="nestable-menu-output"></textarea>
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                data-action="save-order"><i class="mdi mdi-content-save"></i>
                                                Simpan Urutan</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                                <div id="nestable-menu" class="dd"></div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ template_custom() }}/handlebars/handlebars.min.js"></script>
    {{-- <script src="{{ template_custom() }}/uuid-js/uuid.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js"></script>
@endpush

@push('custom-scripts')
    <script id="nestable-template" type="text/x-handlebars-template">
        <div class="dd-handle dd3-handle">Drag</div>
        <div class="dd3-content align-middle">
            <label>@{{#if icon }} <i class="@{{ icon }} mr-1" ></i> @{{/if }} @{{ label }} <small class="ml-1">@{{ url }}</small></label>

            <div role="group" class="btn-group btn-group-sm float-right" role="Table row actions">
                <a rel="tooltip" href="{{ route($module . '.create') }}?parent_id=__grid_doc__" title="{{ __('Tambah Turunan') }}" class="btn btn-outline-success" data-toggle="modal-edit" data-target="#modal-lg">
                    <i class="fa fa-plus"></i>
                </a>
                <a rel="tooltip" href="{{ route('edit-' . $module, ['menu' => '__grid_doc__']) }}" title="{{ __('Edit') }}" class="btn btn-outline-secondary" data-toggle="modal-edit" data-target="#modal-lg">
                    <i class="fa fa-edit"></i>
                </a>
                <a rel="tooltip" href="{{ route('destroy-' . $module, ['id' => '__grid_doc__']) }}" title="{{ __('Hapus') }}" class="btn btn-outline-danger btn-delete">
                    <i class="fa fa-trash"></i>
                </a>
            </div>
        </div>
    </script>

    <script type="text/javascript">
        function initModalAjax(selector) {
            var selector_triger = typeof selector !== 'undefined' ? selector : '[data-toggle="modal"]';
            $(selector_triger).on('click', function(e) {
                /* Parameters */
                var url = $(this).attr('href');
                let containerTarget = $(this).attr('data-target');
                let form = $(this).attr('data-form');
                let data = $(form).serialize();

                if (url.indexOf('#') == 0) {
                    $(containerTarget).modal();
                } else {
                    /* XHR */
                    var loading =
                        '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';

                    $(containerTarget).modal();
                    $('.modal-content', $(containerTarget)).html(loading).load(url, data, function() {});

                }
                return false;
            });
        }

        function updateOutput(id) {
            $(id).val(window.JSON.stringify($('#nestable-menu').nestable('serialize')));
        }

        function dd_tree(list) {
            var ol = $('<ol \>');
            ol.addClass('dd-list');

            $.each(list, function(idx, val) {
                var li = $('<li \>');
                li.addClass('dd-item dd3-item');
                li.attr('data-id', val.id);

                var source = document.getElementById("nestable-template").innerHTML;
                var template = Handlebars.compile(source);
                var html = template(val);

                li.append(html.replace(/__grid_doc__/g, val.id));
                if (typeof val.children != 'undefined') {
                    li.append(dd_tree(val.children));
                }

                ol.append(li);
            });

            return ol;
        }

        function dd_msg(s) {
            if (s) {
                $('#nestable-empty').hide();
            } else {
                $('#nestable-empty').show();
            }
        }

        function dd_load() {
            $('#nestable-menu').html('loading...');
            $.get('{{ route('data-' . $module) }}', function(out) {

                $('#nestable-menu').html(dd_tree(out.data));
                initModalAjax('[data-toggle="modal-edit"]');
                $('[rel="tooltip"]').tooltip();

                $('#nestable-menu').nestable({
                    callback: function(l, e) {
                        updateOutput('#nestable-menu-output');

                        var x = $('#nestable-menu-output-ori').val();
                        var y = $('#nestable-menu-output').val();

                        if (x != y) {
                            $('#nestable-change-order').show();
                        } else {
                            $('#nestable-change-order').hide();
                        }
                    }
                });

                updateOutput('#nestable-menu-output-ori');
                updateOutput('#nestable-menu-output');

                $('.btn-delete', $('#nestable-menu')).click(function() {
                    $(this).myAjax({
                        success: function(data) {
                            $('#nestable-menu').nestable('destroy');
                            dd_load();
                        }
                    }).delete();

                    return false;
                });

                dd_msg(out.data.length ? true : false);
            });
        }

        $(function() {
            initModalAjax('[data-toggle="modal"]');
            dd_load();

            $('[data-action=collapse-all]').click(function() {
                $('#nestable-menu').nestable('collapseAll');
            });

            $('[data-action=expand-all]').click(function() {
                $('#nestable-menu').nestable('expandAll');
            });

            $('form#form-order-menus').submit(function(e) {
                e.preventDefault();
                $(this).myAjax({
                    waitMe: '.card-body',
                    success: function(data) {
                        $('#nestable-change-order').hide();
                    }
                }).submit();
            });
        });
    </script>
@endpush
