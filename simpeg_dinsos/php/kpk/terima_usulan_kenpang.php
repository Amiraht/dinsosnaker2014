<?php

	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	$id_usulan = $_GET['id_usulan'];
	$nomor = getNoUsul("tbl_usulan_pangkat", $id_usulan);
	$sql = "UPDATE tbl_usulan_pangkat SET status_proses = 3 WHERE id_usulan = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('i', $id_usulan);
	
	$query = $stm->execute();
	
	if($query){
		header('Location:../../?mod=daftar_usulan_kpk_sedang_diproses&code=1&nomor='.$nomor);
	}