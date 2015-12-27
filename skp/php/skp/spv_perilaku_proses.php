<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $stt = 0;
    if(isset($_POST["terima"]))
        $stt = 3;
    else if(isset($_POST["tolak"]))
        $stt = 2;
    mysql_query("UPDATE tbl_skp_perilaku SET status_supervisi='" . $stt . "' WHERE id_skp='" . $_POST["id_skp"] . "'");
    mysql_query("INSERT INTO tbl_skp_perilaku_catatan VALUES(null, '" . $_POST["id_skp"] . "', '" . $_SESSION["simpeg_id_pegawai"] . "', '" . $_POST["id_tujuan"] . "', '" . $_POST["catatan"] . "')");
    
    header("location:../../?mod=spv_perilaku");
?>