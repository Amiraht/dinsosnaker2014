<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $id_usulan = $_POST["id_usulan"];
    $id_pegawai = detail_pegawai_by_nip($_POST["nip"], "id_pegawai");
    $jenis_satya = $_POST["jenis_satya"];
    $sql = "INSERT INTO tbl_usulan_satya_lancana_detail(id_usulan, id_pegawai, jenis_satya, status) VALUES('" . $id_usulan . "', '" . $id_pegawai . "', '" . $jenis_satya . "', 1)";
    mysql_query($sql);
    
    header("location:../../?mod=sl_daftar_usulan_diusulkan&id_usulan=" . $id_usulan);
        
    //echo("Data usulan telah disimpan");
?>