<?php

	include "../mysqli_connect.php";
	
    function notif($pesan, $id_usul){
        echo("
            <script type='text/javascript'>
                alert(\"" . $pesan . "\");
				document.location.href = '../../?mod=usulan_pmk_tambah_pegawai&id_usul=". $id_usul ."';
            </script>
        ");
    }
	
	$nomor = $_GET['nomor'];
	$id_usul = $_GET['id_usulan'];
	
	$sql = "DELETE FROM tbl_detail_usul_pmk WHERE nomor = ?";
	
	$stm = $con->prepare($sql);
	
	/* trigger if query false */
	if($stm === false) {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
	}

	//bind param
	$stm->bind_param('i', $nomor);	
	
	$query = $stm->execute();
	
	if($query){
		notif("Pegawai Berhasil Dihapus !!", $id_usul);
	}else{
		notif("Query Error, terjadi kesalahan dalam menghapus data !!", $id_usul);
	}