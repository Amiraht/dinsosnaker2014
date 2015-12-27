<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    mysql_query("INSERT INTO myapp_sessiontable_balasan VALUES(null, '" . session_id() . "', '" . $_GET["id"] . "')");
    header("location:../?mod=buat_surat_keluar");
?>