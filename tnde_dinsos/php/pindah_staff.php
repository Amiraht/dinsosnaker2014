<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    if(isset($_POST["staff"])){
        $ds_pengguna = mysql_fetch_array(mysql_query("SELECT * FROM myapp_maintable_pengguna WHERE id='" . $_POST["staff"] . "'"));
        mysql_query("UPDATE myapp_disptable_suratmasuk SET id_level_tujuan='" . $ds_pengguna["id_level"] . "', id_pengguna_tujuan='" . $_POST["staff"] . "', status=1 WHERE id='" . $_POST["id_disposisi"] . "'");
    }
    header("location:../?mod=detail_posisi_surat_masuk&id=" . $_POST["id_sm"]);
?>