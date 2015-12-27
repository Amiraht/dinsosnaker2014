<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	$mode = $_GET['mode'];
	$id_usulan = $_GET['id_usulan'];
	
	if($mode == 2){
		$catatan = $_GET['catatan'];
		$status = 1;
		$sql = "UPDATE tbl_usulan_gaji_berkala SET catatan = ? , status = ? WHERE id_usulan = ?";
		
		$stm = $con->prepare($sql);
		
		$stm->bind_param('sis', $catatan, $status, $id_usulan);
		
		$query = $stm->execute();
		
		if($query){
			header("Location:../../?mod=proses_usulan_gb&code=1&id_usulan=".$id_usulan);
		}
		
		$stm->close();
		
	}else{
		$status = 3;
		$sql = "UPDATE tbl_usulan_gaji_berkala SET status = ? WHERE id_usulan = ?";
		
		$stm = $con->prepare($sql);
		
		$stm->bind_param('is', $status, $id_usulan);
		
		$query = $stm->execute();
		if($query){
			header("Location:../../?mod=proses_usulan_gb&code=2&id_usulan=".$id_usulan);
		}
		
		$stm->close();
	}