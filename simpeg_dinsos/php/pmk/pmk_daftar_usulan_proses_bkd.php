<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	$id_usulan = mysql_real_escape_string($_GET['id_usul']);
	$no_usul = get_no_usulan_pmk($id_usulan);
	
	
	$sql = "UPDATE tbl_usulan_pmk SET status_supervisi = '2' WHERE no_usulan = '". $no_usul ."'";
			
	$update = mysql_query($sql);
	
	if($update){
		header("Location:../../?mod=pmk_daftar_usulan&act=proses&code=1");
	}else{
		header("Location:../../?mod=pmk_daftar_usulan&act=proses&code=2");
	}
	