<?php

	include "../koneksi.php";
	
	$id = $_GET['id'];
	
	$sql = "DELETE FROM ref_kabupaten WHERE id_kabupaten = '$id'";
	
	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_manage_kabupaten&msg=3");
	}else{
		header("Location:../../?mod=cp_manage_kabupaten&msg=4");
	}