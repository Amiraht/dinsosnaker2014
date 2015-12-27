<?php

	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	$id_usulan = $_GET['id_usulan'];
	$nomor = getNoUsul("tbl_usulan_pg", $id_usulan);
	$sql = "UPDATE tbl_usulan_pg SET status = 1 WHERE id_usulan = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('i', $id_usulan);
	
	$query = $stm->execute();
	
	if($query){
		header('Location:../../?mod=pg_daftar_usulan_proses&code=2&nomor='.$nomor);
	}