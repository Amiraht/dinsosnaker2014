<?php
    session_start();
    include("koneksi.php");
    $res = mysql_query("SELECT 
                        	a.*, b.atasan AS atasan
                        FROM 
                        	myapp_maintable_pengguna a
                        LEFT JOIN 
                        	myapp_reftable_levelpengguna b ON a.id_level = b.id
                        WHERE 
                        	username='$_POST[username]' AND password='$_POST[password]'");
    if(mysql_num_rows($res) == 1){
        $ds = mysql_fetch_array($res);
        $_SESSION["password"]       = $ds["password"];
        $_SESSION["id_pengguna"]    = $ds["id"];
        $_SESSION["id_level"]       = $ds["id_level"];
        $_SESSION["username"]       = $ds["username"];
        $_SESSION["nama"]           = $ds["nama"];
        $_SESSION["atasan"]         = $ds["atasan"];
        header("location:../");
    }else{
        session_destroy();
        header("location:../?galog=1");
    }
?>