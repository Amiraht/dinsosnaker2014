<?php

	include "../koneksi.php";
	
	$id = $_POST['id_provinsi'];
	$provinsi = $_POST['provinsi'];
	
	$sql = "UPDATE ref_provinsi SET provinsi = '$provinsi' WHERE  
			id_provinsi = '$id'";
	
	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_manage_provinsi&msg=2");
	}else{
		header("Location:../../?mod=cp_manage_provinsi&msg=4");
	}
		
	