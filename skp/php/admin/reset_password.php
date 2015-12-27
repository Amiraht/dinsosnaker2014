<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    mysql_query("UPDATE tbl_pengguna a SET a.password = '1234' WHERE a.id_pegawai = '" . $_GET["id_pegawai"] . "'");
    header("location:../../?mod=info&pesan=8&redir=reset_password_adm");
?>