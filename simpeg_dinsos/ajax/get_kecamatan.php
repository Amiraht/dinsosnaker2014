<?php
    session_start();
    include("../php/koneksi.php");
    $res = mysql_query("SELECT * FROM ref_kecamatan WHERE id_kabupaten='" . $_GET["id"] . "' ORDER BY kecamatan ASC");
    echo("<option value='0'>:: Kecamatan ::</option>");
    while($ds = mysql_fetch_array($res)){
        echo("<option value='" . $ds["id_kecamatan"] . "'>" . $ds["kecamatan"] . "</option>");
    }
?>