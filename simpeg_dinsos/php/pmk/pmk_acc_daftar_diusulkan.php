<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	$mod = $_GET['mode'];
	$id_usulan = mysql_real_escape_string($_GET['id_usul']);
	$no_usulan = get_no_usulan_pmk($id_usulan);
	
	if($mod == 2){
		// status penolakan
		$catatan = $_GET['catatan'];
		$sql = "UPDATE tbl_usulan_pmk SET catatan = '$catatan' ,status_supervisi = '1' WHERE no_usulan = '$no_usulan'";
		$query = mysql_query($sql);
	
			if($query){
				header("Location:../../?mod=pmk_diusulkan_proses&code=1&id_usul=".$id_usulan);
			}
	}else{
		$sql = "UPDATE tbl_usulan_pmk SET status_supervisi = '3' WHERE no_usulan = '$no_usulan'";
		$query = mysql_query($sql);
	
			if($query){
				header("Location:../../?mod=pmk_diusulkan_proses&code=2&id_usul=".$id_usulan);
			}
	}
	
	