<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $sttspv = 1;
    if($_SESSION["simpeg_id_level"] == 12)
        $sttspv = 3;
    $sql = "UPDATE tbl_riwayat_pangkat SET
                id_pangkat='" . $_POST["id_pangkat"] . "',
                tmt='" . $_POST["tmt"] . "',
                no_sk='" . $_POST["no_sk"] . "',
                tgl_sk='" . $_POST["tgl_sk"] . "',
                pejabat_penetapan='" . $_POST["pejabat_penetapan"] . "',
                status_supervisi='" . $sttspv . "'
            WHERE MD5(id_data)='" . $_POST["id_riwayat_pangkat"] . "'";
    mysql_query($sql);
    update_pangkat_pegawai($_SESSION["simpeg_id_pegawai"]);
    header("location:../../?mod=riwayat_pangkat");
?>