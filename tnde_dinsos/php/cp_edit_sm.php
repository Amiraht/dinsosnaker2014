<?php
    session_start();
    include("koneksi.php");
    /*$sql = "INSERT INTO myapp_maintable_suratmasuk (id, no_surat, tgl_surat, tgl_terima, perihal_surat, pengirim_surat, alamat_pengirim, judul_surat, deskripsi_surat, catatan, id_skpd_pengirim, id_masalah, id_jenis_surat, harus_selesai, indeks, kode, status, asal_disposisi, tujuan_disposisi) VALUES 
            (NULL, '$_POST[no_surat]', '$_POST[tgl_surat]', '$_POST[tgl_terima]', '$_POST[perihal_surat]', '$_POST[pengirim_surat]', '$_POST[alamat_pengirim]', '$_POST[judul_surat]', '$_POST[deskripsi_surat]', '$_POST[catatan]', '$_POST[id_skpd_pengirim]', '$_POST[id_masalah]', '$_POST[id_jenis_surat]', '$_POST[harus_selesai]', '$_POST[indeks]', '$_POST[kode]', 1, 0, 0)";*/
    $sql = "UPDATE myapp_maintable_suratmasuk SET
                no_surat            = '$_POST[no_surat]',
                tgl_surat           = '$_POST[tgl_surat]',
                tgl_terima          = '$_POST[tgl_terima]',
                perihal_surat       = '$_POST[perihal_surat]',
                pengirim_surat      = '$_POST[pengirim_surat]',
                alamat_pengirim     = '$_POST[alamat_pengirim]',
                judul_surat         = '$_POST[judul_surat]',
                deskripsi_surat     = '$_POST[deskripsi_surat]',
                catatan             = '$_POST[catatan]',
                id_skpd_pengirim    = '$_POST[id_skpd_pengirim]',
                id_masalah          = '$_POST[id_masalah]',
                id_jenis_surat      = '$_POST[id_jenis_surat]',
                harus_selesai       = '$_POST[harus_selesai]',
                indeks              = '$_POST[indeks]',
                kode                = '$_POST[kode]'
            WHERE id='$_POST[id]'";
    mysql_query($sql);
    //echo($sql);
    header("location:../?mod=inform&pesan=3&redir=cp_manage_sm");
?>