@if ($message = Session::get('success'))
<div class="alert alert-success text-center">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ trans($message) }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger text-center">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ trans($message) }}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning text-center">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ trans($message) }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info text-center">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ trans($message) }}</strong>
</div>
@endif

@if ($message = Session::get('nodata'))
<div class="alert alert-info text-center">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ trans($message) }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger text-center">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ trans('action.check') }}
</div>
@endif
