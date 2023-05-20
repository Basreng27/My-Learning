@extends('layout.app')

@section('title', 'Menu')

@push('style')
    <style>
        #drag-drop-list {
            list-style-type: none;
            padding: 0;
        }

        #drag-drop-list li {
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            margin-bottom: 5px;
            cursor: move;
        }
    </style>
@endpush

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="dashboard_graph">
                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>Network Activities <small>Graph title sub-title</small></h3>
                        </div>

                        <div class="col-md-6">
                            <div id="reportrange" class="pull-right"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 ">
                        <div class="row">
                            <div class="col">
                                {{-- <div id="nestable-empty" class="alert alert-warning alert-dismissible fade" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Oops!</strong> {{ __('Tidak ada menu yang tersedia') }}.
                                </div> --}}

                                <div id="nestable-change-order" class="alert alert-info alert-dismissible fade show pr-3"
                                    role="alert" style="display:none;">
                                    <div class="row">
                                        <div class="col-10 align-self-center">
                                            <i class="fas fa-exclamation-triangle"></i>
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
                        {{-- <ul id="drag-drop-list">
                            <li draggable="true">Item 1</li>
                            <li draggable="true">Item 2</li>
                            <li draggable="true">Item 3</li>
                            <li draggable="true">Item 4</li>
                        </ul> --}}
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            function dd_load() {
                console.log(321)
                $('#nestable-menu').html(loading);
                $.get('{{ route($module . '-data') }}', function(out) {
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
        </script>
        {{-- <script id="nestable-template" type="text/x-handlebars-template">
            <div class="dd-handle dd3-handle">Drag</div>
            <div class="dd3-content align-middle">
                <label>@{{#if icon }} <i class="@{{ icon }} mr-1" ></i> @{{/if }} @{{ label }} <small class="ml-1">@{{ url }}</small></label>

                <div role="group" class="btn-group btn-group-sm float-right" role="Table row actions">
                    <a rel="tooltip" href="{{ route($module . '-create') }}?parent_id=__grid_doc__" title="{{ __('Tambah Turunan') }}" class="btn btn-outline-success" data-toggle="modal-edit" data-target="#modal-lg">
                        <i class="fas fa-plus"></i>
                    </a>

                    <a rel="tooltip" href="{{ route($module . '-edit', ['menu' => '__grid_doc__']) }}" title="{{ __('Edit') }}" class="btn btn-outline-secondary" data-toggle="modal-edit" data-target="#modal-lg">
                        <i class="fas fa-edit"></i>
                    </a>

                    <a rel="tooltip" href="{{ route($module . '-destroy', ['id' => '__grid_doc__']) }}" title="{{ __('Hapus') }}" class="btn btn-outline-danger btn-delete">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            </div>
        </script> --}}

        {{-- <script>
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
        </script> --}}

        {{-- <script>
            // Ambil referensi ke elemen daftar
            var list = document.getElementById('drag-drop-list');

            // Fungsi untuk menangani peristiwa drag start
            function handleDragStart(event) {
                event.dataTransfer.setData('text/plain', event.target.id);
                event.currentTarget.style.opacity = '0.4';
            }

            // Fungsi untuk menangani peristiwa drag end
            function handleDragEnd(event) {
                event.currentTarget.style.opacity = '1';
            }

            // Fungsi untuk menangani peristiwa drop
            function handleDrop(event) {
                event.preventDefault();
                var data = event.dataTransfer.getData('text/plain');
                var draggableElement = document.getElementById(data);
                var dropzone = event.target;

                // Pindahkan elemen yang di-drop ke posisi yang benar
                if (draggableElement && dropzone && dropzone.parentNode) {
                    var nextElement = dropzone.nextElementSibling;
                    if (nextElement) {
                        dropzone.parentNode.insertBefore(draggableElement, nextElement);
                    } else {
                        dropzone.parentNode.appendChild(draggableElement);
                    }
                }
            }

            // Fungsi untuk menangani peristiwa drag over
            function handleDragOver(event) {
                event.preventDefault();
            }

            // Tambahkan event listener ke setiap elemen yang dapat di-drag
            var draggableItems = list.querySelectorAll('li');
            draggableItems.forEach(function(item) {
                item.addEventListener('dragstart', handleDragStart);
                item.addEventListener('dragend', handleDragEnd);
            });

            // Tambahkan event listener ke elemen daftar untuk menangani peristiwa drop
            list.addEventListener('dragover', handleDragOver);
            list.addEventListener('drop', handleDrop);
        </script> --}}
    @endpush

    <!-- /page content -->
    {{-- <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom py-3">
                    <a href="{{ route($module . '.create') }}" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#modal-lg"><i class="mdi mdi-plus"></i> {{ __('Tambah') }}</a>

                    <div class="btn-group btn-group-sm float-right" role="Table row actions">
                        <button type="button" class="btn btn-danger btn-sm"
                            data-action="collapse-all">{{ __('Tutup Semua') }}</button>

                        <button type="button" class="btn btn-success btn-sm"
                            data-action="expand-all">{{ __('Melebarkan semua') }}</button>
                    </div>
                </div>

                <div class="card-body">
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
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ __('Urutan menu telah diubah, klik tombol dibawah untuk meperbaharui urutan') }}.
                                    </div>

                                    <div class="col-2 text-right">
                                        {{ Form::open(['id' => 'form-order-menus', 'route' => [$module . '-saveOrder'], 'method' => 'put', 'autocomplete' => 'off']) }}
                                        <textarea style="display:none;" id="nestable-menu-output-ori"></textarea>
                                        <textarea name="sequence" style="display:none;" id="nestable-menu-output"></textarea>
                                        <button type="submit" class="btn btn-primary btn-sm" data-action="save-order"><i
                                                class="mdi mdi-content-save"></i>
                                            Simpan Urutan</button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <div id="nestable-menu" class="dd"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
{{--
@push('plugin-scripts')
    <script src="{{ template_gentelellaMaster() }}/build/js/handlebars/handlebars.min.js"></script>
    <script src="{{ template_gentelellaMaster() }}/build/js/nestable2/jquery.nestable.min.js"></script>
@endpush

@push('custom-scripts')
    <script id="nestable-template" type="text/x-handlebars-template">
        <div class="dd-handle dd3-handle">Drag</div>
        <div class="dd3-content align-middle">
            <label>@{{#if icon }} <i class="@{{ icon }} mr-1" ></i> @{{/if }} @{{ label }} <small class="ml-1">@{{ url }}</small></label>

            <div role="group" class="btn-group btn-group-sm float-right" role="Table row actions">
                <a rel="tooltip" href="{{ route($module . '-create') }}?parent_id=__grid_doc__" title="{{ __('Tambah Turunan') }}" class="btn btn-outline-success" data-toggle="modal-edit" data-target="#modal-lg">
                    <i class="fas fa-plus"></i>
                </a>

                <a rel="tooltip" href="{{ route($module . '-edit', ['menu' => '__grid_doc__']) }}" title="{{ __('Edit') }}" class="btn btn-outline-secondary" data-toggle="modal-edit" data-target="#modal-lg">
                    <i class="fas fa-edit"></i>
                </a>

                <a rel="tooltip" href="{{ route($module . '-destroy', ['id' => '__grid_doc__']) }}" title="{{ __('Hapus') }}" class="btn btn-outline-danger btn-delete">
                    <i class="fas fa-trash-alt"></i>
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
            $('#nestable-menu').html(loading);
            $.get('{{ route($module . '-data') }}', function(out) {
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
@endpush --}}
