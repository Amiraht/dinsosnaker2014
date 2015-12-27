<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
	$id_usulan = mysql_real_escape_string($_GET['id_usulan']);
	
    
    $sql = "UPDATE tbl_usulan_pangkat SET status_proses = '2' WHERE id_usulan = '$id_usulan'";
	
	$query = mysql_query($sql);
	if($query){
		header("Location:../../?mod=daftar_kpk");
	}
?>