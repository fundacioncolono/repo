<script>
	$(document).ready(function () {
		swal({
			titleText: "{{ session('status')['title'] }}",
			type: "{{ session('status')['type'] }}",
			text: "{{ session('status')['msg'] }}",
			{{ session('status')['type'] === 'error' ? "showCloseButton: true, showCancelButton: true" : 'timer: 3500, showConfirmButton: false' }}
		});
	});
</script>