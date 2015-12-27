<?php
    session_start();
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    $id_eselon = $_GET["id_eselon"];
    if($_GET["id_tipe_jabatan"] != 1){
        $id_eselon = 0;
    }
    // mengambil data kode SKP
    $ds_skpd = mysql_fetch_array(mysql_query("SELECT * FROM ref_skpd WHERE id_skpd = '" . $_GET["id_skpd"] . "'")); 
    mysql_query("INSERT INTO ref_jabatan VALUES(null, '" . $_GET["id_skpd"] . "', '" . $_GET["id_tipe_jabatan"] . "', '" . $id_eselon . "', '" . $_GET["jabatan"] . "', '', '" . $ds_skpd["kode_skpd"] . "')");
?>