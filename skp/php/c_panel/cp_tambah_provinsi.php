<?php

	include "../koneksi.php";
	
	$provinsi = $_POST['provinsi'];
	
	$sql = "INSERT INTO ref_provinsi VALUES('', '$provinsi')";
	
	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_manage_provinsi&msg=1");
	}else{
		header("Location:../../?mod=cp_manage_provinsi&msg=4");
	}
	
	mysql_close();