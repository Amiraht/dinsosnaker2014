<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    mysql_query("DELETE FROM myapp_maintable_sarankaban WHERE id_surat_masuk='" . $_POST["id_surat_masuk"] . "'");
    $res_ldb = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "' AND id <> 2");
    while($ds_ldb = mysql_fetch_array($res_ldb)){
        if(isset($_POST["id_level_tujuan_" . $ds_ldb["id"]]))
            mysql_query("INSERT INTO myapp_maintable_sarankaban VALUES('" . $_POST["id_surat_masuk"] . "', '" . $ds_ldb["id"] . "')");
    }
    pushDispSM($_POST["id_surat_masuk"], $_SESSION["id_level"], 2, $_POST["catatan"]);
    selesaiDisp($_POST["id_disposisi"]);
    header("location:../?mod=inform&pesan=39&redir=posisi_surat_masuk_kaban");
?>