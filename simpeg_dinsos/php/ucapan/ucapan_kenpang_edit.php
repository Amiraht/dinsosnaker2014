<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	$id_pesan = $_POST['id_pesan'];
	$dari = $_POST['dari'];
	$tujuan = $_POST['tujuan'];
	$pesan = $_POST['pesan'];
	
	$sql ="UPDATE tbl_ucapan_naik_pangkat SET pesan_teks = '".$pesan."' WHERE id_pesan = '".$id_pesan."'";
	
	$query = mysql_query($sql);

	if($query){
	 /*
			print "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";		
			print "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
			print "Pesan Ucapan Telah di edit.<br/></center>";
			print "</div>";
	*/
		header("Location:../../?mod=ucapan_kenpang_terkirim");
	}else{
		print "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";		
		print "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
		print "Pesan gagal diedit .<br/></center>";
		print "</div>";
		header("Location:../../?mod=ucapan_kenpang_terkirim");
	}	
	
	mysql_close();