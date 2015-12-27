<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	$mode = $_GET['mode'];
	$id_surat = mysql_real_escape_string($_GET['id_surat']);
	
	if($mode == 2){
		$catatan = $_GET['catatan'];
		$sql = "UPDATE tbl_sk_pmk SET catatan = '$catatan', status = '1' WHERE id_surat = '$id_surat'";
		$query = mysql_query($sql);
		if($query){
			header("Location:../../?mod=proses_sk_pmk&code=1");
		}
	}else{
		$sql = "UPDATE tbl_sk_pmk SET status = '3' WHERE id_surat = '$id_surat'";
		$query = mysql_query($sql);
		if($query){
			header("Location:../../?mod=proses_sk_pmk&code=2");
		}
	}