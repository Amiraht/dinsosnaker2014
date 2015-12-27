<?php

	include "../koneksi.php";
	
	$id = $_POST['id_kab'];
	$kabupaten = $_POST['kabupaten'];
	$id_provinsi = $_POST['id_provinsi'];
	
	$sql = "UPDATE ref_kabupaten SET id_provinsi = '$id_provinsi', kabupaten = '$kabupaten' WHERE 
			id_kabupaten = '$id'";
	
	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_manage_kabupaten&msg=2");
	}else{
		header("Location:../../?mod=cp_manage_kabupaten&msg=4");
	}
		
	