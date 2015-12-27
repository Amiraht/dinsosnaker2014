<?php
    session_start();
    include("koneksi.php");
	include("fungsi.php");
    $_SESSION["simpeg_id_pegawai"] = $_GET["id"];
	$_SESSION["nip"] = detail_pegawai($_GET["id"], "nip");
    header("location:../?mod=" . $_GET["mod"]);
?>