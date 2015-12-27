<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    $pesan = 0;
    selesaiDispSK($_POST["id_disposisi"]);
    if(isset($_POST["terima"])){
        $ds_id_dis = mysql_fetch_array(mysql_query("SELECT * FROM myapp_disptable_suratkeluar WHERE id='" . $_POST["id_disposisi"] . "'"));
        //function pushDispSK($id_surat_keluar, $id_level_asal, $id_level_tujuan, $catatan, $keadaan, $id_pengguna_asal=0, $id_pengguna_tujuan=0){
        pushDispSK($_POST["id_surat_keluar"], $_SESSION["id_level"], $ds_id_dis["id_level_asal"], $_POST["catatan"], 1, $_SESSION["id_pengguna"]);
        header("location:../?mod=inform&pesan=29&redir=posisi_surat_keluar_staff");
    }else if(isset($_POST["benerin"])){
        $ds_id_dis = mysql_fetch_array(mysql_query("SELECT * FROM myapp_disptable_suratkeluar WHERE id='" . $_POST["id_disposisi"] . "'"));
        //function pushDispSK($id_surat_keluar, $id_level_asal, $id_level_tujuan, $catatan, $keadaan, $id_pengguna_asal=0, $id_pengguna_tujuan=0){
        pushDispSK($_POST["id_surat_keluar"], $_SESSION["id_level"], $ds_id_dis["id_level_asal"], $_POST["catatan"], 1, $_SESSION["id_pengguna"]);
        header("location:../?mod=edit_surat_keluar&id=" . $_POST["id_surat_keluar"]);
    }
?>