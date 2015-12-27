<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    if($_POST["nip"] != ""){
        $id_pegawai = detail_pegawai_by_nip($_POST["nip"], "id_pegawai");
        mysql_query("INSERT INTO tbl_usulan_cuti(id_pegawai, id_jenis_cuti, lama, dari, sampai, keterangan) VALUES('" . $id_pegawai . "', '" . $_POST["id_jenis_cuti"] . "', '" . $_POST["lama"] . "', '" . $_POST["dari"] . "', '" . $_POST["sampai"] . "', '" . $_POST["keterangan"] . "')");
    }
    header("location:../../?mod=cuti_daftar_usulan_tambah");
?>