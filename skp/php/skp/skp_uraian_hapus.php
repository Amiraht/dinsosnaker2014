<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    mysql_query("DELETE FROM tbl_uraian_skp WHERE id_uraian_skp='" . $_GET["id_uraian_skp"] . "'");
    mysql_query("DELETE FROM tbl_uraian_realisasi_skp WHERE id_uraian_skp='" . $_GET["id_uraian_skp"] . "'");
    $rat = "";
    if(isset($_GET["rat"]))
        $rat = "&rat=1";
    header("location:../../?mod=skp_uraian&id=" . $_GET["id_skp"] . $rat);
?>