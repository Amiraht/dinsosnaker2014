<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $sql_delete = "DELETE FROM tbl_lhkpn_wajib WHERE id_wajib_lhkpn='" . $_POST["id_wajib_lhkpn"] . "'";
    mysql_query($sql_delete);
    echo($sql_delete);
?>
