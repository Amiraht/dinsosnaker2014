<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	$id_surat = get_id_sk_pmk();
	$no_sk = mysql_real_escape_string($_POST['no_sk']);
	$tgl_sk = mysql_real_escape_string($_POST['tgl_sk']);
	$nama_ttd_sk = mysql_real_escape_string($_POST['nama_ttd_sk']);
	$nip_ttd_sk = mysql_real_escape_string($_POST['nip_ttd_sk']);
	$jabatan_ttd_sk = mysql_real_escape_string($_POST['jabatan_ttd_sk']);
	$id_pangkat_ttd = mysql_real_escape_string($_POST['id_pangkat_ttd_sk']);
	$status = 1;
	
	$sql = "INSERT INTO tbl_sk_pmk VALUES('$id_surat','$no_sk', CURDATE(), '$tgl_sk', '$nama_ttd_sk', 
			'$nip_ttd_sk', '$id_pangkat_ttd', '$jabatan_ttd_sk', '-', '-', '$status')";
			
	$query = mysql_query($sql);

	if($query){
			print "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";		
			print "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;";
			print "Data Surat Keputusan (SK) PMK Pegawai telah di tambah.<br/></center>";
			print "</div>";
	}else{
		print "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";		
		print "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;";
		print "Terjadi kesalahan dalam menambah data SK PMK.<br/></center>";
		print "</div>";
	}	
	
	mysql_close();