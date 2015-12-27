<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	$id_pesan = $_POST['id_pesan'];
	$dari = $_POST['dari'];
	$tujuan = $_POST['tujuan'];
	$pesan = $_POST['pesan'];
	
	$sql ="UPDATE tbl_ucapan_naik_jabatan SET pesan_teks = '".$pesan."' WHERE id_pesan = '".$id_pesan."'";
	
	$query = mysql_query($sql);

	if($query){
			header("Location:../../?mod=ucapan_jabatan_edit&code=1&mode=edit&id_pesan=".$id_pesan);
	}else{
		header("Location:../../?mod=ucapan_jabatan_edit&code=2&mode=edit&id_pesan=".$id_pesan);
	}	
		
	
	mysql_close();