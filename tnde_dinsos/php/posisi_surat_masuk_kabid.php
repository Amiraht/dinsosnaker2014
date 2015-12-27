<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    selesaiDisp($_POST["id_disposisi"]);
    if(isset($_POST["terus"])){
        $res_ldb = mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE atasan='" . $_SESSION["id_level"] . "' AND id <> 2");
        while($ds_ldb = mysql_fetch_array($res_ldb)){
            if(isset($_POST["id_level_tujuan_" . $ds_ldb["id"]]))
                pushDispSM($_POST["id_surat_masuk"], $_SESSION["id_level"], $ds_ldb["id"], $_POST["catatan_" . $ds_ldb["id"]]);
        }
        
        header("location:../?mod=inform&pesan=24&redir=posisi_surat_masuk_kabid");
    }else if(isset($_POST["tolak"])){
        pushDispSM($_POST["id_surat_masuk"], $_SESSION["id_level"], 2, $_POST["catatan"]);
        header("location:../?mod=inform&pesan=38&redir=posisi_surat_masuk_kabid");
    }else if(isset($_POST["selesai"]))
        header("location:../?mod=inform&pesan=26&redir=posisi_surat_masuk_kabid");
    else if(isset($_POST["balas"])){
        mysql_query("INSERT INTO myapp_sessiontable_balasan VALUES(null, '" . session_id() . "', '" . $_POST["id_surat_masuk"] . "')");
        header("location:../?mod=inform&pesan=36&redir=buat_surat_keluar&id=" . $_POST["id_surat_masuk"]);
    }
    
?>