<?php
	error_reporting(0);
	session_start();
	ob_start();
	set_time_limit(0);

?>
<?php include("php/koneksi.php"); ?>
<?php include("php/fungsi.php"); ?>
<?php include("php/sqli.php"); ?>
<?php date_default_timezone_set("Asia/Jakarta"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--<meta name="viewport" content="width=device-width, initial-scale=1" />-->
	<title> SISTEM INFORMASI MANAJEMEN KEARSIPAN DINAS SOSIAL DAN TENAGA KERJA </title>
	<link rel='stylesheet' href='./css/template.css' type='text/css' />
    <link rel='stylesheet' href='./css/menu.css' type='text/css' />
	<link rel='stylesheet' href='./css/style.css' type='text/css' />
	<link rel='stylesheet' href='./css/tabel.css' type='text/css' />
	<link rel='stylesheet' href='./css/button.css' type='text/css' />
    <!--<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />-->
   
	<script src='./libraries/jquery-1.4.3.js'></script>
	<link type="text/css" href="./libraries/development-bundle/themes/base/ui.all.css" rel="stylesheet" />
    <script type="text/javascript" src="./libraries/development-bundle/ui/ui.core.js"></script>
    <script type="text/javascript" src="./libraries/development-bundle/ui/ui.datepicker.js"></script>
    <script type="text/javascript" src="./libraries/development-bundle/ui/i18n/ui.datepicker-id.js"></script>
	
	<script type="text/javascript" src="./libraries/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="./libraries/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="./libraries/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	
</head>
<body>
	<table border='0px' id='dalam' style='margin-top:0px; height:100%;'>
		<tr>
			<td>
<?php
    if(!isset($_SESSION["id_pengguna"])){
        if(!isset($_GET["mod"]) || $_GET["mod"] == ""){
			include("isi/panel/login.php");
		}else{
			
			switch($_GET["mod"]){
				case "latar_belakang" :
                    include("isi/panel/nonlogin/latar_belakang.php");
                    break;
				case "login" :
					include("isi/panel/nonlogin/login.php");
                    break;
				case "fdownload" :
					include("isi/panel/nonlogin/download.php");
                    break;
				case "berita_dan_informasi" :
					include("isi/panel/nonlogin/berita_informasi.php");
                    break;
			} 
			
		}
    }else{
        if(!isset($_GET["mod"]) || $_GET["mod"] == ""){
            switch($_SESSION["id_level"]){
				// Kabid dan Kasi
                case "11" :
				case "12" :
				case "20" :
				case "22" :
				case "23" :
				case "4"  :
				case "5"  :
				case "7"  :
				case "8"  :
                    include("isi/menubar/skpd.php");
                    break;
                case "15" :
				case "2" :
                    include("isi/menubar/umum.php");
                    break;
                case "17" :
                    include("isi/menubar/kakan.php");
                    break;
                case "19" :
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
                
				case "posisi_surat_masuk_kaban" :
                    include("isi/panel/posisi_surat_masuk_kaban.php");
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
				
				/* -----------------DIALOG PAGE PROSES----------------------- */
				case "dialog_form_disp" :
					include("isi/panel/dialog/dialog_form_disp.php");
					break;
            }
        }
    }
?>
	</td>
	</tr>
</table>
</body>
</html>
<?php
	ob_end_flush();
?>