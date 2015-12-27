<?php
    include("koneksi.php");
	include("fungsi.php");
	$ids = anti_injection($_GET["id"]);
    $sql = "DELETE FROM myapp_maintable_suratmasuk WHERE id='" . $ids . "'";
    mysql_query($sql);
    //echo($sql);
    header("location:../?mod=inform&pesan=2&redir=manajemen_surat_masuk_1");
?>