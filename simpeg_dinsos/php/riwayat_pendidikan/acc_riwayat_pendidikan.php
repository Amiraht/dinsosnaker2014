<script src="../../js/jquery-1.7.2.min.js"></script>
<script src="../../js/jquery.alerts.js"></script>
<link rel="stylesheet" href="../../js/alert/jquery.alerts.css" />
<?php

	include "../mysqli_connect.php";
	
	$id = $_GET['id'];
	
	$sql = "UPDATE tbl_riwayat_pendidikan SET supervisi = 3 WHERE id_data_rp = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('i', $id);
	
	$query = $stm->execute();
	
	if($query){
		echo "
			 <script>
					jAlert('ACC Supervisi Data Riwayat Pendidikan Pegawai sukses', 'PESAN SUKSES');
					document.location.href = '../../?mod=supervisi_riwayat_pendidikan';
			 </script>	
		";
	}else{
		echo "
			 <script>
					jAlert('Error Query, proses ACC gagal !!', 'ERROR');
					document.location.href = '../../?mod=supervisi_riwayat_pendidikan';
			 </script>	
		";
	}