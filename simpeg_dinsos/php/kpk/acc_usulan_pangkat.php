<?php
	session_start();
	
	include "../koneksi.php";
	include "../fungsi.php";
	
	$id_usulan = mysql_real_escape_string($_GET['id_usul']);
	$no_usul = get_no_usulan_pangkat($id_usulan);
	$mode = $_GET['mode'];
	$catatan = $_GET['catatan'];
	
	if($mode == 3){
		$sql = "UPDATE tbl_usulan_pangkat SET status_proses = '3' WHERE no_usulan = '$no_usul'";
		$query = mysql_query($sql);	
		if($query){
			header("Location:../../?mod=acc_usulan_pangkat&code=1&id_usulan=".$id_usulan);
		}	
	}else{
		$sql = "UPDATE tbl_usulan_pangkat SET status_proses = '1', catatan='$catatan' WHERE no_usulan = '$no_usul'";
		$query = mysql_query($sql);
		if($query){
			header("Location:../../?mod=acc_usulan_pangkat&code=2&id_usulan=".$id_usulan");
		}
	}