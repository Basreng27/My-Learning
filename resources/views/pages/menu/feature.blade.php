   <div class="form-group row">
       <label for="name" class="col-sm-3 col-form-label">{{ __('Fitur') }} <span class="required">*</span></label>
       <div class="col-sm-9">
           @foreach ($permissions as $key => $val)
               <div class="col-md-3">
                   <input type="checkbox" class="flat" name="features[]" value="{{ $key }}">
                   {{ $val }}
               </div>
           @endforeach
       </div>
   </div>

   @push('plugin-scripts')
       {{-- <script id="feature-template" type="text/x-handlebars-template">
        <tr id="row-@{{ index }}">
            <td class="row-group">
                <select class="form-control permission" name="features[@{{ index }}][permission_id]">
                    @foreach($permissions as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </td>

            <td>
                <button type="button" class="btn btn-xs btn-outline-danger" onclick="remove_feature('@{{ index }}')"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
    </script> --}}

       {{-- <script type="text/javascript">
        var feature_sequence = 0;

        function each_features(features) {
            var i = 0;
            $.each(features, function(i, context) {
                context.its_first = i == 0 ? true : false;
                append_feature(context);
                i++;
            });
        }

        function append_feature(context) {
            context.sequence = feature_sequence;
            context.index = UUID.create().toString();

            var source = $("#feature-template").html();
            var template = Handlebars.compile(source);
            var html = template(context);

            $('#table-features tbody').append(html);
            $('.permission', $('#table-features #row-' + context.index)).val(typeof context.id != 'undefined' ? context
                .code : '').trigger('change');

            feature_sequence++;
        }

        function remove_feature(index) {
            $('#row-' + index, $('#table-features')).remove();
        }

        function set_validation_message(data) {
            $('.row-group.has-error', $('form#my-form')).removeClass('has-error');

            $.each(data.responseJSON.data, function(idx, value) {
                var key = idx.split('.');
                if (key[0] == 'features') {
                    var field = $('[name="features[' + key[1] + '][' + key[2] + ']"]');
                    field.closest('.row-group').addClass('has-error');
                    _select2 = field.closest('.row-group').find('.select2-container');
                    if (_select2.length) {
                        _select2.after('<span class="help-block error" style="height:2px !important;"> ' + value +
                            ' </span>');
                    } else {
                        field.after('<span class="help-block error" style="height:2px !important;"> ' + value +
                            ' </span>');
                    }
                }
            });
        }
    </script>

    <script type="text/javascript">
        $(function() {
            each_features({!! json_encode(isset($features) ? $features : []) !!})
        });
    </script> --}}
   @endpush
