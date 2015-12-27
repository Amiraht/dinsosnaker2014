<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    if($_GET["id"] <> "")
        mysql_query("UPDATE myapp_reftable_unitkerja SET unit_kerja='" . $_GET["uk"] . "' WHERE id_unit_kerja='" . $_GET["id"] . "'");
    else
        mysql_query("INSERT INTO myapp_reftable_unitkerja VALUES(null, '" . $_GET["uk"] . "', null, null)");
    
    header("location:../?mod=cp_unit_kerja");
?>