<?php
    session_start();
    include("koneksi.php");
    
    mysql_query("DELETE FROM tbl_arsip_yang_dipinjam WHERE id_arsip_dipinjam='" . $_GET["id"] . "'");
    
    header("location:../?mod=permohonan_peminjaman_digital");
?>