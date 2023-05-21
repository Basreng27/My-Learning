@extends('layout.modal')

@section('title', __('Form Tambah'))

@section('content')
    {{ Form::open(['id' => 'my-form', 'route' => $module . '.store', 'method' => 'post', 'autocomplete' => 'off']) }}
    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
    <div class="modal-body pb-2">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">{{ __('Label') }} <span
                            class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="code" class="col-sm-3 col-form-label">{{ __('Code') }} <span
                            class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="code" id="code" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="icon" class="col-sm-3 col-form-label">{{ __('Icon') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="icon" id="icon">
                    </div>
                </div>

                <div class="form-group row box-routes">
                    <label for="route" class="col-sm-3 col-form-label">{{ __('Route') }} <span
                            class="required">*</span></label>
                    <div class="col-sm-9">
                        <select class="select2_single form-control" name="route" tabindex="-1">
                            @foreach ($routes as $route)
                                <option value="{{ $route }}">{{ $route }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        @include('pages.' . $module . '.feature', ['permissions' => $permissions])
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
    </div>
    {!! Form::close() !!}
@endsection

@push('custom-scripts')
    {{-- <script type="text/javascript">
        function box(s) {
            if (s) {
                $('.box-routes').hide();
                $('.box-custom').show();
            } else {
                $('.box-routes').show();
                $('.box-custom').hide();
            }
        }

        $(function() {
            initPage();
            $('.select2').select2({
                theme: 'bootstrap4'
            })

            $('form#my-form').submit(function(e) {
                e.preventDefault();
                $(this).myAjax({
                    waitMe: 'body',
                    success: function(data) {
                        $('.modal').modal('hide');
                        $('#nestable-menu').nestable('destroy');
                        dd_load();
                    },
                    error: function(data) {
                        set_validation_message(data);
                    }
                }).submit();
            });

            box($('#custom_url').is(':checked'));

            $('#custom_url').change(function() {
                $('[name=route]').val('');
                $('[name=url]').val('');

                box($(this).is(':checked'));
            });
        });
    </script> --}}
@endpush
