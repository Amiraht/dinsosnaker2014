<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	$id_surat = mysql_real_escape_string($_GET['id_sk']);
	
	$status = 2;
	
	$sql = "UPDATE tbl_sk_pmk SET status = ? WHERE id_surat = ?";
	
	$stm = $con->prepare($sql);
	
	// bind param
	$stm->bind_param('ii', $status, $id_surat);
	
	$query = $stm->execute();
	
	if($query){
		header("Location:../../?mod=pmk_daftar_sk");
	}else{
		header("Location:../../?mod=pmk_daftar_sk");
	}
	
	$stm->close();