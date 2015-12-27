<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("php/koneksi.php"); ?>
<?php include("php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--<meta name="viewport" content="width=device-width, initial-scale=1" />-->
	<title>:: SISTEM INFORMASI MANAJEMEN KEARSIPAN KOTA MEDAN KANTOR ARSIP DAERAH PEMERINTAH KOTA MEDAN ::</title>
	<link rel="shortcut icon" href="image/favicon no sharpen.ico" />
	<!--<script src="jquery/js/jquery.js"></script>-->
    <script src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.19.custom.min.js"></script>
	<script src="js/jquery.alerts.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>
	<link rel="stylesheet" href="css/laundry.css" />
	<link rel="stylesheet" href="js/alert/jquery.alerts.css" />
    <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css" />
    <link rel="stylesheet" href="css/demo_table_jui.css" type="text/css" media="all" />
    <!--<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />-->
    <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.3.custom.css" type="text/css" media="all" />
    
    <!-- <FANCYBOX> -->
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    
    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <!-- </FANCYBOX> -->
    
    <script type="text/javascript">
    $(document).ready(function(){
        <?php
            if(isset($_SESSION["id_pengguna"])){
        ?>
            $("#topmenu").slideDown(500);
        <?php
            }
        ?>
        
        $('.listingtable').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
    });
    </script>
</head>
<body>
<div id="header"><?php include("isi/widget/headerdariweb.php"); ?></div>

<div id="body">
<?php
    if(!isset($_SESSION["id_pengguna"]) && $_GET["mod"] <> "daftar_pengguna"){
        include("isi/panel/login.php");
    }else if(!isset($_SESSION["id_pengguna"]) && $_GET["mod"] == "daftar_pengguna"){
        include("isi/panel/daftar_pengguna.php");
    }else{
        if(!isset($_GET["mod"]) || $_GET["mod"] == ""){
            switch($_SESSION["id_level"]){
                case "2" :
                    include("isi/menubar/skpd.php");
                    break;
                case "9" :
                    include("isi/menubar/umum.php");
                    break;
                case "11" :
                    include("isi/menubar/admin.php");
                    break;
            }
        }else{
            switch($_GET["mod"]){
                case "info" :
                    include("isi/widget/info.php");
                    break;
                case "peminjaman" :
                    include("isi/menubar/peminjaman.php");
                    break;
                case "pin_dig" :
                    include("isi/menubar/pin_dig.php");
                    break;
                case "mnu_ikm" :
                    include("isi/menubar/mnu_ikm.php");
                    break;
                case "data_arsip" :
                    include("isi/panel/data_arsip.php");
                    break;
                case "pps" :
                    include("isi/panel/pps.php");
                    break;
                case "tambah_pps" :
                    include("isi/panel/tambah_pps.php");
                    break;
                case "edit_pps" :
                    include("isi/panel/edit_pps.php");
                    break;
                case "ikm" :
                    include("isi/panel/ikm.php");
                    break;
                case "edit_ikm" :
                    include("isi/panel/edit_ikm.php");
                    break;
                case "hasil_ikm" :
                    include("isi/panel/hasil_ikm.php");
                    break;
                case "tambah_data_arsip" :
                    include("isi/panel/tambah_data_arsip.php");
                    break;
                case "edit_data_arsip" :
                    include("isi/panel/edit_data_arsip.php");
                    break;
                case "digitalisasi_arsip" :
                    include("isi/panel/digitalisasi_arsip.php");
                    break;
                case "perpanjangan_peminjaman" :
                    include("isi/panel/perpanjangan_peminjaman.php");
                    break;
                case "informasi_perpanjangan_peminjaman" :
                    include("isi/panel/informasi_perpanjangan_peminjaman.php");
                    break;
                case "peringatan_jatuh_tempo" :
                    include("isi/panel/peringatan_jatuh_tempo.php");
                    break;
                case "tanggapan_perpanjangan" :
                    include("isi/panel/tanggapan_perpanjangan.php");
                    break;
                case "peminjaman_digital" :
                    include("isi/panel/peminjaman_digital.php");
                    break;
                case "permohonan_peminjaman_digital" :
                    include("isi/panel/permohonan_peminjaman_digital.php");
                    break;
                case "daftar_arsip_digital" :
                    include("isi/panel/daftar_arsip_digital.php");
                    break;
                case "latar_belakang" :
                    include("isi/panel/nl_latar_belakang.php");
                    break;
                case "file_download" :
                    include("isi/panel/file_download.php");
                    break;
                case "cp_latar_belakang" :
                    include("isi/panel/cp_latar_belakang.php");
                    break;
                case "data_digital_arsip" :
                    include("isi/panel/data_digital_arsip.php");
                    break;
                case "cetak_kotak" :
                    include("isi/panel/cetak_kotak.php");
                    break;
                case "laporan_arsip_cetak_kotak_sampul" :
                    include("isi/panel/laporan_arsip_cetak_kotak_sampul.php");
                    break;
                /* =========== */
                
                case "pengguna" :
                    include("isi/panel/pengguna.php");
                    break;
                
                /* LAPORAN ARSIP -------------------------------- */
                case "laporan_arsip" :
                    include("isi/menubar/laporan_arsip.php");
                    break;
                case "laporan_arsip_1" :
                    include("isi/laporan/laporan_arsip_1.php");
                    break;
                case "laporan_arsip_2" :
                    include("isi/laporan/laporan_arsip_2.php");
                    break;
                case "laporan_arsip_2_all" :
                    include("isi/cetak_laporan/laporan_arsip_2_all.php");
                    break;
                case "laporan_arsip_3" :
                    include("isi/laporan/laporan_arsip_3.php");
                    break;
                case "laporan_arsip_3_all" :
                    include("isi/cetak_laporan/laporan_arsip_3_all.php");
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
        }
    }
?>
</div>
<div id="footer" style="background-color: #eeeedd; padding: 5px;"><?php include("isi/widget/footer.php"); ?></div>
</body>
</html>
<?php ob_end_flush(); ?>