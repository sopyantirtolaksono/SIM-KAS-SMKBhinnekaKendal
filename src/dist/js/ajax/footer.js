$(document).ready(function() {

	// script sweet alert
	let Toast = Swal.mixin({
      	toast: true,
      	position: 'top-center',
      	showConfirmButton: true,
      	timer: 3000
    });

	// script login
	$("a#btnLogoutSidebar,a#btnLogoutNavbar").on("click", function(e) {
		e.preventDefault();
		let href = $(this).attr("href");

		Toast.fire({
          	icon: 'question',
          	title: 'Yakin ingin keluar.'
        }).then((response) => {
        	if(response.value) {
        		document.location.href = href;
        	}
        })
	});

});