<?php

	include "../mysqli_connect.php";
	
	function notif($pesan, $id_usul){
        echo("
            <script type='text/javascript'>
               alert(\"" . $pesan . "\");
			   document.location.href = '../../?mod=usulan_pangkat_tambah_pegawai&id_usulan=".$id_usul."';
            </script>
        ");
    }

	$id_usulan = $_GET['id_usulan'];
	$id_detail = $_GET['id_detail'];
	
	$sql = "DELETE FROM tbl_detail_usulan_pangkat WHERE id_detail = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('i', $id_detail);
	
	$query = $stm->execute();
	
	if($query){
		notif("Data Pegawai telah dibuang dari daftar usulan pegawai", $id_usulan);
	}else{
		notif("Error Query, proses hapus pegawai gagal !!", $id_usulan);
	}