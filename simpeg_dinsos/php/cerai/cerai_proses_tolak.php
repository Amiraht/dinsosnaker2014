<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    // AMBIL NO. USULAN
    $ds_usulan = mysql_fetch_array(mysql_query("SELECT * FROM tbl_usulan_cerai WHERE id_usulan='" . $_GET["id_usulan"] . "'"));
    $no_usulan = $ds_usulan["no_usulan"];
    
    // EDIT DATANYA
    mysql_query("UPDATE tbl_usulan_cerai SET diproses=2, catatan_penolakan='" . $_GET["isi_catatan"] . "' WHERE id_usulan='" . $_GET["id_usulan"] . "'");
    
    header("location:../../?mod=cerai_proses_daftar_pegawai&no_usulan=" . $no_usulan);
?>