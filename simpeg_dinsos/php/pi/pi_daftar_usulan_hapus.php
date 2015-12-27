<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/usulan_pi_model.php");
    
    $obj = new UsulanPI_Model();
    $obj->Record($_GET["id_usulan"]);
    $obj->Delete();
    
    header("location:../../?mod=pi_daftar_usulan");
        
    //echo("Data usulan telah disimpan");
?>