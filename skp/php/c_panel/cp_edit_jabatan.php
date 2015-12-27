<?php

	include "../koneksi.php";
	include "../fungsi.php";
	
	$jabatan = $_POST['jabatan'];
	$kode_jabatan = $_POST['kode_jabatan'];
	$id_eselon = $_POST['id_eselon'];
	$id_tipe_jabatan = $_POST['id_tipe_jabatan'];
	$id_skpd = $_POST['id_skpd'];
	$kode_skpd = getKodeSKPD($id_skpd);
	$id_jabatan = $_POST['id_jabatan'];
	
	$sql = "UPDATE ref_jabatan SET id_skpd = '$id_skpd', id_tipe_jabatan = '$id_tipe_jabatan', id_eselon = '$id_eselon', jabatan = '$jabatan', 
			kode_jabatan = '$kode_jabatan', kode_skpd = '$kode_skpd' WHERE id_jabatan = '$id_jabatan'";
	
	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_manage_jabatan&msg=3");
	}else{
		header("Location:../../?mod=cp_manage_jabatan&msg=2");
	}
	
	mysql_close();