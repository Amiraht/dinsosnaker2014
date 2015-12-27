<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    mysql_query("DELETE FROM myapp_nonlogintable_beritainformasi WHERE id='" . $_GET["id"] . "'");
    
    header("location:../?mod=cp_berita_dan_informasi");
?>