<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/ijin_cerai_model.php");
    
    $obj = new IjinCerai_Model();
    $obj->Record($_GET["id_cerai"]);
    $obj->Delete();
    header("location:../../?mod=cerai_daftar_usulan");
    //echo("Data telah disimpan");
?>