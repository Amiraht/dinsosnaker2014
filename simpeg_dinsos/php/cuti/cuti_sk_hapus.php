<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    // delete data sk
    mysql_query("DELETE FROM tbl_sk_cuti WHERE id_surat='" . $_GET["id_surat"] . "'");
    
    // delete pegawai yang tergabung didalam sk
    mysql_query("DELETE FROM tbl_riwayat_cuti WHERE id_surat='" . $_GET["id_surat"] . "'");
    
    // redirect ke halaman cuti
    header("location:../../?mod=cuti_sk");
?>
