<?php

	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	$id_usul  = mysql_real_escape_string($_GET['id_usul']);
	$no_usul = get_no_usulan_pmk($id_usul);
	
	$sql = "DELETE FROM tbl_usulan_pmk WHERE no_usulan = '". $no_usul ."'";
	
	$hapus = mysql_query($sql);
	
	if($hapus){
		$code = 1;
		header("Location:../../?mod=pmk_daftar_usulan_diusulkan&code=".$code."&act=del");
	}else{
		$code = 2;
		header("Location:../../?mod=pmk_daftar_usulan_diusulkan&code=".$code."&act=del");
	}