<?php

	include "../koneksi.php";
	include "../fungsi.php";
	
	$jabatan = $_POST['jabatan'];
	$kode_jabatan = $_POST['kode_jabatan'];
	$id_eselon = $_POST['id_eselon'];
	$id_tipe_jabatan = $_POST['id_tipe_jabatan'];
	$id_skpd = $_POST['id_skpd'];
	$kode_skpd = getKodeSKPD($id_skpd);
	
	$sql = "INSERT INTO ref_jabatan VALUES('', '$id_skpd', '$id_tipe_jabatan', '$id_eselon', '$jabatan', '$kode_jabatan', '$kode_skpd')";
	
	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_manage_jabatan&msg=1");
	}else{
		header("Location:../../?mod=cp_manage_jabatan&msg=4");
	}
	
	mysql_close();