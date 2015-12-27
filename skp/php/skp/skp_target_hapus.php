<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $sql = "DELETE FROM tbl_skp
            WHERE id_skp='" . $_GET["id_skp"] . "'";
    
    mysql_query($sql);
    header("location:../../?mod=skp_target");
?>