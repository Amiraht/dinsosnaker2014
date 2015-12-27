<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    if($_POST["id_berita_informasi"] == 0)
        $sql = "INSERT INTO tbl_berita_informasi VALUES(null, '" . $_POST["judul"] . "', '" . $_POST["intro"] . "', '" . $_POST["isi"] . "', CURDATE())";
    else
        $sql = "UPDATE tbl_berita_informasi SET judul='" . $_POST["judul"] . "', intro='" . $_POST["intro"] . "', isi='" . $_POST["isi"] . "' WHERE id_berita_informasi='" . $_POST["id_berita_informasi"] . "'";
    mysql_query($sql);
    header("location:../../?mod=berita_dan_informasi_adm");
?>