<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    include("../model/usulan_hukuman_disiplin_model.php");

    $obj = new UsulanHukumanDisiplin();
    $obj->Record($_GET["id_usulan"]);
    $obj->status = 3;
    $obj->Update();
    
    header("location:../../?mod=hdr_kesdip_daftar");
?>
