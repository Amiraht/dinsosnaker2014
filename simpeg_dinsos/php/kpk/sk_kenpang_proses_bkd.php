<?php
	
	include "../koneksi.php";
	include "../fungsi.php";
	
	
	$status = 2;
	$id_sk = mysql_real_escape_string($_GET['id_sk']);
	
	$sql = "UPDATE tbl_sk_kenpang SET status_supervisi = '$status' 
			WHERE id_data = '$id_sk'";
			
	$query = mysql_query($sql);
	
	if($query){
		header("Location:../../?mod=kenpang_daftar_sk");
	}
	