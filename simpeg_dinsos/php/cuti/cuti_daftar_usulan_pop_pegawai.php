<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    mysql_query("DELETE FROM tbl_usulan_cuti WHERE id_usulan='" . $_GET["id_usulan"] . "'");
    $no_usulan = "";
    if(isset($_GET["no_usulan"]))
        $no_usulan = "&no_usulan=" . $_GET["no_usulan"];
    header("location:../../?mod=" . $_GET["mod"] . $no_usulan);
?>