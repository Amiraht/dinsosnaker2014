<?php
    session_start();
    include("koneksi.php");
    
    // 2. UPDATE surat masuk STATUS = SESUAI YANG DIMINTA DAN ISIKAN TUJUAN SERTA ASAL DISPOSISI
    $pesan = 0;
    if($_GET["status"] == 3){
        if($_SESSION["id_level"] == 2){
            mysql_query("UPDATE myapp_maintable_suratkeluar SET status=1, asal_disposisi='$_SESSION[id_level]', tujuan_disposisi='1' WHERE id='$_GET[id]'");
            $pesan = 18;
        }else{
            mysql_query("UPDATE myapp_maintable_suratkeluar SET status=1, asal_disposisi='$_SESSION[id_level]', tujuan_disposisi='2' WHERE id='$_GET[id]'");
            $pesan = 16;
        }
    }else if($_GET["status"] == 4){
        if($_SESSION["id_level"] == 2){
            // MENDAPATKAN id_level_pembuat
            $ds_pembuat = mysql_fetch_array(mysql_query("SELECT * FROM myapp_maintable_suratkeluar WHERE id='$_GET[id]'"));
            
            // MENDAPATKAN ATASAN PEMBUAT
            $ds_ap = mysql_fetch_array(mysql_query("SELECT * FROM myapp_reftable_levelpengguna WHERE id='$ds_pembuat[id_level_pembuat]'"));
            
            mysql_query("UPDATE myapp_maintable_suratkeluar SET status=2, tujuan_disposisi='$ds_ap[atasan]', asal_disposisi='$_SESSION[id_level]' WHERE id='$_GET[id]'");
            $pesan = 17;
        }else{
            mysql_query("UPDATE myapp_maintable_suratkeluar SET status=2, tujuan_disposisi=id_level_pembuat, asal_disposisi='$_SESSION[id_level]' WHERE id='$_GET[id]'");
            $pesan = 15;
        }
    }
    
    // 3. PUSH catatan disposisi surat keluar
    mysql_query("INSERT INTO myapp_notetable_disposisisuratkeluar VALUES(null, '$_GET[id]', '$_SESSION[id_level]', '$_GET[catatan]')");
    //echo($sql);
    header("location:../?mod=inform&pesan=" . $pesan . "&redir=perbaikan_surat_keluar_kabid");
?>