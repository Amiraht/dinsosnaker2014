<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $id_usulan = $_GET["id_usulan"];
    $id_detail = $_GET["id_detail"];
    
    $sql = "DELETE FROM tbl_usulan_pi_detail WHERE id_pi_detali='" . $_GET["id_detail"] . "'";
    mysql_query($sql);
    
    header("location:../../?mod=pi_daftar_usulan_diusulkan&id_usulan=" . $id_usulan);
        
    //echo("Data usulan telah disimpan");
?>