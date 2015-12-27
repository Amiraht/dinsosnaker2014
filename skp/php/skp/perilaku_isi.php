<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $sql = "UPDATE tbl_skp_perilaku SET
                orientasi_pelayanan='" . $_POST["orientasi_pelayanan"] . "',
                integritas='" . $_POST["integritas"] . "',
                komitmen='" . $_POST["komitmen"] . "',
                disiplin='" . $_POST["disiplin"] . "',
                kerja_sama='" . $_POST["kerja_sama"] . "',
                kepemimpinan='" . $_POST["kepemimpinan"] . "',
                status_supervisi='1'
            WHERE id_skp_perilaku='" . $_POST["id_skp"] . "'";
    //echo($sql);
    mysql_query($sql);
    header("location:../../?mod=info&pesan=5&redir=perilaku_isi_pilih_bawahan");
?>