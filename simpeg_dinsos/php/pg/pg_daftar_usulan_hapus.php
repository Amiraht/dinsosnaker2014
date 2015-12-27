<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/usulan_pg_model.php");
    
    $obj = new UsulanPG_Model();
    $obj->Record($_GET["id_usulan"]);
    $obj->Delete();
    
    header("location:../../?mod=pg_daftar_usulan");
        
    //echo("Data usulan telah disimpan");
?>