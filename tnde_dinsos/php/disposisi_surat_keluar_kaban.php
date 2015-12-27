<?php
    session_start();
    include("koneksi.php");
    
    // 2. UPDATE surat masuk STATUS = SESUAI YANG DIMINTA DAN ISIKAN TUJUAN SERTA ASAL DISPOSISI
    $pesan = 0;
    if($_GET["status"] == 3){
        mysql_query("UPDATE myapp_maintable_suratkeluar SET status=3, asal_disposisi='$_SESSION[id_level]', tujuan_disposisi='7' WHERE id='$_GET[id]'");
        $pesan = 19;
    }else if($_GET["status"] == 4){
        mysql_query("UPDATE myapp_maintable_suratkeluar SET status=2, tujuan_disposisi=2, asal_disposisi='$_SESSION[id_level]' WHERE id='$_GET[id]'");
        $pesan = 20;
    }
    
    // 3. PUSH catatan disposisi surat keluar
    mysql_query("INSERT INTO myapp_notetable_disposisisuratkeluar VALUES(null, '$_GET[id]', '$_SESSION[id_level]', '$_GET[catatan]')");
    //echo($sql);
    header("location:../?mod=inform&pesan=" . $pesan . "&redir=disposisi_surat_keluar_kaban");
?>