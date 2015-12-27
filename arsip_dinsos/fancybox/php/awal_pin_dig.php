<?php
    session_start();
    include("koneksi.php");
    
    // SIMPAN DULU
    mysql_query("INSERT INTO tbl_peminjaman_arsip VALUES
                (null, '" . $_SESSION["id_pengguna"] . "', '', '3', CURDATE(), DATE_ADD(CURDATE(),INTERVAL 3 DAY),
                 '', '', '0', 12)");
                 
    // BARU AMBIL ID PEMINJAMANNYA
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_peminjaman_arsip 
                                         WHERE id_jenis_peminjaman = 3 AND id_anggota = '" . $_SESSION["id_pengguna"] . "'
                                         ORDER BY id_peminjaman DESC LIMIT 0,1"));

    $_SESSION["id_pin_dig"] = $ds["id_peminjaman"];
    //echo("DELETE FROM tbl_peminjaman_arsip WHERE id_peminjaman='" . $_SESSION["id_pin_dig"] . "'");
    header("location:../?mod=permohonan_peminjaman_digital");
?>