<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    mysql_query("UPDATE myapp_maintable_pengguna SET id_level='$_POST[id_level]', level_kasubbid='0' WHERE id='" . $_POST["id"] . "'");
    header("location:../?mod=cp_pengguna");
?>