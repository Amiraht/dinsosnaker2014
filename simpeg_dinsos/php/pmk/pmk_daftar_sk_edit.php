<?php
	session_start();
	
	include "../koneksi.php";
	include "../fungsi.php";
	
	$id_surat = $_POST['id_sk'];
	$no_sk = $_POST['no_sk'];
	$no_sk_lama = $_POST['no_sk_lama'];
	$tgl_sk = $_POST['tgl_sk'];
	$nama_ttd_sk = $_POST['nama_ttd_sk'];
	$nip_ttd_sk = $_POST['nip_ttd_sk'];
	$jabatan_ttd_sk = $_POST['jabatan_ttd_sk'];
	$id_pangkat = $_POST['id_pangkat_ttd_sk'];
	$no_usul = $_POST['no_surat_usul'];
	
	$sql = "UPDATE tbl_sk_pmk SET no_sk = '$no_sk', tgl_surat = '$tgl_sk', pejabat_ttd = '$nama_ttd_sk', nip_pejabat_ttd = '$nip_ttd_sk',
			id_pangkat_ttd = '$id_pangkat', jabatan_ttd_sk = '$jabatan_ttd_sk' ,no_usul_pmk = '$no_usul' 
			WHERE id_surat = '$id_surat'";
			
	$update = mysql_query($sql);
	
	if($update){
		
			print "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";		
			print "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;";
			print "Data Surat Keputusan (SK) PMK Pegawai dengan ID ".$id_surat." telah di ubah.<br/></center>";
			print "</div>";
		
	}else{
		print "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";		
		print "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;";
		print "Terjadi kesalahan dalam mengubah data SK PMK.<br/></center>";
		print "</div>";
	}	
	
	mysql_close();