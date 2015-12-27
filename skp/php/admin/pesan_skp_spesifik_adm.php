<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    mysql_query("INSERT INTO tbl_pesan_skp_spesifik
                SELECT NULL, '" . $_POST["judul"] . "', '" . $_POST["pesan"] . "', CURDATE(), id_pegawai FROM tbl_pesan_skp_spesifik_temp_penerima");
    mysql_query("TRUNCATE TABLE tbl_pesan_skp_spesifik_temp_penerima");
    header("location:../../?mod=pesan_skp_spesifik_adm");
?>