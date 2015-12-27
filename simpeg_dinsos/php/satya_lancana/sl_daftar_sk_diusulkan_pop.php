<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $id_usulan = $_GET["id_usulan"];
    $id_detail_satya_lencana = $_GET["id_detail_satya_lencana"];
    
    $sql = "UPDATE tbl_usulan_satya_lancana_detail SET id_sk=null, status='1' WHERE id_detail_satya_lencana='" . $id_detail_satya_lencana . "'";
    mysql_query($sql);
    
    header("location:../../?mod=sl_daftar_sk_diusulkan&id_usulan=" . $id_usulan);
        
    //echo("Data usulan telah disimpan");
?>