<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	$id_pesan = $_GET['id_pesan'];
	
	$sql = "DELETE FROM tbl_ucapan_naik_jabatan WHERE id_pesan = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('i', $id_pesan);
	
	$exc = $stm->execute();
	
	if($exc){
			print "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";		
			print "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
			print "Pesan dengan ID ".$id_pesan." telah dihapus.<br/></center>";
			print "</div>";
	}else{
		print "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";		
		print "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
		print "Pesan gagal dihapus , terjadi kesalahan.<br/></center>";
		print "</div>";
	}	
	
	//$stm->free();