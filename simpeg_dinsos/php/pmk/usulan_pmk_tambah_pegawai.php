<?php
	
	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	$id_usulan = $_POST['id_usulan'];
	$nomor = get_id_data_pmk();
	$nip = (!empty($_POST['nip'])) ? $_POST['nip'] : "-";
	$no_persetujuan = (!empty($_POST['no_persetujuan'])) ? $_POST['no_persetujuan'] : "-";
	$tgl_persetujuan = (!empty($_POST['tgl_persetujuan'])) ? $_POST['tgl_persetujuan'] : "-";
	$mulai_sma = $_POST['tgl_mulai_sma'];
	$selesai_sma = $_POST['tgl_selesai_sma'];
	$mulai_1 = $_POST['tgl_mulai_1'];
	$selesai_1 = $_POST['tgl_selesai_1'];
	$pengalaman = $_POST['pengalaman'];
	
	
	$sql = "INSERT INTO tbl_detail_usul_pmk VALUES(?,?,?,?,?,?,?,?,?,?)";
	
	$stmt = $con->prepare($sql);
	
	
    if($stmt === false) {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
	}	
	
	// bind param
	$stmt->bind_param('iissssssss', $nomor, $id_usulan, $nip, $pengalaman, $mulai_1, $selesai_1, $no_persetujuan, $tgl_persetujuan, $mulai_sma, $selesai_sma);
	
	
	// execute query
	$exc = $stmt->execute();
	
	if($exc){
		print "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";		
		print "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;";
		print "Pegawai dengan NIP : ".$nip." telah ditambahkan pada usulan PMK dengan No Usul ".$no_usulan.".<br/></center>";
		print "</div>";
	}else{
		print "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";		
		print "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;";
		print "Terjadi kesalahan dalam, menambahkan data pegawai.<br/></center>";
		print "</div>";
	}
	
	//$stmt->close();