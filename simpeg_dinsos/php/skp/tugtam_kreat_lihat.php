<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $status_supervisi = 0;
    if(isset($_POST["terima"])){
        $status_supervisi = 3;
        //mysql_query("INSERT INTO tbl_uraian_realisasi_skp_catatan VALUES(null, '" . $_POST["id_skp"] . "', '" . $_POST["bulan"] . "', '" . $_SESSION["simpeg_id_pegawai"] . "', '" . $_POST["id_tujuan"] . "', '" . $_POST["catatan"] . "')");
    }
    else if(isset($_POST["tolak"])){
        $status_supervisi = 2;
        mysql_query("INSERT INTO tbl_tugtam_kreat_catatan VALUES(null, '" . $_POST["id_skp"] . "', '" . $_SESSION["simpeg_id_pegawai"] . "', '0', '" . $_POST["catatan"] . "')");
    }
    // MENGUBAH SEMUA status_supervisi PENILAIAN MENJADI YANG DIPROSES
    mysql_query("UPDATE tbl_skp_tugas_tambahan SET status_supervisi='" . $status_supervisi . "' WHERE id_skp='" . $_POST["id_skp"] . "'");
    mysql_query("UPDATE tbl_skp_kreatifitas SET status_supervisi='" . $status_supervisi . "' WHERE id_skp='" . $_POST["id_skp"] . "'");
    header("location:../../?mod=tugtam_kreat_lihat_pilih_periode");
?>