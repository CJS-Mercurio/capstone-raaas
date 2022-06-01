function alert_error(message){
	Swal.fire({
		 icon: 'error',
		 title: 'Oops...',
		 text: message,
		 footer: '<a href>Why do I have this issue?</a>'
	   });
}

function alert_success(message){
	Swal.fire(
	 'Good job!',
	 message,
	 'success'
   );
}

function alert_login_success(message){
	Swal.fire(
	 'Login Success!',
	 message,
	 'success'
   );
}
function confirmDelete(route) {
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!',
		closeOnConfirm: true,
		closeOnCancel: true
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: route,
				success: function (response) {
					Swal.fire({
						title: response.status,
						text: response.status_text,
						icon: response.status_icon,
						button: 'OK',
					}).then((confirm) => {
						window.location.reload();
					});
				}
			});
		}
	});
}
