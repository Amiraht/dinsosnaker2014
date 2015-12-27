<?php
    session_start();
    include("../php/koneksi.php");
    $res = mysql_query("SELECT * FROM ref_kabupaten WHERE id_provinsi='" . $_GET["id"] . "' ORDER BY kabupaten ASC");
    echo("<option value='0'>:: Kabupaten ::</option>");
    while($ds = mysql_fetch_array($res)){
        echo("<option value='" . $ds["id_kabupaten"] . "'>" . $ds["kabupaten"] . "</option>");
    }
?>