<?php
    session_start();
    include("koneksi.php");
    
    // 2. UPDATE surat masuk STATUS = SESUAI YANG DIMINTA DAN ISIKAN TUJUAN SERTA ASAL DISPOSISI
    if($_GET["status"] == 3)
        mysql_query("UPDATE myapp_maintable_suratmasuk SET status=5, asal_disposisi='$_SESSION[id_level]', tujuan_disposisi='0' WHERE id='$_GET[id]'");
    else if($_GET["status"] == 4)
        mysql_query("UPDATE myapp_maintable_suratmasuk SET status=4, tujuan_disposisi=asal_disposisi, asal_disposisi='$_SESSION[id_level]' WHERE id='$_GET[id]'");
    
    // 3. PUSH catatan disposisi surat masuk
    mysql_query("INSERT INTO myapp_notetable_disposisisuratmasuk VALUES(null, '$_GET[id]', '$_SESSION[id_level]', '$_GET[catatan]')");
    //echo($sql);
    header("location:../?mod=inform&pesan=8&redir=hasil_surat_masuk_kaban");
?>