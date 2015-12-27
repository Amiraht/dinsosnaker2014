<?php
    session_start();
    include("../php/koneksi.php");
    $res = mysql_query("SELECT * FROM ref_kelurahan WHERE id_kecamatan='" . $_GET["id"] . "' ORDER BY kelurahan ASC");
    echo("<option value='0'>:: Kelurahan ::</option>");
    while($ds = mysql_fetch_array($res)){
        echo("<option value='" . $ds["id_kelurahan"] . "'>" . $ds["kelurahan"] . "</option>");
    }
?>