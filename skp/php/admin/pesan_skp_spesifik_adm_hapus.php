<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    mysql_query("DELETE FROM tbl_pesan_skp_spesifik
                WHERE pesan='" . $_GET["isi_pesan"] . "'");
    header("location:../../?mod=pesan_skp_spesifik_adm");
?>