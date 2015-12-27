<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $sql = "DELETE FROM tbl_berita_informasi WHERE id_berita_informasi='" . $_GET["id_berita_informasi"] . "'";
    mysql_query($sql);
    header("location:../../?mod=berita_dan_informasi_adm");
?>