<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    if($_POST["status_supervisi"] == 2)
        mysql_query("INSERT INTO catatan_riwayat_jabatan VALUES(null, '" . $_POST["id_riwayat_jabatan"] . "', '" . $_POST["catatan"] . "', CURDATE())");
    $sql = "UPDATE tbl_riwayat_jabatan SET
                status_supervisi='" . $_POST["status_supervisi"] . "'
            WHERE id_riwayat_jabatan='" . $_POST["id_riwayat_jabatan"] . "'";
    mysql_query($sql);
    header("location:../../?mod=spv_riwayat_jabatan");
?>