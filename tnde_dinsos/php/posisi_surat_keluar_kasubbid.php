<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    $pesan = 0;
    selesaiDispSK($_POST["id_disposisi"]);
    if(isset($_POST["terima"])){
        pushDispSK($_POST["id_surat_keluar"], $_SESSION["id_level"], $_SESSION["atasan"], $_POST["catatan"], 1);
        header("location:../?mod=inform&pesan=27&redir=posisi_surat_keluar_kasubbid");
    }else if(isset($_POST["tolak"])){
        $ds_id_dis = mysql_fetch_array(mysql_query("SELECT * FROM myapp_disptable_suratkeluar WHERE id='" . $_POST["id_disposisi"] . "'"));
        pushDispSK($_POST["id_surat_keluar"], $_SESSION["id_level"], levelBawahan($_POST["id_surat_keluar"], 4), $_POST["catatan"], 2, $_SESSION["id_pengguna"], levelBawahan($_POST["id_surat_keluar"], 4, 1));
        header("location:../?mod=inform&pesan=28&redir=posisi_surat_keluar_kasubbid");
    }
?>