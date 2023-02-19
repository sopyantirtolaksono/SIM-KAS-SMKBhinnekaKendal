$(document).ready(function() {

    //Date range picker
    $('#tanggal').datetimepicker({
        format: 'YYYY/MM/DD',
        timePicker: false
    });

    let Toast = Swal.mixin({
      	toast: true,
      	position: 'top-center',
      	showConfirmButton: false,
      	timer: 3000
    });

    $("form#formTambahPengeluaran").on("submit", function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            
            if(data == "sukses menambah data baru") {
                Toast.fire({
                icon: 'success',
                title: 'Sukses! Data baru telah ditambahkan.'
                })
                resetForm();
                moveBtnCancelToFinish();
            }
            else {
                Toast.fire({
                icon: 'error',
                title: 'Maaf, ada kesalahan saat menambahkan data baru.'
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

function resetForm() {
    $("input#debet").val("");
    $("input#kredit").val("");
    $("textarea#keterangan").val("");
    $("select[name=nama_akun]").focus();
}

function moveBtnCancelToFinish() {
    $("a#btnBatalDanSelesai").text("Selesai");
}