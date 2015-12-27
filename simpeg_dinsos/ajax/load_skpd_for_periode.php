<?php header("Content-type: text/xml"); ?>
<?php
    session_start();
    include("../php/koneksi.php");
    include("../php/fungsi.php");
    
    if($_SESSION["simpeg_id_level"] == 3)
        $res_cb = mysql_query("SELECT * FROM ref_skpd WHERE kode_skpd='" . $_SESSION["simpeg_kode_skpd"] . "' ORDER BY skpd ASC");
    else
        $res_cb = mysql_query("SELECT * FROM ref_skpd ORDER BY skpd ASC");
    
    echo("<skpd>\n");
        echo("<member>\n");
            echo("<kode>ABC</kode>\n");
            echo("<name>:::: Pilih SKPD atau Unit Kerja ::::</name>\n");
        echo("</member>\n");
    while($ds_cb = mysql_fetch_array($res_cb)){
        //echo("<option value='" . $ds_cb["kode_skpd"] . "'>" . $ds_cb["skpd"] . "</option>\n");
        echo("<member>\n");
            echo("<kode>" . $ds_cb["kode_skpd"] . "</kode>\n");
            echo("<name>" . str_replace("&", "dan", $ds_cb["skpd"]) . "</name>\n");
        echo("</member>\n");
    }
    echo("</skpd>");
?>