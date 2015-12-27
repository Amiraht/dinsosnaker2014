<?php

	include "../koneksi.php";
	
	$id = $_GET['id'];
	
	$sql = "DELETE FROM ref_provinsi WHERE id_provinsi = '$id'";
	
	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_manage_provinsi&msg=3");
	}else{
		header("Location:../../?mod=cp_manage_provinsi&msg=4");
	}