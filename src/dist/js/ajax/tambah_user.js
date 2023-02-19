$(document).ready(function() {

    let Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });

    $("form#formTambahUser").on("submit", function(e) {
      e.preventDefault();
      let formData = new FormData(this);

      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {

          if(data == "karakter pertama harus @") {
            Toast.fire({
                icon: 'error',
                title: 'Username harus memiliki karakter @ diawal.'
            })
          }
          else if(data == "username sudah ada") {
            Toast.fire({
                icon: 'error',
                title: 'Username sudah ada.'
            })
          }
          else if(data == "minimal harus 8 karakter") {
            Toast.fire({
              icon: "error",
              title: "Password anda harus memiliki minimal 8 karakter."
            })
          }
          else if(data == "registrasi berhasil") {
            Toast.fire({
              icon: "success",
              title: "Registrasi berhasil."
            })

            resetForm();
          }
          else {
            Toast.fire({
              icon: "error",
              title: "Registrasi gagal. Silahkan coba lagi!"
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

// script select2
$(function() {
  // Initialize Select2 Elements
  $('.select2').select2()

  // Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })
});

function resetForm() {
    $("input.form-control").val("");
    $("select.form-control").val("");
}

function showHide() {
    let type = $("input#password,input#konfirmasiPassword").attr("type");
    if(type == "password") {
      $("input#password,input#konfirmasiPassword").attr("type", "text");
    }
    else {
      $("input#password,input#konfirmasiPassword").attr("type", "password");
    }
}

function confirmPassword() {
  let password    = $("input#password").val();
  let konfirmPass = $("input#konfirmasiPassword").val();

  if(konfirmPass !== password) {
    $("input#konfirmasiPassword").addClass("is-invalid");
    $("button[name=btn_simpan]").attr("disabled", "");
  }
  else {
    $("input#konfirmasiPassword").removeClass("is-invalid");
    $("button[name=btn_simpan]").removeAttr("disabled", "");
    confirmPassword2();
  }
}

function confirmPassword2() {
  $("input#password").on("keyup", function() {
    let password2    = $(this).val();
    let konfirmPass2 = $("input#konfirmasiPassword").val();

    if(password2 !== konfirmPass2) {
      $("input#konfirmasiPassword").addClass("is-invalid");
      $("button[name=btn_simpan]").attr("disabled", "");
    }
    else {
      $("input#konfirmasiPassword").removeClass("is-invalid");
      $("button[name=btn_simpan]").removeAttr("disabled", "");
    }
  });
}