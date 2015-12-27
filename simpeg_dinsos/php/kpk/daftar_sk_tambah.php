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
	$id_data = get_maks_id_sk_pangkat();
	$no_sk = mysql_real_escape_string($_POST['no_sk']);
	$tgl_sk = mysql_real_escape_string($_POST['tgl_sk']);
	$nama_ttd = mysql_real_escape_string($_POST['nama_ttd_sk']);
	$nip_ttd = mysql_real_escape_string($_POST['nip_ttd_sk']);
	$jabatan_ttd = mysql_real_escape_string($_POST['jabatan_ttd_sk']);
	$id_pangkat_ttd = mysql_real_escape_string($_POST['id_pangkat_ttd_sk']);
	$status = 1;
	
	// insert query
	$sql = "INSERT INTO tbl_sk_kenpang VALUES('$id_data', '$no_sk', '$tgl_sk', '$jabatan_ttd', '$nama_ttd', '$nip_ttd', '$id_pangkat_ttd', 
			'-', '-', '$status')";
			
	$q = mysql_query($sql);
	if($q){
		success();
	}else{
		something_wrong("Maaf data gagal disimpan !!");
	}
	
	
	