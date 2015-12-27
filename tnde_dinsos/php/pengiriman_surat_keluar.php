<?php
    session_start();
    include("koneksi.php");
    
    mysql_query("UPDATE myapp_maintable_suratkeluar SET no_surat='$_GET[no_surat]', tgl_kirim='$_GET[tgl_kirim]', status=4, tujuan_disposisi=0, asal_disposisi='$_SESSION[id_level]' WHERE id='$_GET[id]'");
    $pesan = 21;
    
    // 3. PUSH catatan disposisi surat keluar
    mysql_query("INSERT INTO myapp_notetable_disposisisuratkeluar VALUES(null, '$_GET[id]', '$_SESSION[id_level]', '$_GET[catatan]')");
    //echo($sql);
    header("location:../?mod=inform&pesan=" . $pesan . "&redir=pengiriman_surat_keluar");
?>