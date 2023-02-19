$(document).ready(function() {

    let Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });
  
    $("form#formEditAkun").on("submit", function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      
      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          
        if(data == "sukses mengedit data") {
            Toast.fire({
              icon: 'success',
              title: 'Sukses! Data telah diedit.'
            }).then(() => {
                document.location.href = "index.php?halaman=daftar_akun";
            })
            
          }
          else {
            Toast.fire({
              icon: 'error',
              title: 'Maaf, ada kesalahan saat mengedit data.'
            })
          }
  
        },
        error: function(data){
          Toast.fire({
            icon: 'error',
            title: data
          })
        }
      });
    });
  
  });

// script select2
$(function() {
  // Initialize Select2 Elements
  $('.select2').select2()

  // Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })
});