<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/sk_gaji_berkala_model.php");
    
    $obj = new SKGajiBerkala_Model();
    $obj->Record($_GET["id_sk"]);
    $obj->Delete();
    
    $sql = "UPDATE tbl_usulan_gaji_berkala_detail SET id_sk=null, status='1' WHERE id_sk='" . $_GET["id_sk"] . "'";
    mysql_query($sql);
    
    header("location:../../?mod=gb_daftar_sk");
        
    //echo("Data usulan telah disimpan");
?>