<?php
    session_start();
    include("koneksi.php");
    $ds=mysql_fetch_array(mysql_query("SELECT * FROM tbl_file_arsip_digital WHERE id_file = '" . $_GET["id"] . "'"));
    //echo($ds["judul"]);
    $nama_file = "";
    $ctr = 0;
    do{
        $ctr++;
        $nama_file = "download_" . $ctr . "." . $ds["ekstensi"];
    }while(file_exists("../uploaded/" . $nama_file));
    //file_put_contents("../uploaded/" . $nama_file, base64_decode($data));
    $file = fopen("../uploaded/" . $nama_file, "w");
    fwrite($file, $ds["file"]);
    fclose($file);
    header("location:../uploaded/" . $nama_file);
?>