<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $sql = "INSERT INTO tbl_riwayat_pangkat VALUES(null, '" . $_SESSION["simpeg_id_pegawai"] . "', '" . $_POST["id_pangkat"] . "', '" . $_POST["tmt"] . "', '" . $_POST["no_sk"] . "',
            '" . $_POST["tgl_sk"] . "', '" . $_POST["pejabat_penetapan"] . "', null,
            '0', '1')";
    mysql_query($sql);
    update_pangkat_pegawai($_SESSION["simpeg_id_pegawai"]);
    header("location:../../?mod=riwayat_pangkat");
?>