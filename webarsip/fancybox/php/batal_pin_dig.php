<?php
    session_start();
    include("koneksi.php");
    
    mysql_query("DELETE FROM tbl_peminjaman_arsip WHERE id_peminjaman='" . $_SESSION["id_pin_dig"] . "'");
    //echo("DELETE FROM tbl_peminjaman_arsip WHERE id_peminjaman='" . $_SESSION["id_pin_dig"] . "'");
    header("location:../?mod=pin_dig");
?>