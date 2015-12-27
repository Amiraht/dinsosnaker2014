<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    $pesan = 0;
    selesaiDispSK($_POST["id_disposisi"]);
    
        //pushDispSK($_POST["id_surat_keluar"], $_SESSION["id_level"], 1, $_POST["catatan"], 1);
        mysql_query("UPDATE myapp_maintable_suratkeluar SET status=3, tgl_kirim=CURDATE() WHERE id='" . $_POST["id_surat_keluar"] . "'");
        header("location:../?mod=inform&pesan=41&redir=pengiriman_surat");
?>