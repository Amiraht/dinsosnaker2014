<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    selesaiDisp($_POST["id_disposisi"]);
    if(isset($_POST["terus"])){
        $res_ldb = mysql_query("SELECT
                                	b.*
                                FROM
                                	myapp_reftable_levelpengguna a
                                	LEFT JOIN myapp_maintable_pengguna b ON a.id = b.id_level
                                WHERE
                                	a.urutan = 4");
        while($ds_ldb = mysql_fetch_array($res_ldb)){
            if(isset($_POST["id_level_tujuan_" . $ds_ldb["id"]]))
                pushDispSM($_POST["id_surat_masuk"], $_SESSION["id_level"], $ds_ldb["id_level"], $_POST["catatan_" . $ds_ldb["id"]], $_SESSION["id_pengguna"], $ds_ldb["id"]);
        }
        header("location:../?mod=inform&pesan=25&redir=proses_ulang_surat_masuk");
    }else if(isset($_POST["tolak"])){
        pushDispSM($_POST["id_surat_masuk"], $_SESSION["id_level"], $_SESSION["atasan"], $_POST["catatan"], $_SESSION["id_pengguna"], $ds_ldb["id"]);
        header("location:../?mod=inform&pesan=25&redir=proses_ulang_surat_masuk");
    }else if(isset($_POST["selesai"]))
        header("location:../?mod=inform&pesan=26&redir=proses_ulang_surat_masuk");
    else if(isset($_POST["balas"])){
        mysql_query("INSERT INTO myapp_sessiontable_balasan VALUES(null, '" . session_id() . "', '" . $_POST["id_surat_masuk"] . "')");
        header("location:../?mod=inform&pesan=36&redir=buat_surat_keluar&id=" . $_POST["id_surat_masuk"]);
    }
?>