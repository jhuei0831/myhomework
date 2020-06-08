<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@if ($message = Session::get('success'))
<script>
	Swal.fire({
		// position: 'center',
		icon: 'success',
		title: '{{ trans($message) }}',
		showConfirmButton: false,
		showCloseButton: true,
		// timer: 1500
	})
</script>
@endif


@if ($message = Session::get('error'))
<script>
	Swal.fire({
		// position: 'center',
		icon: 'error',
		title: '{{ trans($message) }}',
		showConfirmButton: false,
		showCloseButton: true,
		// timer: 1500
	})
</script>
@endif


@if ($message = Session::get('warning'))
<script>
	Swal.fire({
		// position: 'center',
		icon: 'warning',
		title: '{{ trans($message) }}',
		showConfirmButton: false,
		showCloseButton: true,
		// timer: 1500
	})
</script>
@endif


@if ($message = Session::get('info'))
<script>
	Swal.fire({
		// position: 'center',
		icon: 'info',
		title: '{{ trans($message) }}',
		showConfirmButton: false,
		showCloseButton: true,
		// timer: 1500
	})
</script>
@endif

@if ($message = Session::get('nodata'))
<script>
	Swal.fire({
		// position: 'center',
		icon: 'question',
		title: '{{ trans($message) }}',
		showConfirmButton: false,
		showCloseButton: true,
		// timer: 1500
	})
</script>
@endif

@if ($errors->any())
<script>
	Swal.fire({
		// position: 'center',
		icon: 'error',
		title: '{{ trans("action.check") }}',
		showConfirmButton: false,
		showCloseButton: true,
		// timer: 1500
	})
</script>
@endif
