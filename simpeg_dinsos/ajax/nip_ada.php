<?php
    session_start();
    include("../php/koneksi.php");
    $res = mysql_query("SELECT * FROM tbl_pegawai WHERE nip='" . $_GET["nip"] . "'");
    echo(mysql_num_rows($res));
?>