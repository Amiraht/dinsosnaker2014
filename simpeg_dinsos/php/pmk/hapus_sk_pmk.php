<?php
	
	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	// notification process function
	 function something_wrong($what_is_wrong){
        echo("
            <script type='text/javascript'>
                window.parent.window.something_wrong(\"" . $what_is_wrong . "\");
            </script>
        ");
    }
    function success($pesan){
        echo("
            <script type='text/javascript'>
                window.parent.window.sukses(\"" . $pesan . "\");
            </script>
        ");
    }
	
	$id_surat = $_GET['id_sk'];
	
	$sql = "DELETE FROM tbl_sk_pmk WHERE id_surat = ? ";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('i', $id_surat);
	
	$query = $stm->execute();
	
	if($query){
		 	success("Data SK PMK dengan ID ".$id_surat." telah dihapus");
	}else{
		something_wrong("Delete Data Gagal, Error Query !!");
	}
	
	$stm->close();
	