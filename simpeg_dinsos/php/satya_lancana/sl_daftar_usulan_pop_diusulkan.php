<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $id_usulan = $_GET["id_usulan"];
    $id_detail_satya_lencana = $_GET["id_detail_satya_lencana"];
    
    $sql = "DELETE FROM tbl_usulan_satya_lancana_detail WHERE id_detail_satya_lencana='" . $_GET["id_detail_satya_lencana"] . "'";
    mysql_query($sql);
    
    header("location:../../?mod=sl_daftar_usulan_diusulkan&id_usulan=" . $id_usulan);
        
    //echo("Data usulan telah disimpan");
?>