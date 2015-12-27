<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    $res_cek_ada = mysql_query("SELECT * FROM myapp_archivetable_suratkeluar WHERE id_surat_keluar='" . $_POST["id_surat_keluar"] . "'");
    if(mysql_num_rows($res_cek_ada) > 0){
        // NGEDIT
        mysql_query("UPDATE myapp_archivetable_suratkeluar SET sampul='" . $_POST["sampul"] . "', kotak='" . $_POST["kotak"] . "', rak='" . $_POST["rak"] . "' WHERE id_surat_keluar='" . $_POST["id_surat_keluar"] . "'");
        //echo("edit");
    }else{
        // NAMBAH
        mysql_query("INSERT INTO myapp_archivetable_suratkeluar VALUES('" . $_POST["id_surat_keluar"] . "', '" . $_POST["sampul"] . "', '" . $_POST["kotak"] . "', '" . $_POST["rak"] . "')");
        //echo("nambah");
    }
    header("location:../?mod=inform&pesan=43&redir=");
?>