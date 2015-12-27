<?php
    include("koneksi.php");
    $sql = "DELETE FROM myapp_maintable_suratkeluar WHERE id='" . $_GET["id"] . "'";
    mysql_query($sql);
    //echo($sql);
    header("location:../?mod=inform&pesan=13&redir=manajemen_surat_keluar_1");
?>