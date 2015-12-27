<?php

	include "../koneksi.php";
	include "../fungsi.php";
	
	$id = $_POST['id_user'];
	$nama_pegawai = strtoupper($_POST['nama_pegawai']);
	$username = $_POST['username'];
	$modul = $_POST['level'];
	$id_skpd = $_POST['id_skpd'];
	$password = $_POST['password'];
	$konfirmasi = $_POST['konfirmasi'];
	$id_pegawai = get_id_pegawai_by_nama($_POST['nama_pegawai']);
	
	if($password != $konfirmasi){
		header("Location:../../?mod=edit_data_pengguna&msg=101");
		exit;
	}

	$sql = "UPDATE tbl_pengguna SET nama = '$nama_pegawai', username = '$username', password = '$password', modul = '$modul', 
			id_skpd = '$id_skpd', id_pegawai = '$id_pegawai' WHERE id_user = '$id'";

	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=edit_data_pengguna&msg=1");
	}else{
		header("Location:../../?mod=edit_data_pengguna&msg=2");
	}
		
	mysql_close();	
	
	