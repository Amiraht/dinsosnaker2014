<?php
    session_start();
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    $res = mysql_query("SELECT * FROM ref_jabatan WHERE id_skpd='" . $_GET["id_skpd"] . "' AND id_tipe_jabatan='" . $_GET["id_tipe_jabatan"] . "' ORDER BY jabatan ASC");
    while($ds = mysql_fetch_array($res)){
        echo("<option value='" . $ds["id_jabatan"] . "'>" . $ds["jabatan"] . "</option>");
    }
?>