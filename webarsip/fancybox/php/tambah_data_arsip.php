<?php
    session_start();
    include("koneksi.php");
    $ds_cari_kk = mysql_fetch_array(mysql_query("SELECT * FROM ref_masalah WHERE id_masalah='" . $_POST["id_masalah"] . "'"));
    mysql_query("INSERT INTO tbl_benda_arsip VALUES(
                null, '0', '" . $ds_cari_kk["kode_masalah"] . "', '" . $_SESSION["kode_instansi"] . "', '', '" . $_POST["uraian"] . "', '" . $_POST["tahun"] . "', '" . $_SESSION["id_unit_kerja"] . "', '" . $_POST["sampul"] . "', '" . $_POST["box"] . "', '" . $_POST["rak"] . "', '1', '" . $_POST["keterangan"] . "', '" . $_POST["keadaan"] . "', '7', '" . $_POST["id_masalah"] . "', CURDATE(), '0'
                )");
    header("location:../?mod=info&pesan=1&redir=data_arsip");
?>