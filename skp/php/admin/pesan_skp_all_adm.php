<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    mysql_query("INSERT INTO tbl_pesan_skp_all VALUES(null, '" . $_POST["judul"] . "', '" . $_POST["pesan"] . "', CURDATE())");
    header("location:../../?mod=pesan_skp_all_adm");
?>