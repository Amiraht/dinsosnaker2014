<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    $file_ttd = $_FILES["ttd"];
    if($file_ttd["name"] != ""){
        $ttd = $_POST["username"] . ".jpg";
        unlink("../ttd/" . $ttd);
        move_uploaded_file($file_ttd["tmp_name"], "../ttd/" . $ttd);
        mysql_query("UPDATE myapp_maintable_pengguna SET username='$_POST[username]', nama='$_POST[nama]', ttd='" . $ttd . "', nip='$_POST[nip]', kontak='$_POST[kontak]', email='$_POST[email]', level_kasubbid='$_POST[level_kasubbid]' WHERE id='" . $_POST["id"] . "'");
        //echo("UPDATE myapp_maintable_pengguna SET username='$_POST[username]', nama='$_POST[nama]', ttd='" . $ttd . "' WHERE id='" . $_SESSION["id_pengguna"] . "'");
    }else{
        mysql_query("UPDATE myapp_maintable_pengguna SET username='$_POST[username]', nama='$_POST[nama]', nip='$_POST[nip]', kontak='$_POST[kontak]', email='$_POST[email]', level_kasubbid='$_POST[level_kasubbid]' WHERE id='" . $_POST["id"] . "'");
        //echo("UPDATE myapp_maintable_pengguna SET username='$_POST[username]', nama='$_POST[nama]' WHERE id='" . $_SESSION["id_pengguna"] . "'");
    }
    header("location:../?mod=cp_pengguna");
?>