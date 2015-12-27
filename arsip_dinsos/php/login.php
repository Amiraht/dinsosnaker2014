<?php
    session_start();
    include("koneksi.php");
    if(!isset($_POST["admin"])){
        $res = mysql_query("SELECT
                            	a.*, b.unit_kerja, b.kode_instansi
                            FROM
                            	tbl_anggota_arsip a
                            	LEFT JOIN ref_unit_kerja b ON a.id_unit_kerja = b.id_unit_kerja
                            WHERE
                            	a.username = '$_POST[username]' AND a.password = '$_POST[password]'");
        if(mysql_num_rows($res)){
            $ds = mysql_fetch_array($res);
            $_SESSION["password"]       = $ds["password"];
            $_SESSION["id_pengguna"]    = $ds["id_anggota"];
            $_SESSION["id_level"]       = $ds["id_level_pengguna"];
            $_SESSION["id_unit_kerja"]  = $ds["id_unit_kerja"];
            $_SESSION["kode_instansi"]  = $ds["kode_instansi"];
            $_SESSION["username"]       = $ds["username"];
            $_SESSION["nama"]           = $ds["nama_lengkap"];
            header("location:../");
        }else{
            session_destroy();
            header("location:../?galog=1");
        }
    }else{
        $res = mysql_query("SELECT * FROM tbl_pengguna a WHERE (a.id_level = 11 OR id_level = 7) AND a.username = '$_POST[username]' AND a.password = '$_POST[password]'");
        if(mysql_num_rows($res)){
            $ds = mysql_fetch_array($res);
            $_SESSION["password"]       = $ds["password"];
            $_SESSION["id_pengguna"]    = $ds["id_user"];
            $_SESSION["id_level"]       = $ds["id_level"];
            $_SESSION["id_unit_kerja"]  = 0;
            $_SESSION["kode_instansi"]  = 0;
            $_SESSION["username"]       = $ds["username"];
            $_SESSION["nama"]           = $ds["nama"];
            header("location:../");
        }else{
            session_destroy();
            header("location:../?galog=1");
        }
    }
?>