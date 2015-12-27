<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    mysql_query("DELETE FROM tbl_skp_perilaku WHERE id_skp='" . $_POST["id_skp"] . "'");
    $sql = "INSERT INTO tbl_skp_perilaku VALUES('" . $_POST["id_skp"] . "', '" . $_POST["orientasi_pelayanan"] . "', '" . $_POST["integritas"] . "',
            '" . $_POST["komitmen"] . "', '" . $_POST["disiplin"] . "', '" . $_POST["kerja_sama"] . "', '" . $_POST["kepemimpinan"] . "', '', '', '', 1)";
    //echo($sql);
    mysql_query($sql);
    header("location:../../?mod=info&pesan=5&redir=perilaku_isi_pilih_bawahan");
?>