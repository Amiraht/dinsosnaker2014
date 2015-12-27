<?php

	include "../mysqli_connect.php";
	
	$id_file = $_GET['id_file'];
	$id_data = $_GET['id_data'];
	
	$sql = "DELETE FROM tbl_scan_sk_kenpang WHERE id_files = '".$id_file."'";
	
	$query = $con->query($sql);
	
	if($query){
		header("Location:../../?mod=simpan_berkas_sk_kepangkatan&id_data=".$id_data."&notif=1");
	}else{
		header("Location:../../?mod=simpan_berkas_sk_kepangkatan&id_data=".$id_data."&notif=2");
	}