<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $sql = "DELETE FROM tbl_skp_tugas_tambahan WHERE id_skp_tugas_tambahan='" . $_GET["id_skp_tugas_tambahan"] . "'";
	
	mysql_query($sql);
    // MENGUBAH SEMUA status_supervisi PENILAIAN MENJADI YANG DIPROSES
    mysql_query("UPDATE tbl_skp_tugas_tambahan SET status_supervisi='1' WHERE id_skp='" . $_POST["id_skp"] . "'");
    mysql_query("UPDATE tbl_skp_kreatifitas SET status_supervisi='1' WHERE id_skp='" . $_POST["id_skp"] . "'");
    header("location:../../?mod=tugtam_kreat_input&id_skp=" . $_GET["id_skp"] . "&id_pegawai=". $_GET["id_pegawai"]);

	
?>