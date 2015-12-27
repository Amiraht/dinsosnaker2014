<?php
    include("koneksi.php");
    $sql = "DELETE FROM myapp_maintable_suratmasuk WHERE id='" . $_GET["id"] . "'";
    mysql_query($sql);
    //echo($sql);
    header("location:../?mod=inform&pesan=2&redir=cp_manage_sm");
?>