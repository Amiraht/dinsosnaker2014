<?php
    session_start();
    include("koneksi.php");
    $_SESSION["simpeg_id_pegawai"] = $_GET["id"];
    header("location:../?mod=" . $_GET["mod"]);
?>