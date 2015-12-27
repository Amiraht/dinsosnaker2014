<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    
    // push catatan
    if($_POST["stt"] == 2){
        mysql_query("INSERT INTO catatan_pengangkatan_cpns VALUES(NULL, '" . $_SESSION["simpeg_id_pegawai"] . "', '" . $_POST["catatan"] . "')");
    }
        
    // update the status_supervisi based on the supervision result
    mysql_query("UPDATE tbl_pengangkatan_cpns SET status_supervisi='" . $_POST["stt"] . "' WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'");
    
    header("location:../../?mod=spv_pengangkatan_cpns");
?>