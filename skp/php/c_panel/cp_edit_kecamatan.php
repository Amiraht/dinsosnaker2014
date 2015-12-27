<?php

	include "../koneksi.php";
	
	$id = $_POST['id_kecamatan'];
	$kecamatan = $_POST['kecamatan'];
	$id_kabupaten = $_POST['id_kabupaten'];
	
	$sql = "UPDATE ref_kecamatan SET id_kabupaten = '$id_kabupaten', kecamatan = '$kecamatan' WHERE 
			id_kecamatan = '$id'";
	
	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_manage_kecamatan&msg=2");
	}else{
		header("Location:../../?mod=cp_manage_kecamatan&msg=4");
	}
		
	