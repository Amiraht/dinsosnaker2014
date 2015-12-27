<script src="../../js/jquery-1.7.2.min.js"></script>
<script src="../../js/jquery.alerts.js"></script>
<link rel="stylesheet" href="../../js/alert/jquery.alerts.css" />
<?php

	include "../mysqli_connect.php";
	
	$id = $_GET['id'];
	
	$sql = "UPDATE tbl_riwayat_pendidikan SET supervisi = 2 WHERE id_data_rp = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('i', $id);
	
	$query = $stm->execute();
	
	if($query){
		echo "
			 <script>
					jAlert('Data telah di proses ke BKD', 'PESAN SUKSES');
					document.location.href = '../../?mod=riwayat_pendidikan_pegawai';
			 </script>	
		";
	}else{
		echo "
			 <script>
					jAlert('Error Query, proses data ke BKD gagal !!', 'ERROR');
					document.location.href = '../../?mod=riwayat_pendidikan_pegawai';
			 </script>	
		";
	}