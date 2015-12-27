<?php
    include("koneksi.php");
    mysql_query("DELETE FROM myapp_filetable_suratmasuk WHERE id='" . $_GET["id"] . "'");
    header("location:../?mod=file_surat_masuk&id=" . $_GET["id_surat_masuk"] . "&redir=" . $_GET["redir"]);
?>