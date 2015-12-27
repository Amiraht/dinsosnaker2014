<?php
    session_start();
    include("koneksi.php");
    unset($_SESSION["simpeg_id_pegawai"]);
    header("location:../?mod=" . $_GET["mod"]);
?>