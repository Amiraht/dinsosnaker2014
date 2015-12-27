<?php session_start(); ?>
<?php include("php/koneksi.php"); ?>
<?php include("php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<?php require_once("php/dompdf_config.inc.php"); ?>
<?php
        
            switch($_GET["mod"]){
                
                /* LAPORAN ARSIP -------------------------------- */
                case "laporan_arsip" :
                    include("isi/menubar/laporan_arsip.php");
                    break;
                case "laporan_arsip_1" :
                    include("isi/cetak_laporan/laporan_arsip_1.php");
                    break;
                case "laporan_arsip_2" :
                    include("isi/laporan/laporan_arsip_2.php");
                    break;
                case "laporan_arsip_3" :
                    include("isi/laporan/laporan_arsip_3.php");
                    break;
                case "laporan_arsip_4" :
                    include("isi/laporan/laporan_arsip_4.php");
                    break;
                case "laporan_arsip_5" :
                    include("isi/laporan/laporan_arsip_5.php");
                    break;
                case "laporan_arsip_6_7" :
                    include("isi/laporan/laporan_arsip_6_7.php");
                    break;
                /* ---------------------------------------------- */
            }
?>
