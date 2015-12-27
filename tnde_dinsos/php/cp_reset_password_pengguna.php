<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    mysql_query("UPDATE myapp_maintable_pengguna SET password='1234' WHERE id='" . $_GET["id"] . "'");
    
    header("location:../?mod=inform&pesan=46&redir=cp_pengguna");
?>