<?php
    session_start();
    include("../../../php/koneksi.php");
    include("../../../php/fungsi.php");
    
    $res = mysql_query("SELECT * FROM tbl_skp_dp3_upload WHERE id_skp='" . $_GET["id_skp"] . "'");
    if(mysql_num_rows($res) != 0){
        $ds = mysql_fetch_array($res);
        if($ds[$_GET["jenis"]] != ""){
            header("Content-type: application/pdf");
            echo($ds[$_GET["jenis"]]);
        }else{
            echo("<h3>Data belum diupload</h3>");
        }
        
    }else{
        echo("<h3>Data belum diupload</h3>");
    }
    
?>