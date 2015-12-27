<?php

	include "php/mysqli_connect.php";
	if(isset($_GET['id_sk']) && isset($_GET['act'])){
		$id_sk = $_GET['id_sk'];
	
		$sql = "UPDATE tbl_sk_kenpang SET status_supervisi = 1 WHERE id_data = ?";
	
		$stm = $con->prepare($sql);
	
		$stm->bind_param('i', $id_sk);
	
		$query = $stm->execute();
	
		if($query){
			echo "
				<script type='text/javascript'>
					jAlert('Tolak Data SK Kepangkatan Sukses!!', 'INFO', function(r){
						 document.location.href='?mod=kenpang_daftar_sk_diusulkan';	
					});
				</script>	
			";
		}else{
			echo "
				<script type='text/javascript'>
					jAlert('Maaf, terjadi kesalahan proses penolakan!!', 'INFO', function(r){
						 document.location.href='?mod=kenpang_daftar_sk_diusulkan';	
					});
				</script>	
			";
		}
	}	