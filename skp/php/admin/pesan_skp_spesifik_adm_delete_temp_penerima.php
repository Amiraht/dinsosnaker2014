<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    mysql_query("DELETE FROM tbl_pesan_skp_spesifik_temp_penerima WHERE id_pegawai='" . $_GET["id_pegawai"] . "'");
    header("location:../../?mod=pesan_skp_spesifik_adm_tambah");
?>