<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $id_usulan = $_GET["id_usulan"];
    $id_detail_gaji_berkala = $_GET["id_detail_gaji_berkala"];
    
    $sql = "DELETE FROM tbl_usulan_gaji_berkala_detail WHERE id_detail_gaji_berkala='" . $_GET["id_detail_gaji_berkala"] . "'";
    mysql_query($sql);
    
    header("location:../../?mod=gb_daftar_usulan_diusulkan&id_usulan=" . $id_usulan);
        
    //echo("Data usulan telah disimpan");
?>