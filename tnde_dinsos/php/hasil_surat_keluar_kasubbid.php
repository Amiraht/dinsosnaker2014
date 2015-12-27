<?php
    session_start();
    include("koneksi.php");
    
    // 2. UPDATE surat masuk STATUS = 3 DAN ISIKAN TUJUAN SERTA ASAL DISPOSISI
    mysql_query("UPDATE myapp_maintable_suratkeluar SET status=1, asal_disposisi='$_SESSION[id_level]', tujuan_disposisi='$_SESSION[atasan]' WHERE id='$_GET[id]'");
    
    // 3. PUSH catatan disposisi surat masuk
    mysql_query("INSERT INTO myapp_notetable_disposisisuratkeluar VALUES(null, '$_GET[id]', '$_SESSION[id_level]', '$_GET[catatan]')");
    //echo($sql);
    header("location:../?mod=inform&pesan=17&redir=perbaikan_surat_keluar_kasubbid");
?>