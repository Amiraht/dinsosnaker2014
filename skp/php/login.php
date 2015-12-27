<?php
    session_start();
    include("koneksi.php");
	
	$username = $_POST["username"];
	$pass = md5($_POST["password"]);
	
    $res = mysql_query("SELECT 
                            a.*, b.id_satuan_organisasi, b.id_tipe_jabatan
                        FROM 
                            tbl_pengguna a
                            LEFT JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai 
                        WHERE 
                            a.username = '".$username."' AND a.password = '".$pass."'");
							
    //echo("SELECT * FROM tbl_pengguna a WHERE a.username = '$_POST[username]' AND a.password = '$_POST[password]'");
    if(mysql_num_rows($res) == 1){
        $ds = mysql_fetch_array($res);
        $_SESSION["password"]       = $ds["password"];
        $_SESSION["id_pengguna"]    = $ds["id_user"];
        $_SESSION["id_skpd"]       = $ds["id_satuan_organisasi"];
        $_SESSION["username"]       = $ds["username"];
        $_SESSION["nama"]           = $ds["nama"];
        $_SESSION["id_level"]        = $ds["modul"];
        $_SESSION["id_tipe_jabatan"] = $ds["id_tipe_jabatan"];
        if($ds["modul"] == 1)
            $_SESSION["id_pegawai"] = $ds["id_pegawai"];
        header("location:../?mod=");
    }else{
        session_destroy();
        header("location:../?galog=1");
    }
?>