<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	$id_usulan = $_POST['id_usulan'];
	$no_usulan = $_POST['no_usulan'];
	$no_us = $_POST['no_us'];
	$tgl_usulan = $_POST['tgl_usulan'];
	$pengusul = $_POST['pengusul'];
	$nip_pengusul = $_POST['nip_pengusul'];
	$jabatan_ttd = $_POST['jabatan_ttd'];
	$id_pangkat = $_POST['id_pangkat'];
	$sql = "";
	
	$sql .= "UPDATE tbl_usulan_pmk SET no_usulan = '".$no_usulan."', tgl_usulan = '".$tgl_usulan."', pejabat_pengusul = '".$pengusul."', 
			nip_pejabat_pengusul = '".$nip_pengusul."', id_pangkat_pejabat_pengusul = '".$id_pangkat."', jabatan_penandatangan = '".$jabatan_ttd."'
			WHERE id_usulan = '".$id_usulan."';";
	
	$sql .= "UPDATE tbl_detail_usul_pmk SET no_usulan = '".$no_usulan."' WHERE no_usulan = '".$no_us."';";
	
	$update = $con->multi_query($sql);
	
	if($update){
		if($no_us != $no_usulan){
			print "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";		
			print "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;";
			print "Surat Usul PMK dengan nomor : ". $no_us ." telah diubah dengan nomor baru  ". $no_usulan .".<br/></center>";
			print "</div>";
		}else{
			print "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";		
			print "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;";
			print "Data Surat Usulan PMK Pegawai telah di edit.<br/></center>";
			print "</div>";
		}	
	}else{
		trigger_error('Error: ' . $con->error, E_USER_ERROR);
		
		print "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";		
		print "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;";
		print "Terjadi kesalahan dalam, mengubah data surat usul PMK.<br/></center>";
		print "</div>";
	}
	