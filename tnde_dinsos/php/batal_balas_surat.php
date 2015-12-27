<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
	$id = anti_injection($_GET["id"]);
	$id_sk = anti_injection($_GET["id_surat_keluar"]);
	
    mysql_query("DELETE FROM myapp_maintable_balasan WHERE id='" . $id . "'");
    header("location:../?mod=edit_surat_keluar&id=" . $id_sk);
	
?>