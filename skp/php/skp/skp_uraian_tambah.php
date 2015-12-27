<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    if($_POST["id_uraian_skp"] == 0){
        $sql = "INSERT INTO tbl_uraian_skp VALUES(null, '" . $_POST["id_skp"] . "', '" . $_POST["kegiatan"] . "', '" . $_POST["ak"] . "', '" . $_POST["kuantitas"] . "',
                '" . $_POST["satuan_kuantitas"] . "', '" . $_POST["kualitas"] . "', '" . $_POST["waktu"] . "', '" . $_POST["id_satuan_waktu"] . "', '" . $_POST["biaya"] . "')";
    }else{
        $sql = "UPDATE tbl_uraian_skp SET
                    kegiatan='" . $_POST["kegiatan"] . "',
                    ak='" . $_POST["ak"] . "',
                    kuantitas='" . $_POST["kuantitas"] . "',
                    satuan_kuantitas='" . $_POST["satuan_kuantitas"] . "',
                    kualitas='" . $_POST["kualitas"] . "',
                    waktu='" . $_POST["waktu"] . "',
                    id_satuan_waktu='" . $_POST["id_satuan_waktu"] . "',
                    biaya='" . $_POST["biaya"] . "'
                WHERE id_uraian_skp='" . $_POST["id_uraian_skp"] . "'";
    }
    mysql_query("UPDATE tbl_skp SET status_supervisi=1 WHERE id_skp='" . $_POST["id_skp"] . "' AND status_supervisi <> 3");
    mysql_query($sql);
    $rat = "";
    if(isset($_POST["rat"]))
        $rat = "&rat=1";
    header("location:../../?mod=skp_uraian&id=" . $_POST["id_skp"] . "&id_uraian_skp=" . $_POST["id_uraian_skp"] . $rat);
?>