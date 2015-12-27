<?php
    session_start();
    include("koneksi.php");
    
    mysql_query("INSERT INTO tbl_arsip_yang_dipinjam VALUES(null, '" . $_SESSION["id_pin_dig"] . "', '" . $_GET["id_arsip"] . "')");
    
    header("location:../?mod=permohonan_peminjaman_digital");
?>