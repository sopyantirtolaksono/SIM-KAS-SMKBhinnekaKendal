<?php

	// cek siapa yang login
	if($pecahUser["jabatan"] !== "pimpinan") {
		echo "<script>location ='index.php?halaman=dashboard';</script>";
	    exit();
	}

?>

<div id="loadData">
  
  <!-- JS -->
<script type="text/javascript">

  function loadData() {
    $.get("src/components/ajax/daftar_user.php", function(data) {
      $("#loadData").html(data);
    });
  }

  loadData();
  
</script>

</div>