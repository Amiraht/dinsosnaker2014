<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $no_usulan = $_GET["no_usulan"];
    $sql = "UPDATE tbl_usulan_cuti SET diproses='0' WHERE no_usulan='" . $no_usulan . "'";
    mysql_query($sql);
    
    header("location:../../?mod=cuti_daftar_usulan");
?>