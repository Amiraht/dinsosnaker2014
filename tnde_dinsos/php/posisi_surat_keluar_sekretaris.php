<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    $pesan = 0;
    selesaiDispSK($_POST["id_disposisi"]);
    if(isset($_POST["terima"])){
        pushDispSK($_POST["id_surat_keluar"], $_SESSION["id_level"], 1, $_POST["catatan"], 1);
        header("location:../?mod=inform&pesan=32&redir=posisi_surat_keluar_sekretaris");
    }else if(isset($_POST["tolak"])){
        $ds_id_dis = mysql_fetch_array(mysql_query("SELECT * FROM myapp_disptable_suratkeluar WHERE id='" . $_POST["id_disposisi"] . "'"));
        pushDispSK($_POST["id_surat_keluar"], $_SESSION["id_level"], levelBawahan($_POST["id_surat_keluar"], 2), $_POST["catatan"], 2);
        header("location:../?mod=inform&pesan=33&redir=posisi_surat_keluar_sekretaris");
    }
?>