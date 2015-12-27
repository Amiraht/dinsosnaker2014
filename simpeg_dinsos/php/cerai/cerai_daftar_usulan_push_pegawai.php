<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    if($_POST["nip"] != ""){
        $id_pegawai = detail_pegawai_by_nip($_POST["nip"], "id_pegawai");
        mysql_query("INSERT INTO tbl_usulan_cerai(id_pegawai) VALUES('" . $id_pegawai . "')");
    }
    header("location:../../?mod=cerai_daftar_usulan_tambah");
?>