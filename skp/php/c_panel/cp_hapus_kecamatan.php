<?php

	include "../koneksi.php";
	
	$id = $_GET['id'];
	
	$sql = "DELETE FROM ref_kecamatan WHERE id_kecamatan = '$id'";
	
	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_manage_kecamatan&msg=3");
	}else{
		header("Location:../../?mod=cp_manage_kecamatan&msg=4");
	}