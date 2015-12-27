<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $status_supervisi = 0;
    $keberatan = "";
    if($_POST["stt"] == 1){
        $status_supervisi = 4;
        $keberatan = "";
    }
    else if($_POST["stt"] == 2){
        $status_supervisi = 2;
        $keberatan = $_POST["keberatan"];
    }
    mysql_query("UPDATE tbl_skp_perilaku SET keberatan='" . $keberatan . "', status_supervisi='" . $status_supervisi . "' WHERE id_skp_perilaku='" . $_POST["id_skp"] . "'");
    //echo("UPDATE tbl_skp_perilaku SET keberatan='" . $keberatan . "', status_supervisi='" . $status_supervisi . "' WHERE id_skp_perilaku='" . $_POST["id_skp"] . "'");
        
    mysql_query($sql);
    header("location:../../?mod=perilaku_lihat&id_skp=" . $_POST["id_skp"]);
?>