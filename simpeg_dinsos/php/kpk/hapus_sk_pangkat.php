<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	$id_data = mysql_real_escape_string($_GET['id_sk']);
	

	/* cek dahulu keberadaan file upload Scan SK */
	$filename = getfile_sk_kenpang($id_data);
	$dir = "../../sys_files/scan_sk_kenpang/ " . $filename;
	
	if(file_exists($dir)){
		unlink($dir);
	}
	
	$sql = "DELETE FROM tbl_sk_kenpang WHERE id_data = '$id_data'";
	
	$delete = mysql_query($sql);
	$act = "del"; // mode pesan notofikasi query proses
	if($delete){
		$code = 1; // kode query berhasil
		
		header("Location:../../?mod=kenpang_daftar_sk&code=".$code."&act=".$act);
	}else{
		$code = 2; // kode query gagal
		
		header("Location:../../?mod=kenpang_daftar_sk&code=".$code."&act=".$act);
	}