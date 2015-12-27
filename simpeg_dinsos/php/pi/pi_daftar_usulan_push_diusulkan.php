<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $id_usulan = $_POST["id_usulan"];
    $id_pegawai = detail_pegawai_by_nip($_POST["nip"], "id_pegawai");
    $sql = "INSERT INTO tbl_usulan_pi_detail(id_usulan, id_pegawai, status) VALUES('" . $id_usulan . "', '" . $id_pegawai . "', 1)";
    mysql_query($sql);
    
    header("location:../../?mod=pi_daftar_usulan_diusulkan&id_usulan=" . $id_usulan);
        
    //echo("Data usulan telah disimpan");
?>