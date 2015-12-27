<?php

	include "../koneksi.php";
	
	$kecamatan = $_POST['kecamatan'];
	$id_kabupaten = $_POST['id_kabupaten'];
	
	$sql = "INSERT INTO ref_kecamatan VALUES('', '$id_kabupaten', '$kecamatan')";
	
	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_manage_kecamatan&msg=1");
	}else{
		header("Location:../../?mod=cp_manage_kecamatan&msg=4");
	}
	
	mysql_close();