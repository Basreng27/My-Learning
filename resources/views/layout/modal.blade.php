<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">@yield('title')</h4>
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
    </button>
</div>

@yield('content')

{{-- @minify('plugin-scripts') --}}
@stack('plugin-scripts')
{{-- @endminify --}}

{{-- @minify('custom-scripts') --}}
@stack('custom-scripts')
{{-- @endminify --}}
