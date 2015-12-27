<?php
    session_start();
    include("koneksi.php");
    $ds_cari_kk = mysql_fetch_array(mysql_query("SELECT * FROM ref_masalah WHERE id_masalah='" . $_POST["id_masalah"] . "'"));
    mysql_query("UPDATE tbl_benda_arsip SET
                    kode_klasifikasi = '" . $ds_cari_kk["kode_masalah"] . "',
                    uraian = '" . $_POST["uraian"] . "',
                    tahun = '" . $_POST["tahun"] . "',
                    sampul = '" . $_POST["sampul"] . "',
                    box = '" . $_POST["box"] . "',
                    rak = '" . $_POST["rak"] . "',
                    keterangan = '" . $_POST["keterangan"] . "',
                    keadaan = '" . $_POST["keadaan"] . "',
                    id_masalah = '" . $_POST["id_masalah"] . "'
                 WHERE id_arsip='" . $_POST["id"] . "'");
    header("location:../?mod=info&pesan=5&redir=data_arsip");
?>