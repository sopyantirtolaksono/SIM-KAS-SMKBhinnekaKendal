$(document).ready(function() {

    let Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });

    $("form#formLogin").on("submit", function(e) {
      e.preventDefault();
      let formData = new FormData(this);

      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {

          if(data == "login sukses") {
            document.location.href = "index.php";
          }
          else if(data == "password salah") {
            Toast.fire({
              icon: "error",
              title: "Maaf, password anda salah."
            })
          }
          else if(data == "akun tidak ditemukan") {
            Toast.fire({
              icon: "error",
              title: "Maaf, akun tidak ditemukan."
            })
          }
          else {
            Toast.fire({
              icon: "error",
              title: "Maaf, ada kesalahan saat login. Silahkan coba lagi!"
            })
          }

        },
        error: function(data) {
          Toast.fire({
            icon: "error",
            title: data
          })
        }

      });
    });

});


function showHide() {
    
  let type = $("input[name=password]").attr("type");
  if(type == "password") {
    $("input[name=password]").attr("type", "text");
  }
  else {
    $("input[name=password]").attr("type", "password");
  }

}