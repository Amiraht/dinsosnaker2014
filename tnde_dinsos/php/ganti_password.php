<?php
    session_start();
    include("koneksi.php");
    include("fungsi.php");
    
    /*$file_ttd = $_FILES["ttd"];
    if(isset($file_ttd)){
        $ttd = $_POST["username"] . ".jpg";
        move_uploaded_file($file_ttd["tmp_name"], "../ttd/" . $ttd);
        mysql_query("UPDATE myapp_maintable_pengguna SET username='$_POST[username]', nama='$_POST[nama]', ttd='" . $ttd . "' WHERE id='" . $_SESSION["id_pengguna"] . "'");
        //echo("UPDATE myapp_maintable_pengguna SET username='$_POST[username]', nama='$_POST[nama]', ttd='" . $ttd . "' WHERE id='" . $_SESSION["id_pengguna"] . "'");
    }else{
        mysql_query("UPDATE myapp_maintable_pengguna SET username='$_POST[username]', nama='$_POST[nama]' WHERE id='" . $_SESSION["id_pengguna"] . "'");
        //echo("UPDATE myapp_maintable_pengguna SET username='$_POST[username]', nama='$_POST[nama]' WHERE id='" . $_SESSION["id_pengguna"] . "'");
    }
    header("location:../?mod=inform&pesan=40&redir=logout");*/
    
    if($_POST["password_lama"] == $_SESSION["password"]){
        mysql_query("UPDATE myapp_maintable_pengguna SET password='$_POST[password]' WHERE id='" . $_SESSION["id_pengguna"] . "'");
        header("location:../?mod=inform&pesan=40&redir=logout");
    }else{
        header("location:../?mod=pengguna&err_code_pwd=Password lama anda salah. Silahkan ulangi");
    }
?>