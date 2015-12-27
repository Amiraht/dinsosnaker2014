<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    $res_cek_ada = mysql_query("SELECT * FROM myapp_archivetable_suratmasuk WHERE id_surat_masuk='" . $_POST["id_surat_masuk"] . "'");
    if(mysql_num_rows($res_cek_ada) > 0){
        // NGEDIT
        mysql_query("UPDATE myapp_archivetable_suratmasuk SET sampul='" . $_POST["sampul"] . "', kotak='" . $_POST["kotak"] . "', rak='" . $_POST["rak"] . "' WHERE id_surat_masuk='" . $_POST["id_surat_masuk"] . "'");
        //echo("edit");
    }else{
        // NAMBAH
        mysql_query("INSERT INTO myapp_archivetable_suratmasuk VALUES('" . $_POST["id_surat_masuk"] . "', '" . $_POST["sampul"] . "', '" . $_POST["kotak"] . "', '" . $_POST["rak"] . "')");
        //echo("nambah");
    }
    header("location:../?mod=inform&pesan=42&redir=");
?>