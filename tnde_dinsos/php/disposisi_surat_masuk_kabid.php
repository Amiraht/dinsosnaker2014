<?php
    session_start();
    include("koneksi.php");
	include("fungsi.php");
	$id = anti_injection($_GET['id']);
	$catatan = anti_injection($_GET['catatan']);
	
    // 1. UPDATE surat masuk STATUS = 2 DAN ISIKAN TUJUAN SERTA ASAL DISPOSISI
    mysql_query("UPDATE myapp_maintable_suratmasuk SET asal_disposisi='$_SESSION[id_level]', tujuan_disposisi='$_GET[tujuan_disposisi]' WHERE id='".$id."'");
    
    // 2. PUSH catatan disposisi surat masuk
    mysql_query("INSERT INTO myapp_notetable_disposisisuratmasuk VALUES(null, '".$id."', '$_SESSION[id_level]', '".$catatan."')");
    //echo($sql);
    header("location:../?mod=inform&pesan=5&redir=disposisi_surat_masuk_kabid");
?>