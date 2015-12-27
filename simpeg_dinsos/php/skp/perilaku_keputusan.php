<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $status_supervisi = 4;
    
    mysql_query("UPDATE tbl_skp_perilaku SET keputusan='" . $_POST["keputusan"] . "', status_supervisi='" . $status_supervisi . "' WHERE id_skp='" . $_POST["id_skp"] . "'");
    //echo("UPDATE tbl_skp_perilaku SET keberatan='" . $keberatan . "', status_supervisi='" . $status_supervisi . "' WHERE id_skp='" . $_POST["id_skp"] . "'");
        
    mysql_query($sql);
    header("location:../../?mod=perilaku_keputusan&id_skp=" . $_POST["id_skp"] . "&id_pegawai=" . $_POST["id_pegawai"]);
?>