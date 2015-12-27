<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $id_usulan = $_GET["id_usulan"];
    $id_detail_gaji_berkala = $_GET["id_detail"];
    
    $sql = "DELETE FROM tbl_usulan_pg_detail WHERE id_usulan_pg_detail='" . $_GET["id_detail"] . "'";
    mysql_query($sql);
    
    header("location:../../?mod=pg_daftar_usulan_diusulkan&id_usulan=" . $id_usulan);
        
    //echo("Data usulan telah disimpan");
?>