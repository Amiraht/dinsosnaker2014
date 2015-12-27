<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    require_once("../model/ijin_cerai_model.php");
    
    $obj = new IjinCerai_Model();
    $obj->Record($_GET["id_cerai"]);
    $obj->status = 3;
    $obj->Update();
    header("location:../../?mod=cerai_sk");
    //echo("Data telah disimpan");
?>