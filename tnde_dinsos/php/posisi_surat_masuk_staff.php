<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    /*$res_ldb = mysql_query("SELECT
                                	b.*
                                FROM
                                	myapp_reftable_levelpengguna a
                                	LEFT JOIN myapp_maintable_pengguna b ON a.id = b.id_level
                                WHERE
                                	a.atasan = " . $_SESSION["atasan"] . " AND a.urutan = 4");
    while($ds_ldb = mysql_fetch_array($res_ldb)){
        if(isset($_POST["id_level_tujuan_" . $ds_ldb["id"]]))
            pushDispSM($_POST["id_surat_masuk"], $_SESSION["id_level"], $ds_ldb["id_level"], $_POST["catatan_" . $ds_ldb["id"]], $_SESSION["id_pengguna"], $ds_ldb["id"]);
    }*/
    
    //selesaiDisp($_POST["id_disposisi"]);
    mysql_query("UPDATE myapp_maintable_suratmasuk SET status = 2 WHERE id='" . $_POST["id_surat_masuk"] . "'");
    if(isset($_POST["selesai"])){
        selesaiDisp($_POST["id_disposisi"]);
        header("location:../?mod=inform&pesan=26&redir=posisi_surat_masuk_staff");
    }else if(isset($_POST["tolak"])){
        $ds_disp = mysql_fetch_array(mysql_query("SELECT * FROM myapp_disptable_suratmasuk WHERE id='" . $_POST["id_disposisi"] . "'"));
        selesaiDisp($_POST["id_disposisi"]);
        pushDispSM($_POST["id_surat_masuk"], $_SESSION["id_level"], $ds_disp["id_level_asal"], $_POST["catatan"], $_SESSION["id_pengguna"], $ds_ldb["id"]);
        header("location:../?mod=inform&pesan=45&redir=posisi_surat_masuk_staff");
    }
    else if(isset($_POST["balas"]))
        header("location:../?mod=inform&pesan=36&redir=buat_surat_keluar&id=" . $_POST["id_surat_masuk"] . "&id_disposisi=" . $_POST["id_disposisi"]);
    //selesaiDisp($_POST["id_disposisi"]);
    //header("location:../?mod=inform&pesan=26&redir=posisi_surat_masuk_staff");
?>