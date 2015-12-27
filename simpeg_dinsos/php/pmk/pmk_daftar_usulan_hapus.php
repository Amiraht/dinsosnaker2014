<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	$id_usul  = mysql_real_escape_string($_GET['id_usul']);
	$no_usulan = get_no_usulan_pmk($id_usul);
	$sql = "";
	
	$sql .= "DELETE FROM tbl_usulan_pmk WHERE id_usulan = '". $id_usul ."';";
	$sql .= "DELETE FROM tbl_detail_usul_pmk WHERE no_usulan = '".$no_usulan."';";
	
	$hapus = $con->multi_query($sql);
	
	if($hapus){
		$code = 1;
		header("Location:../../?mod=pmk_daftar_usulan&code=".$code."&act=del");
	}else{
		$code = 2;
		header("Location:../../?mod=pmk_daftar_usulan&code=".$code."&act=del");
	}
	