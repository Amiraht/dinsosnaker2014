<?php
    session_start();
    include("koneksi.php");
    $file = $_FILES["digital"];
    $nama_file = $file["name"];
    $pecah = explode(".", $nama_file);
    $ekstensi = $pecah[count($pecah) - 1];
    
    // upload atau simpan dulu file nya ke server
    move_uploaded_file($file["tmp_name"], "../digitalisasi_temp/" . $nama_file);
    
    // baca hex file tersebut
    $handle = fopen("../digitalisasi_temp/" . $nama_file, "r");
    $bacafile = fread($handle, filesize("../digitalisasi_temp/" . $nama_file));
    $hex = $bacafile;
    fclose($handle);
    unlink("../digitalisasi_temp/" . $nama_file);
    
    // simpan di database
    mysql_query("INSERT INTO tbl_file_arsip_digital VALUES(null, '" . $_POST["id_arsip"] . "', '" . $nama_file . "', '" . $ekstensi . "', '" . mysql_real_escape_string($hex) . "')");
    header("location:../?mod=digitalisasi_arsip&id=" . $_POST["id_arsip"]);
?>