<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    mysql_query("UPDATE myapp_nonlogintable_latarbelakang SET isi='" . $_POST["isi"] . "' WHERE id='1'");
    
    header("location:../?mod=inform&pesan=44");
?>