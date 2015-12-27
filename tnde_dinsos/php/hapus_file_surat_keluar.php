<?php
    include("koneksi.php");
    
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM myapp_filetable_suratkeluar WHERE id='" . $_GET["id"] . "'"));
    //../uploaded/sk/" . $file["name"]
    /*if(file_exists("../uploaded/sk/" . $ds["nama_file"])){
        unlink ("../uploaded/sk/" . $ds["nama_file"]);
    }*/
    mysql_query("DELETE FROM myapp_filetable_suratkeluar WHERE id='" . $_GET["id"] . "'");
    
    header("location:../?mod=file_surat_keluar&id=" . $_GET["id_surat_masuk"] . "&redir=" . $_GET["redir"]);
?>