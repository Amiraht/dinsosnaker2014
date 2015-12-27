<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    mysql_query("DELETE FROM tbl_skp_dp3 WHERE id_skp='" . $_POST["id_skp"] . "'");
    $sql = "INSERT INTO tbl_skp_dp3 VALUES('" . $_POST["id_skp"] . "', '" . $_POST["keberatan"] . "', '" . $_POST["tanggapan"] . "', '" . $_POST["keputusan"] . "')";
    mysql_query($sql);
    header("location:../../?mod=info&pesan=7&redir=dp3_pilih_periode");
?>