<?php

	include "../koneksi.php";

	$id = $_GET['id_user'];	
	
	$sql = "DELETE FROM tbl_pengguna WHERE id_user = '".$id."'";
	
	$query = mysql_query($sql);
	
	if($query){
		header("Location:../../?mod=cp_manage_pengguna&msg=1");
	}else{
		header("Location:../../?mod=cp_manage_pengguna&msg=2");
	}
	
	