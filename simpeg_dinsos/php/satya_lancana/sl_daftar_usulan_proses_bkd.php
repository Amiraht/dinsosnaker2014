<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/usulan_satya_lancana_model.php");
    
    $obj = new UsulanSatyaLancana_Model();
    $obj->Record($_GET["id_usulan"]);
    $obj->status = 2;
    $obj->Update();
    
    header("location:../../?mod=sl_daftar_usulan");
        
    //echo("Data usulan telah disimpan");
?>