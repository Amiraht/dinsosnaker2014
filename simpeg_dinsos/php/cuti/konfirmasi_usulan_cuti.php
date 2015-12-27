<?php

	include "../koneksi.php";
	include "../fungsi.php";
	
	// fungsi untuk notifikasi sukses atau gagal suatu proses
	function something_wrong($pesan){
        echo("
            <script type='text/javascript'>
                alert(\"" . $pesan . "\", 'HAPUS GAGAL');
				document.location.href='../../?mod=cuti_daftar_usulan_proses';
            </script>
        ");
    }
    function success($pesan){
        echo("
            <script type='text/javascript'>
                alert(\"" . $pesan . "\", 'KONFIRMASI');
				document.location.href='../../?mod=cuti_daftar_usulan_proses';
            </script>
        ");
    }
	
	$mode = $_GET['mode'];
	
	// di cek apakah request dengan metode POST atau GET
	if(isset($_POST['id_usulan']) && isset($_POST['no_usulan']) && isset($_POST['catatan'])){
		$id_usulan = $_POST['id_usulan'];
		$no_usul = $_POST['no_usulan'];
		$catatan = $_POST['catatan'];	
	}else if(isset($_GET['id_usulan'])){
		$id_usulan = $_GET['id_usulan'];
		$no_usul = getNoUsulFromUsulanCuti($id_usulan);
	}
	
	$sql = "";
	
	if($mode == 1){
		$sql = "UPDATE tbl_usulan_cuti SET diproses = '1' WHERE no_usulan = '".$no_usul."' AND diproses = '0'";
		
		$query = mysql_query($sql);
	
		if($query){
			success("Usulan Izin Cuti dengan No Usul. ". $no_usul ." telah diterima (ACC)");
		}else{
			something_wrong("Terjadi kesalahan, proses ACC gagal !!");
		}
	
		mysql_close();
		
	}else{
		$sql = "UPDATE tbl_usulan_cuti SET diproses = '2', catatan_penolakan = '$catatan' WHERE no_usulan = '".$no_usul."' AND diproses = '0'";
		
		$query = mysql_query($sql);
	
		if($query){
			success("Usulan Izin Cuti dengan No Usul. ". $no_usul ." ditolak");
		}else{
			something_wrong("Terjadi kesalahan, proses gagal !!");
		}
	
		mysql_close();
	}
	
	