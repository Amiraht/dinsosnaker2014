<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $sql = "DELETE FROM tbl_riwayat_pangkat WHERE id_riwayat_pangkat='" . $_GET["id_riwayat_pangkat"] . "'";
    mysql_query($sql);
    update_pangkat_pegawai($_SESSION["simpeg_id_pegawai"]);
    header("location:../../?mod=riwayat_pangkat");
?>