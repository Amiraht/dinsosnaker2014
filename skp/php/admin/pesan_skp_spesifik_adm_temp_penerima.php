<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $id_pegawai = detail_pegawai_by_nip($_POST["nip"], "id_pegawai");
    
    mysql_query("INSERT INTO tbl_pesan_skp_spesifik_temp_penerima VALUES('" . $id_pegawai . "')");
    header("location:../../?mod=pesan_skp_spesifik_adm_tambah");
?>