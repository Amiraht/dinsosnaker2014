<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    mysql_query("DELETE FROM tbl_pesan_skp_all WHERE id_pesan='" . $_GET["id_pesan"] . "'");
    header("location:../../?mod=pesan_skp_all_adm");
?>