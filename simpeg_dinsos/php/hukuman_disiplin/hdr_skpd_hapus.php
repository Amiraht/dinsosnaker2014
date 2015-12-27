<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    include("../model/usulan_hukuman_disiplin_model.php");

    $obj = new UsulanHukumanDisiplin();
    $obj->Delete($_GET["id_usulan"]);
    
    header("location:../../?mod=hdr_skpd_daftar");
?>
