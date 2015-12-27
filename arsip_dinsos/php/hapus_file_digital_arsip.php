<?php
    session_start();
    include("koneksi.php");
    mysql_query("DELETE FROM tbl_file_arsip_digital WHERE id_file = '" . $_GET["id"] . "'");
    header("location:../?mod=digitalisasi_arsip&id=" . $_GET["id_arsip"]);
?>