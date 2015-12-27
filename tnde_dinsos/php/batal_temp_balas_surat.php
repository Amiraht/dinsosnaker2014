<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    mysql_query("DELETE FROM myapp_sessiontable_balasan WHERE id='" . $_GET["id"] . "'");
    header("location:../?mod=buat_surat_keluar");
?>