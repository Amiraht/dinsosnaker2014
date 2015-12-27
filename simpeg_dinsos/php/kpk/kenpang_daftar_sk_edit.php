<?php

	include "../koneksi.php";
	include "../fungsi.php";
	
	// notification process function
	 function something_wrong($what_is_wrong){
        echo("
            <script type='text/javascript'>
                window.parent.window.something_wrong(\"" . $what_is_wrong . "\");
            </script>
        ");
    }
    function success(){
        echo("
            <script type='text/javascript'>
                window.parent.window.success();
            </script>
        ");
    }
	
	// all the variables
	$id_data = mysql_real_escape_string($_POST['id_sk']);
	$no_sk = mysql_real_escape_string($_POST['no_sk']);
	$tgl_sk = mysql_real_escape_string($_POST['tgl_sk']);
	$nama_ttd = mysql_real_escape_string($_POST['nama_ttd_sk']);
	$nip_ttd = mysql_real_escape_string($_POST['nip_ttd_sk']);
	$jabatan_ttd = mysql_real_escape_string($_POST['jabatan_ttd_sk']);
	$id_pangkat_ttd = mysql_real_escape_string($_POST['id_pangkat_ttd_sk']);
	$status = 1;
	
	// insert query
	$sql = "UPDATE tbl_sk_kenpang SET no_sk = '$no_sk', tgl_sk = '$tgl_sk', jabatan_ttd_sk = '$jabatan_ttd', nama_ttd_sk = '$nama_ttd',
			nip_ttd_sk = '$nip_ttd', id_pangkat_ttd_sk = '$id_pangkat_ttd' WHERE id_data = '$id_data'";
			
	$q = mysql_query($sql);
	
	if($q){
		success();
	}else{
		something_wrong("Maaf, update data SK usulan kenaikan data gagal diubah !!");
	}
	
	mysql_close();
	