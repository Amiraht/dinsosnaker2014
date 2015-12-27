<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    mysql_query("UPDATE myapp_nonlogintable_latarbelakang SET isi='" . $_POST["isi"] . "' WHERE id='" . $_POST["id"] . "'");
    
    header("location:../?mod=info&pesan=2");
?>