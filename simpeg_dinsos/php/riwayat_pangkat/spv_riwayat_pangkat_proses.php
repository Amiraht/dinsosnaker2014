<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    if($_POST["status_supervisi"] == 2){
        mysql_query("INSERT INTO catatan_riwayat_pangkat VALUES(null, '" . $_POST["id_riwayat_pangkat"] . "', '" . $_POST["catatan"] . "', CURDATE())");
	}

	
    $sql = "UPDATE tbl_riwayat_pangkat SET
                status ='" . $_POST["status_supervisi"] . "'
            WHERE id_data='" . $_POST["id_riwayat_pangkat"] . "'";
    mysql_query($sql);
    update_pangkat_pegawai($_SESSION["simpeg_id_pegawai"]);
    header("location:../../?mod=spv_riwayat_pangkat");
?>