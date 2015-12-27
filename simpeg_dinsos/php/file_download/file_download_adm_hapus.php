<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    mysql_query("DELETE FROM tbl_file_download
                 WHERE MD5(id_file)='" . $_GET["id_file"] . "'");
    header("location:../../?mod=file_download_adm&tipe_fd=" . $_GET["tipe_fd"]);
?>