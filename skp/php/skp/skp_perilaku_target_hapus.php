<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    $sql = "DELETE FROM tbl_skp_perilaku
            WHERE id_skp_perilaku='" . $_GET["id_skp"] . "'";
    
    mysql_query($sql);
    header("location:../../?mod=perilaku_lihat_pilih_periode");
?>