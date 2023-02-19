$(document).ready(function() {

  //Date range picker
  $('#dateRange').daterangepicker({
    locale: {
      format: 'YYYY/MM/DD'
    }
  });

  // form laporan pendapatan
  $("form#formLapPendapatan").on("submit", function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    $.ajax({
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
        loadData("<h3 class='text-center text-secondary'>Loading...</h3>");
        loadData(data);
      },
      error: function(data) {
        console.log(data)
      }
    })
  });

  // export excel
  // $("a#btnDownloadExcel").on("click", function(e) {
  //   e.preventDefault();
  //   let href = $(this).attr("href");
  //   let valDateRange = $("input#dateRange").val();
  //   openInNewTab(href + valDateRange.replace(/\s/g, ""));
  // });

  // export print
  $("a#btnPrint").on("click", function(e) {
    e.preventDefault();
    let href = $(this).attr("href");
    let valDateRange = $("input#dateRange").val();
    openInNewTab(href + valDateRange.replace(/\s/g, ""));
  });

});

// script dataTable
// $(function () {
//     $("#example1").DataTable({
//       "responsive": true,
//       "autoWidth": false,
//     });
//     $('#example2').DataTable({
//       "paging": true,
//       "lengthChange": false,
//       "searching": false,
//       "ordering": true,
//       "info": true,
//       "autoWidth": false,
//       "responsive": true,
//     });
// });

// function load data
function loadData(data) {
    $("div#loadData").html(data);
}

// function open in new tab
function openInNewTab(url) {
  let win = window.open(url, "_blank");
  win.focus();
}