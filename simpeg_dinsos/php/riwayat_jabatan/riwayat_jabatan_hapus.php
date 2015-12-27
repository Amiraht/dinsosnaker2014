<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $sql = "DELETE FROM tbl_riwayat_jabatan WHERE id_riwayat_jabatan='" . $_GET["id_riwayat_jabatan"] . "'";
    mysql_query($sql);
    update_jabatan_pegawai($_SESSION["simpeg_id_pegawai"]);
    header("location:../../?mod=riwayat_jabatan");
?>