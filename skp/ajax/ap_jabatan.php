<?php
    session_start();
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    $id_eselon = $_GET["id_eselon"];
    if($_GET["id_tipe_jabatan"] != 1){
        $id_eselon = 0;
    }
    mysql_query("INSERT INTO ref_jabatan VALUES(null, '" . $_GET["id_skpd"] . "', '" . $_GET["id_tipe_jabatan"] . "', '" . $id_eselon . "', '" . $_GET["jabatan"] . "')");
?>