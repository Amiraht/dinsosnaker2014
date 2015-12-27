<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $status_supervisi = 0;
    if($_POST["terima"] == 1){
        $status_supervisi = 3;
        
        // JIKA DITERIMA, MAKA MASUKKAN DAFTAR KEGIATAN NYA INI KEDALAM
        // KEGIATAN YANG SUDAH FIX
        mysql_query("DELETE FROM tbl_uraian_skp_fix WHERE id_skp='" . $_POST["id_skp"] . "'");
        mysql_query("INSERT INTO tbl_uraian_skp_fix
                        SELECT 
                            id_uraian_skp, id_skp, kegiatan, ak, kuantitas, satuan_kuantitas, kualitas, waktu, id_satuan_waktu, biaya 
                        FROM 
                            tbl_uraian_skp 
                        WHERE 
                            id_skp = '" . $_POST["id_skp"] . "'");
        // ************************************************************
    }
    else if($_POST["terima"] == 0){
        $status_supervisi = 2;
        mysql_query("INSERT INTO tbl_skp_catatan VALUES(null, '" . $_POST["id_skp"] . "', '" . $_SESSION["simpeg_id_pegawai"] . "', '" . $_POST["id_tujuan"] . "', '" . $_POST["catatan"] . "')");
    }
    mysql_query("UPDATE tbl_skp SET status_supervisi='" . $status_supervisi . "' WHERE id_skp='" . $_POST["id_skp"] . "'");
    header("location:../../?mod=spv_skp_target");
?>