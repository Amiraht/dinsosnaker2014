<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    if(isset($_POST["kaban"])){
        pushDispSM($_POST["id_surat_masuk"], $_SESSION["id_level"], 1, $_POST["catatan"]);
        selesaiDisp($_POST["id_disposisi"]);
        header("location:../?mod=inform&pesan=22&redir=posisi_surat_masuk_sekretaris");
    }else if(isset($_POST["kabid"])){
        $res_ldb = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE (atasan='1' AND id <> 2) OR atasan='" . $_SESSION["id_level"] . "'");
        while($ds_ldb = mysql_fetch_array($res_ldb)){
            if(isset($_POST["id_level_tujuan_" . $ds_ldb["id"]]))
                pushDispSM($_POST["id_surat_masuk"], $_SESSION["id_level"], $ds_ldb["id"], $_POST["catatan_" . $ds_ldb["id"]]);
        }
        selesaiDisp($_POST["id_disposisi"]);
        header("location:../?mod=inform&pesan=23&redir=posisi_surat_masuk_sekretaris");
    }else if(isset($_POST["selesai"])){
        selesaiDisp($_POST["id_disposisi"]);
        header("location:../?mod=inform&pesan=23&redir=posisi_surat_masuk_sekretaris");
    }
    
?>