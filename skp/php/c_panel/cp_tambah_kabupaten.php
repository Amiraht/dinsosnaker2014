<?php

	include "../koneksi.php";
	
	$kabupaten = $_POST['kabupaten'];
	$id_provinsi = $_POST['id_provinsi'];
	
	$sql = "INSERT INTO ref_kabupaten VALUES('', '$id_provinsi', '$kabupaten')";
	
	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_manage_kabupaten&msg=1");
	}else{
		header("Location:../../?mod=cp_manage_kabupaten&msg=4");
	}
	
	mysql_close();