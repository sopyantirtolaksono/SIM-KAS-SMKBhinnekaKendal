<?php

	// cek siapa yang login
	if($pecahUser["jabatan"] !== "bendahara") {
		echo "<script>location ='index.php?halaman=dashboard';</script>";
	    exit();
	}

?>

<div id="loadData">
  
<!-- JS -->
<script type="text/javascript">

    function loadData() {
        $.get("src/components/ajax/pengeluaran.php", function(data) {
        $("#loadData").html(data);
        });
    }

    loadData();
  
</script>

</div>