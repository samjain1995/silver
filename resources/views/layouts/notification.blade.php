<script src="{{ asset('admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@if (session('success'))
<script>
	Swal.fire({
		icon: 'success',
		title: '{{session('success')}}',
	});
</script>
@endif
@if (session('error'))
<script>
	Swal.fire({
		icon: 'error',
		title: '{{session('error')}}',
	});
</script>
@endif
@if (session('success_register'))
<script>
	Swal.fire({
		title: "{{ session('success_register') }}",
		showCancelButton: true,
		confirmButtonText: `Ckick Here`,
	}).then((result) => {
		if (result.isConfirmed) {
			var url = '{{route('checkout')}}';
			window.location.href = url;
		}
	});
</script>
@endif


