<?php
    session_start();
    include("koneksi.php");
    $res = mysql_query("SELECT 
                            a.*, b.id_satuan_organisasi, b.id_tipe_jabatan
                        FROM 
                            tbl_pengguna a
                            LEFT JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai 
                        WHERE 
                            a.username = '$_POST[username]' AND a.password = '$_POST[password]'");
    //echo("SELECT * FROM tbl_pengguna a WHERE a.username = '$_POST[username]' AND a.password = '$_POST[password]'");
    if(mysql_num_rows($res)){
        $ds = mysql_fetch_array($res);
        $_SESSION["simpeg_password"]       = $ds["password"];
        $_SESSION["simpeg_id_pengguna"]    = $ds["id_user"];
        $_SESSION["simpeg_id_skpd"]       = $ds["id_satuan_organisasi"];
        $_SESSION["simpeg_username"]       = $ds["username"];
        $_SESSION["simpeg_nama"]           = $ds["nama"];
        $_SESSION["simpeg_id_level"]        = $ds["modul"];
        $_SESSION["simpeg_id_tipe_jabatan"] = $ds["id_tipe_jabatan"];
        if($ds["modul"] == 1)
            $_SESSION["simpeg_id_pegawai"] = $ds["id_pegawai"];
        header("location:../");
    }else{
        session_destroy();
        header("location:../?galog=1");
    }
?>