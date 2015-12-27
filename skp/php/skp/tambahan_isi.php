<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    mysql_query("DELETE FROM tbl_skp_tambahan WHERE id_skp='" . $_POST["id_skp"] . "'");
    $sql = "INSERT INTO tbl_skp_tambahan VALUES('" . $_POST["id_skp"] . "', '" . $_POST["tugas_tambahan"] . "', '" . $_POST["kreatifitas"] . "')";
    mysql_query($sql);
    header("location:../../?mod=info&pesan=6&redir=perilaku_pilih_periode");
?>