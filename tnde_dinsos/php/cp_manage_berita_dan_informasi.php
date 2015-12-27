<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    if($_POST["id"] <> "")
        mysql_query("UPDATE myapp_nonlogintable_beritainformasi SET judul='" . $_POST["judul"] . "', deskripsi='" . $_POST["deskripsi"] . "', tanggal=CURDATE(), isi='" . $_POST["isi"] . "' WHERE id='" . $_POST["id"] . "'");
    else
        mysql_query("INSERT INTO myapp_nonlogintable_beritainformasi VALUES(null, '" . $_POST["judul"] . "', '" . $_POST["deskripsi"] . "', CURDATE(), '" . $_POST["isi"] . "')");
    
    header("location:../?mod=cp_berita_dan_informasi");
?>