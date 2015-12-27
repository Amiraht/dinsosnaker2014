<?php
    session_start();
    include("../php/koneksi.php");
    mysql_query("INSERT INTO tbl_skp_dp3_upload_pemeriksaan VALUES('" . $_POST["id_skp"] . "', '" . $_SESSION["simpeg_id_pengguna"] . "', CURRENT_TIMESTAMP())");
?>