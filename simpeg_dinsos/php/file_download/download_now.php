<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $ds_file = mysql_fetch_array(mysql_query("SELECT ekstensi FROM tbl_file_download WHERE MD5(id_file)='" . $_GET["id_file"] . "'"));
    header("Content-type: application/" . $ds_file["header_type"]);
    echo($ds_file["data"]);
?>