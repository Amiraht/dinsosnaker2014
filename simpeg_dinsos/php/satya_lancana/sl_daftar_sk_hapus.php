<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/sk_satya_lancana_model.php");
    
    $obj = new SKSatyaLancana_Model();
    $obj->Record($_GET["id_usulan"]);
    $obj->Delete();
    
    $sql = "UPDATE tbl_usulan_satya_lancana_detail SET id_sk=null, status='1' WHERE id_sk='" . $_GET["id_usulan"] . "'";
    mysql_query($sql);
    
    header("location:../../?mod=sl_daftar_sk");
        
    //echo("Data usulan telah disimpan");
?>