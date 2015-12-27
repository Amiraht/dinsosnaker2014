<?php
    session_start();
    include("koneksi.php");
    mysql_query("DELETE FROM tbl_benda_arsip
                 WHERE id_arsip='" . $_GET["id"] . "'");
    header("location:../?mod=info&pesan=6&redir=data_arsip");
?>