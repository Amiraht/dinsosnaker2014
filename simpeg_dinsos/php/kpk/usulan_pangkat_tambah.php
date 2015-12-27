<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	// notification process function
	 function something_wrong($pesan){
        echo "
            <script type='text/javascript'>
                alert(\"" . $pesan . "\");
				document.location.href='../../?mod=daftar_kpk'
            </script>
        ";
    }
	
    function success($pesan){
        echo "
            <script type='text/javascript'>
                alert(\"" . $pesan . "\");
				document.location.href='../../?mod=daftar_kpk'
            </script>
        " ;
    }
	
	// all variables
	$no_usul = mysql_real_escape_string($_POST['no_usulan']);
	$tgl_usulan = mysql_real_escape_string($_POST['tgl_usulan']);
	$pejabat_ttd = mysql_real_escape_string($_POST['nama_pejabat_ttd']);
	$nip_ttd = mysql_real_escape_string($_POST['nip_pejabat_ttd']);
	$jabatan = mysql_real_escape_string($_POST['jabatan_ttd']);
	$id_usul = get_maks_id_pangkat();
	$id_pangkat_ttd = $_POST['id_pangkat_ttd'];
	// status proses
	$status = 1;
	
	$sql = "INSERT INTO tbl_usulan_pangkat VALUES('$id_usul', '$no_usul', '$tgl_usulan', '$pejabat_ttd', '$nip_ttd', '$jabatan', 
			'$id_pangkat_ttd', '$status', '')";
			
	$query = mysql_query($sql) or die(mysql_error());
		
	if($query){
			success("Tambah Data Usulan Kenaikan Pangkat Sukses !!");
	}else{
			 something_wrong("Maaf, insert data surat usulan kenaikan pangkat gagal !!");
	}	
		