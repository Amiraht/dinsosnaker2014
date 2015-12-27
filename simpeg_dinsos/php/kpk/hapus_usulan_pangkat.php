<?php
	session_start();
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
    function success($pesan_sukses){
        echo("
            <script type='text/javascript'>
                window.parent.window.sukses_hapus(\"" . $pesan_sukses . "\");
            </script>
        ");
    }
	
	$id_usul = mysql_real_escape_string($_GET['id_usulan']);
	
	$sql = "DELETE FROM tbl_usulan_pangkat WHERE id_usulan = '". $id_usul ."'";
	
	$query = mysql_query($sql);
	
	if($query){
		$pesan = "Data usulan kenaikan pangkat dengan ID " . $id_usul . " telah dihapus ";
		success($pesan);
	}else{
		something_wrong("QUERY ERROR, proses delete data usulan kenaikan pangkat gagal !! ");
	}