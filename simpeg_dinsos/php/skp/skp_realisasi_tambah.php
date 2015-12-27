<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    if($_POST["id_uraian_realisasi_skp"] == 0){
        $sql = "INSERT INTO tbl_uraian_realisasi_skp VALUES(null, '" . $_POST["id_uraian_skp"] . "', '" . $_POST["ak"] . "', '" . $_POST["kuantitas"] . "',
                '" . $_POST["kualitas"] . "', '" . $_POST["waktu"] . "', '" . $_POST["biaya"] . "', 1)";
    }else{
        $sql = "UPDATE tbl_uraian_realisasi_skp SET
                    kuantitas='" . $_POST["kuantitas"] . "',
                    kualitas='" . $_POST["kualitas"] . "',
                    waktu='" . $_POST["waktu"] . "',
                    biaya='" . $_POST["biaya"] . "',
                    status_supervisi=1
                WHERE id_uraian_realisasi_skp='" . $_POST["id_uraian_realisasi_skp"] . "'";
        // UBAH JUGA JADI 1 YANG 2
        mysql_query("UPDATE tbl_uraian_realisasi_skp SET status_supervisi=1 WHERE status_supervisi=2");
    }
    mysql_query($sql);
    //echo($sql);
    header("location:../../?mod=skp_realisasi&id_skp=" . $_POST["id_skp"] . "&id_uraian_skp=" . $_POST["id_uraian_skp"]);
?>