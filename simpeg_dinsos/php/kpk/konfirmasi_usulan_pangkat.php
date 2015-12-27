<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
	$id_usulan = mysql_real_escape_string($_POST['id_usulan']);
	$no_usulan = getNoUsul("tbl_usulan_pangkat", $id_usulan);
	
	// notification process function
	/* function something_wrong($what_is_wrong){
        echo("
            <script type='text/javascript'>
                window.parent.window.something_wrong(\"" . $what_is_wrong . "\");
            </script>
        ");
    }
    function success($pesan){
        echo("
            <script type='text/javascript'>
                window.parent.window.sukses_konfirmasi(\"" . $pesan. "\");
            </script>
        ");
    }*/
    
    $sql = "UPDATE tbl_usulan_pangkat SET status_proses = '3' WHERE no_usulan = '$no_usulan'";
	$query = mysql_query($sql);
	
	if($query){
		header("Location:../../?mod=daftar_usulan_kpk_sedang_diproses");
	}else{
		$err = "QUERY ERROR, proses ACC BKD gagal !!";
		something_wrong($err);
	}
?>