<?php
	
	include "../koneksi.php";
	include "../fungsi.php";

	$nama_pegawai = strtoupper($_POST['nama_pegawai']);
	$username = $_POST['username'];
	$modul = $_POST['level'];
	$id_skpd = $_POST['id_skpd'];
	$password = $_POST['password'];
	$konfirmasi = $_POST['konfirmasi'];
	$id_pegawai = get_id_pegawai_by_nama($_POST['nama_pegawai']);
	
	if($password != $konfirmasi){
		header("Location:../../?mod=cp_tambah_pengguna&msg=101");
		exit;
	}

	$sql = "INSERT INTO tbl_pengguna VALUES(null, '$nama_pegawai', '$username', '$password', '', '', '0', '$modul', 
			'0', '', '$id_skpd', '$id_pegawai', '0')";

	$query = mysql_query($sql);

	if($query){
		header("Location:../../?mod=cp_tambah_pengguna&msg=1");
	}else{
		header("Location:../../?mod=cp_tambah_pengguna&msg=2");
	}
		
	mysql_close();	