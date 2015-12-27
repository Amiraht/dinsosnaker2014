<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    $id_lhkpn = $_POST["id_lhkpn"];
    $sql_delete = "DELETE FROM tbl_lhkpn WHERE id_lhkpn='" . $id_lhkpn . "'";
    mysql_query($sql_delete);
    echo($sql_delete);
?>
