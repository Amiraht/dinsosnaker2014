<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $sql = "UPDATE tbl_riwayat_pangkat SET
                id_pangkat='" . $_POST["id_pangkat"] . "',
                tmt='" . $_POST["tmt"] . "',
                no_sk='" . $_POST["no_sk"] . "',
                tgl_sk='" . $_POST["tgl_sk"] . "',
                pejabat_penetapan='" . $_POST["pejabat_penetapan"] . "',
                status_supervisi='1'
            WHERE MD5(id_riwayat_pangkat)='" . $_POST["id_riwayat_pangkat"] . "'";
    mysql_query($sql);
    update_pangkat_pegawai($_SESSION["simpeg_id_pegawai"]);
    header("location:../../?mod=riwayat_pangkat");
?>