<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    mysql_query("DELETE FROM myapp_reftable_unitkerja WHERE id_unit_kerja='" . $_GET["id"] . "'");
    
    header("location:../?mod=cp_unit_kerja");
?>