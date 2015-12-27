<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $id_riwayat_cuti = $_GET["id_riwayat_cuti"];
    $ds_riwayat_cuti = mysql_fetch_array(mysql_query("SELECT * FROM tbl_riwayat_cuti WHERE id_riwayat_cuti='" . $id_riwayat_cuti . "'"));
    $id_surat = $ds_riwayat_cuti["id_surat"];
    $id_usulan = $ds_riwayat_cuti["id_usulan"];
    
    // BALIKKAN DULU FIELD DIPROSES PADA RIWAYAT USULAN NYA JADI 1
    mysql_query("UPDATE tbl_usulan_cuti SET diproses=0 WHERE id_usulan='" . $id_usulan . "'");
    
    // HAPUS DARI DATA RIWAYAT CUTI
    mysql_query("DELETE FROM tbl_riwayat_cuti WHERE id_riwayat_cuti='" . $id_riwayat_cuti . "'");
    
    // REDIRECT KE HALAMAN SEBELUMNYA
    header("location:../../?mod=cuti_sk_daftar_pegawai&id_surat=" . $id_surat);
?>
