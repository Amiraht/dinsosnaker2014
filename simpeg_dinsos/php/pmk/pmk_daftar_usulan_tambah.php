<?php	
	session_start();
    include("../koneksi.php");
    include("../fungsi.php");
	
	// all variables
	$no_usulan = mysql_real_escape_string($_POST['no_usulan']);
	$tgl_usulan = $_POST['tgl_usulan'];
	$pengusul = mysql_real_escape_string($_POST['pengusul']);
	$nip_pengusul = mysql_real_escape_string($_POST['nip_pengusul']);
	$jabatan_ttd = mysql_real_escape_string($_POST['jabatan_ttd']);
	$id_pangkat_ttd = mysql_real_escape_string($_POST['id_pangkat_ttd']);
	$id_skpd = $_POST['id_skpd'];
	$id_data = get_maks_id_pmk();
	
	$sttrv = 1;
	if($_SESSION["simpeg_id_level"] == 12){
		$sttrv = 3;
	}
	// query process
	$sql = "INSERT INTO  tbl_usulan_pmk VALUES('$id_data','$no_usulan','$tgl_usulan','$pengusul','$nip_pengusul', 
			'$id_pangkat_ttd', '$jabatan_ttd', '$id_skpd', '','$sttrv')
			";
	$query = mysql_query($sql);
	
	if($query){
			$code = 1;
			$act = "add";
			header("location:../../?mod=pmk_daftar_usulan&code=".$code."&act=".$act);
	}else{
			$code = 2;
			$act = "add";
			header("location:../../?mod=pmk_daftar_usulan&code=".$code."&act=".$act);
	}	
	
	
	