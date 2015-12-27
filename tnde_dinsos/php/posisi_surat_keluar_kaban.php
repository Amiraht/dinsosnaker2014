<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    $pesan = 0;
    selesaiDispSK($_POST["id_disposisi"]);
    if(isset($_POST["terima"])){
        //pushDispSK($_POST["id_surat_keluar"], $_SESSION["id_level"], 1, $_POST["catatan"], 1);
        $ds_sk=mysql_fetch_array(mysql_query("SELECT * FROM myapp_maintable_suratkeluar WHERE id='" . $_POST["id_surat_keluar"] . "'"));
        $peneken_nota = 1;
        if($ds_sk["id_ttd"] == 2 || $ds_sk["id_ttd"] == 3){
            mysql_query("UPDATE myapp_maintable_suratkeluar SET no_nodin='" . nomor_nodin($peneken_nota, date("Y")) . "', tgl_nodin=CURDATE() WHERE id='" . $_POST["id_surat_keluar"] . "'");
        }
        mysql_query("UPDATE myapp_maintable_suratkeluar SET status=2 WHERE id='" . $_POST["id_surat_keluar"] . "'");
        header("location:../?mod=inform&pesan=34&redir=posisi_surat_keluar_kaban");
    }else if(isset($_POST["tolak"])){
        $ds_id_dis = mysql_fetch_array(mysql_query("SELECT * FROM myapp_disptable_suratkeluar WHERE id='" . $_POST["id_disposisi"] . "'"));
        pushDispSK($_POST["id_surat_keluar"], $_SESSION["id_level"], 2, $_POST["catatan"], 2);
        header("location:../?mod=inform&pesan=35&redir=posisi_surat_keluar_kaban");
    }
?>