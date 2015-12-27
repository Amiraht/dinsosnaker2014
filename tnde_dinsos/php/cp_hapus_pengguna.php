<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    mysql_query("DELETE FROM myapp_maintable_pengguna WHERE id='" . $_GET["id"] . "'");
    
    header("location:../?mod=cp_pengguna");
?>