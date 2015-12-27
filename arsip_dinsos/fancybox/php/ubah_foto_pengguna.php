<?php
    session_start();
    include("koneksi.php");
    $file = $_FILES["foto"];
    $nama_file = $file["name"];
    $pecah = explode(".", $nama_file);
    $ekstensi = $pecah[count($pecah) - 1];
    
    if(strtolower($ekstensi) == "jpg" || strtolower($ekstensi) == "png" || strtolower($ekstensi) == "gif" || strtolower($ekstensi) == "jpeg"){
        // upload atau simpan dulu file nya ke server
        move_uploaded_file($file["tmp_name"], "../digitalisasi_temp/" . $nama_file);
        
        // baca hex file tersebut
        $handle = fopen("../digitalisasi_temp/" . $nama_file, "r");
        $bacafile = fread($handle, filesize("../digitalisasi_temp/" . $nama_file));
        $hex = $bacafile;
        fclose($handle);
        unlink("../digitalisasi_temp/" . $nama_file);
        
        // simpan di database
        mysql_query("UPDATE tbl_anggota_arsip SET
                    foto='" . mysql_real_escape_string($hex) . "'
                 WHERE id_anggota='" . $_SESSION["id_pengguna"] . "'");
        header("location:../?mod=pengguna&scs_msg_foto=Foto telah diganti");
    }else{
        header("location:../?mod=pengguna&err_msg_foto=File yang di upload harus berupa foto (jpg, png, gif, jpeg)");
    }
?>