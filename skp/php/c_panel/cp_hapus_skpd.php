<?php

	include "../koneksi.php";
	
	$id = $_GET['id'];
	
	$str = "DELETE FROM ref_skpd WHERE id_skpd = '".$id."'";
	
	$query = mysql_query($str);
	
	if($query){
		header("Location:../../?mod=cp_manage_skpd&msg=3");
	}else{
		header("Location:../../?mod=cp_manage_skpd&msg=2");
	}
	
	mysql_close();