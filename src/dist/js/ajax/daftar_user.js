$(document).ready(function() {

    let Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });

    $("a#btnHapusUser").on("click", function(e) {
      e.preventDefault();

      Toast.fire({

        icon: "question",
        title: "Hapus data ini",
        showConfirmButton: true

      }).then((response) => {

        if(response.value) {

          $.ajax({
            type: "GET",
            url: $(this).attr("href"),
            success: function(data) {
              
              if(data == "sukses menghapus data") {
                Toast.fire({
                  icon: 'success',
                  title: 'Sukses! Data telah dihapus.'
                })

                loadData();
              }
              else {
                Toast.fire({
                  icon: 'error',
                  title: 'Maaf, ada kesalahan saat menghapus data.'
                })
              }
            },
            error: function(data) {
              Toast.fire({
                icon: 'error',
                title: data
              })
            }
          });

        }
        
      })
      
    });

});

// script dataTable
$(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
});