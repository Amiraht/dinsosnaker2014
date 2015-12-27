<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	
	// notification process function
	function notif($pesan){
        echo("
            <script type='text/javascript'>
               alert(\"" . $pesan . "\");
			   document.location.href = '../../?mod=daftar_kpk';
            </script>
        ");
    }
	
	// all data
	$id_usulan = mysql_real_escape_string($_POST['id_usulan']);
	$no_usulan = mysql_real_escape_string($_POST['no_usulan']);
	$tgl = mysql_real_escape_string($_POST['tgl_usulan']);
	$nama_pejabat_ttd = mysql_real_escape_string($_POST['nama_pejabat_ttd']);
	$nip_pejabat_ttd = mysql_real_escape_string($_POST['nip_pejabat_ttd']);
	$jabatan_ttd = mysql_real_escape_string($_POST['jabatan_ttd']);
	$id_pangkat_ttd = $_POST['id_pangkat_ttd'];
	
	$sql = "UPDATE tbl_usulan_pangkat SET no_usulan = '$no_usulan', tgl_usulan = '$tgl', nama_pejabat_ttd = '$nama_pejabat_ttd' , 
			nip_pejabat_ttd = '$nip_pejabat_ttd', jabatan_ttd = '$jabatan_ttd', id_pangkat_ttd = '$id_pangkat_ttd' WHERE id_usulan = '$id_usulan'";
	
	$update = mysql_query($sql);
	
	if($update){
		$pesan = "Data usulan kenaikan pangkat dengan ID " . $id_usulan . " berhasil di edit";
		notif($pesan);
	}else{
		notif("ERROR QUERY, proses update data gagal !!");
	}