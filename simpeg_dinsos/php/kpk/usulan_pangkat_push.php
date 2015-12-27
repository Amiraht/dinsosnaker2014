<?php
	include "../koneksi.php";
	include "../fungsi.php";
	
	// notification process function
	 function something_wrong($pesan, $id_usul){
        echo("
            <script type='text/javascript'>
               alert(\"" . $pesan . "\");
			   document.location.href = '../../?mod=usulan_pangkat_tambah_pegawai&id_usulan=".$id_usul."';
            </script>
        ");
    }
    function success($pesan, $id_usul){
        echo("
            <script type='text/javascript'>
               alert(\"" . $pesan . "\");
			   document.location.href = '../../?mod=usulan_pangkat_tambah_pegawai&id_usulan=".$id_usul."';
            </script>
        ");
    }

	
	// all variables
	$id_pangkat_baru = $_POST['id_pangkat_baru'];
	$id_jabatan_baru = $_POST['id_jabatan_baru'];
	$nip = $_POST['nip'];
	$id_pegawai = detail_pegawai_by_nip($nip, "id_pegawai");
	$id_usul = $_POST['id_usulan'];
	$id_detail = getMaksIDPangkatDetail();
	// status proses
	$status = 1;
	
	$sql = "INSERT INTO tbl_detail_usulan_pangkat VALUES('$id_detail', '$id_usul', '$id_pegawai', '$id_pangkat_baru', '$id_jabatan_baru', 
			'$status', '')";
			
	$query = mysql_query($sql) or die(mysql_error());
		
	if($query){
			success("Pegawai Telah ditambahkan pada data surat usulan", $id_usul);
	}else{
			 something_wrong("Maaf, insert data surat usulan kenaikan pangkat gagal !!", $id_usul);
	}	
	
	mysql_close();