<?php
    session_start();
    include("koneksi.php");
    // cari apakah sudah pernah melakukan permohonan
    $sql_permohonan = "";
    $res_permohonan = mysql_query("SELECT * FROM tbl_usulan_perpanjangan_digital WHERE id_peminjaman='" . $_POST["id_peminjaman"] . "'");
    if(mysql_num_rows($res_permohonan) > 0)
        $sql_permohonan = "UPDATE tbl_usulan_perpanjangan_digital SET status=0 WHERE id_peminjaman='" . $_POST["id_peminjaman"] . "'";
    else
        $sql_permohonan = "INSERT INTO tbl_usulan_perpanjangan_digital VALUES(null, '" . $_POST["id_peminjaman"] . "', '0')";
    mysql_query($sql_permohonan);
    header("location:../?mod=info&pesan=7&redir=perpanjangan_peminjaman");
?>