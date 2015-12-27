<?php
    session_start();
    include("koneksi.php");
    $sql = "DELETE FROM tbl_pegawai WHERE id_pegawai='" . $_GET["id_pegawai"] . "'";
    //echo($sql);
    mysql_query($sql);
    
    // DELETE AKUN USER UNTUK PEGAWAI INI
    mysql_query("DELETE FROM tbl_pengguna WHERE id_pegawai='" . $_GET["id_pegawai"] . "'");
    
    header("location:../?mod=info&pesan=9&redir=data_pegawai");
?>