<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    mysql_query("DELETE FROM myapp_nonlogintable_filedownload WHERE id='" . $_GET["id"] . "'");
    
    header("location:../?mod=cp_file_download");
?>