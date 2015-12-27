<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    mysql_query("UPDATE myapp_maintable_suratkeluar SET no_surat='" . $_POST["kode_surat"] . "/" . $_POST["no_surat"] . "', tgl_surat=CURDATE() WHERE id='" . $_POST["id_surat_keluar"] . "'");
    header("location:../?mod=inform&pesan=37&redir=pengiriman_surat");
?>