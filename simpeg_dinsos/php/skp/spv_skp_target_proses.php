<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $status_supervisi = 0;
    if(isset($_POST["terima"]))
        $status_supervisi = 3;
    else if(isset($_POST["tolak"]))
        $status_supervisi = 2;
    mysql_query("INSERT INTO tbl_skp_catatan VALUES(null, '" . $_POST["id_skp"] . "', '" . $_SESSION["simpeg_id_pegawai"] . "', '" . $_POST["id_tujuan"] . "', '" . $_POST["catatan"] . "')");
    mysql_query("UPDATE tbl_skp SET status_supervisi='" . $status_supervisi . "' WHERE id_skp='" . $_POST["id_skp"] . "'");
    header("location:../../?mod=spv_skp_target");
?>