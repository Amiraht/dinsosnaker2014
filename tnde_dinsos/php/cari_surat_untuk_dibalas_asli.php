<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    mysql_query("INSERT INTO myapp_maintable_balasan VALUES(null, '" . $_GET["id"] . "', '" . $_GET["id_surat_keluar"] . "')");
    header("location:../?mod=edit_surat_keluar&id=" . $_GET["id_surat_keluar"]);
?>