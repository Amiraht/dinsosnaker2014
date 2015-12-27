<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    $isi = $_FILES["isi"];
    if($_POST["id"] <> ""){
        if($isi["name"] <> ""){
            move_uploaded_file($isi["tmp_name"], "../uploaded/fd/" . $isi["name"]);
            mysql_query("UPDATE myapp_nonlogintable_filedownload SET judul='" . $_POST["judul"] . "', deskripsi='" . $_POST["deskripsi"] . "', tanggal=CURDATE(), isi='" . $isi["name"] . "' WHERE id='" . $_POST["id"] . "'");
        }else{
            mysql_query("UPDATE myapp_nonlogintable_filedownload SET judul='" . $_POST["judul"] . "', deskripsi='" . $_POST["deskripsi"] . "', tanggal=CURDATE() WHERE id='" . $_POST["id"] . "'");
        }
    }else{
        if($isi["name"] <> ""){
            move_uploaded_file($isi["tmp_name"], "../uploaded/fd/" . $isi["name"]);
            mysql_query("INSERT INTO myapp_nonlogintable_filedownload VALUES(null, '" . $_POST["judul"] . "', '" . $_POST["deskripsi"] . "', CURDATE(), '" . $isi["name"] . "')");
            echo("nambah : INSERT INTO myapp_nonlogintable_filedownload VALUES(null, '" . $_POST["judul"] . "', '" . $_POST["deskripsi"] . "', CURDATE(), '" . $isi["name"] . "')");   
        }else{
            mysql_query("INSERT INTO myapp_nonlogintable_filedownload VALUES(null, '" . $_POST["judul"] . "', '" . $_POST["deskripsi"] . "', CURDATE(), 'no_photo.jpg')");
        }
    }
    header("location:../?mod=cp_file_download");
?>