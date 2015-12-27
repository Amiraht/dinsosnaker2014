<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/usulan_gaji_berkala_model.php");
    
    $obj = new UsulanGajiBerkala_Model();
    $obj->Record($_GET["id_usulan"]);
    $obj->status = 2;
    $obj->Update();
    
    header("location:../../?mod=gb_daftar_usulan");
        
    //echo("Data usulan telah disimpan");
?>