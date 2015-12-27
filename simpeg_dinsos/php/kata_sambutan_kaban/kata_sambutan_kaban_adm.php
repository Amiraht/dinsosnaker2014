<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    mysql_query("TRUNCATE TABLE tbl_kata_sambutan_kaban");
    mysql_query("INSERT INTO tbl_kata_sambutan_kaban VALUES(null, '" . $_POST["isi"] . "')");
    header("location:../../?mod=kata_sambutan_kaban_adm&sukses=1");
?>