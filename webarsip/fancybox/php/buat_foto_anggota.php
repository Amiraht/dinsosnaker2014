<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once("koneksi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php
    $ds = mysql_fetch_array(mysql_query("SELECT
                                        	a.*, b.jenis_kelamin, c.level, d.unit_kerja
                                        FROM
                                        	tbl_anggota_arsip a
                                        	LEFT JOIN ref_jenis_kelamin b ON a.id_jenis_kelamin = b.id_jenis_kelamin
                                        	LEFT JOIN ref_level_pengguna c ON a.id_level_pengguna = c.id_level
                                        	LEFT JOIN ref_unit_kerja d ON a.id_unit_kerja = d.id_unit_kerja
                                        WHERE
                                        	a.id_anggota = '" . $_SESSION["id_pengguna"] . "'"));
    //echo($ds["foto"]);
    $image = $ds["foto"];
    header("Content-type: image/jpeg"); // or whatever 
    echo($image); 
    exit; 
       
?>