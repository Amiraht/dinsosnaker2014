<?php

	include "../koneksi.php";
	include "../fungsi.php";
	
	$skpd = $_POST['skpd'];
	$id_instansi = $_POST['id_instansi'];
	$kode = $_POST['kode'];
	$alamat = $_POST['alamat'];
	
	$sql = "INSERT INTO ref_skpd VALUES('', '$id_instansi', '$kode', '$skpd', '$alamat')";
	
	$query = mysql_query($sql);
	
	if($query){
		header("Location:../../?mod=cp_tambah_skpd&msg=1");
	}else{
		header("Location:../../?mod=cp_tambah_skpd&msg=2");
	}
	
	mysql_close();