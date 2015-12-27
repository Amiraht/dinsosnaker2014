<?php
    session_start();
    include("koneksi.php");
	include("fungsi.php");
    /*$sql = "INSERT INTO myapp_maintable_suratmasuk (id, no_surat, tgl_surat, tgl_terima, perihal_surat, pengirim_surat, alamat_pengirim, judul_surat, deskripsi_surat, catatan, id_skpd_pengirim, id_masalah, id_jenis_surat, harus_selesai, indeks, kode, status, asal_disposisi, tujuan_disposisi) VALUES 
            (NULL, '$_POST[no_surat]', '$_POST[tgl_surat]', '$_POST[tgl_terima]', '$_POST[perihal_surat]', '$_POST[pengirim_surat]', '$_POST[alamat_pengirim]', '$_POST[judul_surat]', '$_POST[deskripsi_surat]', '$_POST[catatan]', '$_POST[id_skpd_pengirim]', '$_POST[id_masalah]', '$_POST[id_jenis_surat]', '$_POST[harus_selesai]', '$_POST[indeks]', '$_POST[kode]', 1, 0, 0)";*/
    $sql = "UPDATE myapp_maintable_suratkeluar SET
                tgl_surat           = '".anti_injection($_POST['tgl_surat'])."',
                perihal_surat       = '".anti_injection($_POST['perihal_surat'])."',
                tujuan_surat        = '".anti_injection($_POST['tujuan_surat'])."',
                alamat_tujuan       = '".anti_injection($_POST['alamat_tujuan'])."',
                judul_surat         = '".anti_injection($_POST['judul_surat'])."',
                deskripsi_surat     = '".anti_injection($_POST['deskripsi_surat'])."',
                catatan             = '".anti_injection($_POST['catatan'])."',
                id_skpd_tujuan      = '".anti_injection($_POST['id_skpd_tujuan'])."',
                id_masalah          = '".anti_injection($_POST['id_masalah'])."',
                id_jenis_surat      = '".anti_injection($_POST['id_jenis_surat'])."',
                id_ttd              = '".anti_injection($_POST['id_ttd'])."'
            WHERE id = '".anti_injection($_POST['id'])."'";
    mysql_query($sql);
    //echo($sql);
    header("location:../?mod=inform&pesan=14&redir=manajemen_surat_keluar_1");
?>