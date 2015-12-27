<?php
	error_reporting(0);
	session_start();
	ob_start();
	set_time_limit(0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>SISTEM INFORMASI MANAJEMEN DINAS SOSIAL</title>
    <link type="image/x-icon" href="./image/icon.png" rel="shortcut icon"></link>
	<link rel='stylesheet' href='./css/template.css' type='text/css' />
    <link rel='stylesheet' href='./css/menu.css' type='text/css' />
	<link rel='stylesheet' href='./css/style.css' type='text/css' />
	<link rel='stylesheet' href='./css/tabel.css' type='text/css' />
	<link rel='stylesheet' href='./css/button.css' type='text/css' />
	<script src='./libraries/jquery-1.4.3.js'></script>
    <link type="text/css" href="./libraries/development-bundle/themes/base/ui.all.css" rel="stylesheet" />
    <script type="text/javascript" src="./libraries/development-bundle/ui/ui.core.js"></script>
    <script type="text/javascript" src="./libraries/development-bundle/ui/ui.datepicker.js"></script>
    <script type="text/javascript" src="./libraries/development-bundle/ui/i18n/ui.datepicker-id.js"></script>
		
</head>
<body>
	<table border='0px' id='dalam' style='margin-top:0px; height:100%;'>
		<tr>
			<td>
<?php
<<<<<<< HEAD
=======
	error_reporting(E_ALL ^ E_NOTICE);
	
>>>>>>> 61b16164dbc53b4bcbd8d4faadd081d2b93a07d3
		include "./libraries/dinsos.php";
		include "./include/functions.php";
		include "./function/fungsi.php";
		
<<<<<<< HEAD
		if(!isset($_SESSION['id_pengguna'])){
			if(!isset($_GET["mod"]) || $_GET["mod"] == ""){
				include('./modules/nonlogin/login.php');
			}else if($_GET["mod"] <> ""){
				switch($_GET["mod"]){		
					case "umum" :	
								switch($_GET["do"])
								{
									case "main" :
										include('./modules/nonlogin/main.php');
										break;
									case "berita_informasi" :
										include('./modules/nonlogin/berita_informasi.php');
										break;
									case "latar_belakang" :
										include('./modules/nonlogin/latar_belakang.php');
										break;
									case "login" :
										include('./modules/nonlogin/login.php');
										break;
									case "download" :
										include('./modules/nonlogin/download.php');
										break;
									case "edit" :
										include('./modules/nonlogin/editpass.php');
										break;
									case "validasi" :
										include('./modules/nonlogin/validasi.php');
										break;
									case "change" :
										include('./modules/nonlogin/ubah.php');
										break;
									default :
										include('./modules/nonlogin/main.php');
										break;
								}
								break;
					case "home" :
								switch($_GET["opt"]){
									case "main" :
										include('./modules/nonlogin/login.php');
										break;
								}
								break;
					
				}			
			}
		}else{
			if(!isset($_GET["mod"]) || $_GET["mod"] == ""){
					// do nothing
			}else{
					
				switch($_GET["mod"]){	
							case "cp" :	
								switch($_GET["opt"])
								{
								case "main" :
									include('./modules/nonlogin/cp/main.php');
									break;
								case "utama" :
									include('./modules/nonlogin/cp/utama.php');
									break;	
								case "berita_informasi" :
									switch($_GET["opts"])
									{
										case "view" :
											include('./modules/nonlogin/cp/berita/view.php');
											break;
										case "validasi" :
											include('./modules/nonlogin/cp/berita/validasi.php');
											break;								
									}	
									break;
								case "latar_belakang" :
									switch($_GET["opts"])
									{
										case "view" :
											include('./modules/nonlogin/cp/latar_belakang/view.php');
											break;
										case "validasi" :
											include('./modules/nonlogin/cp/latar_belakang/validasi.php');
											break;								
									}
									break;
								case "download" :
									switch($_GET["opts"])
									{
										case "view" :
											include('./modules/nonlogin/cp/download/view.php');
											break;
										case "validasi" :
											include('./modules/nonlogin/cp/download/validasi.php');
											break;								
									}	
									break;
								case "user" :
									include('./modules/nonlogin/cp/user/profil.php');
									break;
								case "redirect_page" :
									include("./modules/redirect_pages/dir.php");
									break;
								case "usersimpan" :
									include('./modules/nonlogin/cp/user/simpan.php');
									break;	
								case "member" :
									switch($_GET["opts"])
									{
										case "view" :
											include('./modules/nonlogin/cp/member/view.php');
											break;
										case "validasi" :
											include('./modules/nonlogin/cp/member/validasi.php');
											break;								
									}						
									break;

								}
								break;
							case "umum" :	
								switch($_GET["do"])
								{
									case "main" :
										include('./modules/nonlogin/main.php');
										break;
									case "berita_informasi" :
										include('./modules/nonlogin/berita_informasi.php');
										break;
									case "latar_belakang" :
										include('./modules/nonlogin/latar_belakang.php');
										break;
									case "login" :
										include('./modules/nonlogin/login.php');
										break;
									case "download" :
										include('./modules/nonlogin/download.php');
										break;
									case "edit" :
										include('./modules/nonlogin/editpass.php');
										break;
									case "validasi" :
										include('./modules/nonlogin/validasi.php');
										break;
									case "change" :
										include('./modules/nonlogin/ubah.php');
										break;
									default :
										die ('Restricted Access');
								}
								break;
									
							case "jamsostek" :
								switch ($_GET["do"])
								{				
									case "main" :
										include('./modules/jamsos/menu/main.php');
										break;
									case "utama" :
										include('./modules/jamsos/menu/utama.php');
										break;	
									case "daftar" :
										include('./modules/jamsos/daftar_perusahaan/main.php');
										break;
									case "detail" :
										include('./modules/jamsos/data_perusahaan/detail.php');
										break;
									case "tenaga_kerja" :
										include('./modules/jamsos/jumlah_tenagakerja/tambah_tenagakerja.php');
										break;
									case "potensial" :
										include('./modules/jamsos/data_potensial/page.php');
										break;
									case "lg" :
										include('./modules/jamsos/logout.php');
										break;
									case "profil" :
										include('./modules/jamsos/user/profil.php');
										break;
									case "data_perusahaan" :
										include('./modules/jamsos/data_perusahaan/main.php');
										break;
									case "usersimpan" :
										include('./modules/jamsos/user/simpan.php');
										break;
									case "cetak" :
										include('./modules/jamsos/cetak_data.php');
										break;	
									case "cetak_potensial" :
										include('./modules/jamsos/cetak_data_potensial.php');
										break;		
									case "laporan" :
										include('./modules/jamsos/laporan/main_lap.php');
										break;		
									case "data_perusahaan_lap" :
										include('./modules/jamsos/laporan/data_perusahaan_lap.php');
										break;	
									case "data_potensial_lap" :
										include('./modules/jamsos/laporan/data_potensial_lap.php');
										break;														
									default :
										die ('Restricted Access');
								}
								break;
							
							case "dinsos" :
								switch ($_GET["do"])
								{				
									case "main" :
										include('./modules/dinsos/menu/main.php');
										break;
									case "utama" :
										include('./modules/dinsos/menu/utama.php');
										break;	
									case "daftar" :
										include('./modules/dinsos/daftar_perusahaan/main.php');
										break;
									case "detail" :
										include('./modules/dinsos/data_perusahaan/detail.php');
										break;
									case "tenaga_kerja" :
										include('./modules/dinsos/jumlah_tenagakerja/tambah_tenagakerja.php');
										break;
									case "potensial" :
										include('./modules/dinsos/data_potensial/page.php');
										break;
									case "lg" :
										include('./modules/dinsos/logout.php');
										break;
									case "laporan" :
										include('./modules/dinsos/laporan/laporan.php');
										break;
									case "profil" :
										include('./modules/dinsos/user/profil.php');
										break;
									case "data_perusahaan" :
										include('./modules/dinsos/data_perusahaan/main.php');
										break;
									case "usersimpan" :
										include('./modules/dinsos/user/simpan.php');
										break;
									default :
										die ('Restricted Access');
								}
								break;
							case "loket" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/loket/main.php');
										break;
									case "utama" :
										include('./modules/loket/utama.php');
										break;	
									case "daftar" :
										include('./modules/loket/daftar_perusahaan/main.php');
										break;
									case "detail" :
										include('./modules/loket/data_perusahaan/detail.php');
										break;
									case "potensial" :
										include('./modules/loket/data_potensial/page.php');
										break;
															
									case "proses_permohonan" :
										include('./modules/loket/permohonan.php');
										break;
									case "berkas_serah" :
										include('./modules/loket/berkas_serah.php');
										break;
									case "berkas_cabut" :
										include('./modules/loket/berkas_cabut.php');
										break;					
									case "penyerahan_berkas" :
										include('./modules/loket/berkas_akhir.php');
										break;
									case "berkas_lengkap" :
										include('./modules/loket/berkas_lengkap.php');
										break;
									case "lembar_disposisi" :
										include('./modules/loket/lembar_disposisi/edit.php');
										break;
									case "lembar_kendali" :
										include('./modules/loket/lbr_kendali.php');
										break;
									case "print_catatan" :
										include('./modules/loket/catatan.php');
										break;					
									case "print_resi" :
										include('./modules/loket/resi.php');
										break;	
									case "user" :
										include('./modules/loket/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/loket/user/simpan.php');
										break;
									case "data_perusahaan" :
										include('./modules/loket/data_perusahaan/main.php');
										break;	
									case "lihat_kendali" :
										include('./modules/loket/lembar_kendali/lihat.php');
										break;	
									case "cetak" :
										include('./modules/loket/cetak_data.php');
										break;	
									case "cetak_potensial" :
										include('./modules/loket/cetak_data_potensial.php');
										break;	
					//laporan						
									case "laporan" :
										include('./modules/loket/laporan/main_lap.php');
										break;		
									case "data_perusahaan_lap" :
										include('./modules/loket/laporan/data_perusahaan_lap.php');
										break;	
									case "data_potensial_lap" :
										include('./modules/loket/laporan/data_potensial_lap.php');
										break;	
									case "data_resi_lap" :
										include('./modules/loket/laporan/resi_lap.php');
										break;	
									case "lbr_kendali_lap" :
										include('./modules/loket/laporan/lbr_kendali_lap.php');
										break;	
									case "lihat_kendali_lap" :
										include('./modules/loket/laporan/lihat_lap.php');
										break;	
									case "berkas_lengkap_lap" :
										include('./modules/loket/laporan/berkas_lengkap_lap.php');
										break;	
									case "berkas_sudah_lap" :
										include('./modules/loket/laporan/berkas_sudah_lap.php');
										break;	
									case "berkas_serah_lap" :
										include('./modules/loket/laporan/berkas_serah_lap.php');
										break;		
									case "berkas_selesai_lap" :
										include('./modules/loket/laporan/berkas_selesai_lap.php');
										break;		
									case "berkas_proses_lap" :
										include('./modules/loket/laporan/berkas_proses_lap.php');
										break;		
									case "berkas_monitor" :
										include('./modules/loket/laporan/berkas_monitor.php');
										break;			
									case "berkas_arsip_lap" :
										include('./modules/loket/laporan/berkas_arsip_lap.php');
										break;	
									case "berkas_arsip_sudah_lap" :
										include('./modules/loket/laporan/berkas_arsip_sudah_lap.php');
										break;	
									case "pengaduan_lap" :
										include('./modules/loket/laporan/pengaduan_lap.php');
										break;			
									case "pengaduan_proses_lap" :
										include('./modules/loket/laporan/pengaduan_proses_lap.php');
										break;			
									case "pengaduan_mediasi_lap" :
										include('./modules/loket/laporan/pengaduan_mediasi_lap.php');
										break;		
									case "pengaduan_mediator_lap" :
										include('./modules/loket/laporan/pengaduan_mediator_lap.php');
										break;				
									case "pengaduan_selesai_lap" :
										include('./modules/loket/laporan/pengaduan_selesai_lap.php');
										break;	
									case "dpkk_lap" :
										include('./modules/loket/laporan/dpkk_lap.php');
										break;	
									case "imta_lap" :
										include('./modules/loket/laporan/imta_lap.php');
										break;	
									case "imta_habis_lap" :
										include('./modules/loket/laporan/imta_habis_lap.php');
										break;	
									case "wl_lap" :
										include('./modules/loket/laporan/wl_lap.php');
										break;
									case "wl_habis_lap" :
										include('./modules/loket/laporan/wl_habis_lap.php');
										break;	
									case "tenaga_lap" :
										include('./modules/loket/laporan/tenaga_lap.php');
										break;	
									case "pp_lap" :
										include('./modules/loket/laporan/pp_lap.php');
										break;	
									case "pp_proses_lap" :
										include('./modules/loket/laporan/pp_proses_lap.php');
										break;	
									case "pp_selesai_lap" :
										include('./modules/loket/laporan/pp_selesai_lap.php');
										break;	
									case "iplk_lap" :
										include('./modules/loket/laporan/iplk_lap.php');
										break;	
									case "iplk_proses_lap" :
										include('./modules/loket/laporan/iplk_proses_lap.php');
										break;	
									case "iplk_selesai_lap" :
										include('./modules/loket/laporan/iplk_selesai_lap.php');
										break;																																			
									default:
										die('Restricted Access Home Loket');
								}
								break;
							case "arsip" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/arsip/main.php');
										break;
									case "utama" :
										include('./modules/arsip/utama.php');
										break;
									case "pengarsipan" :
										include('./modules/arsip/pengarsipan.php');
										break;	
									case "pengarsipan_sp" :
										include('./modules/arsip/pengarsipan_sp.php');
										break;	
									case "pengrsipan_edit" :
										include('./modules/arsip/pengarsipan_edit.php');
										break;	
									case "lembar_kendali" :
										include('./modules/arsip/lbr_kendali.php');
										break;	
									case "user" :
										include('./modules/arsip/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/arsip/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/arsip/lembar_kendali/lihat.php');
										break;												
									default:
										die('Restricted Access Home Loket');
								}
								break;
							case "kasi" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/kasi/main.php');
										break;
									case "utama" :
										include('./modules/kasi/utama.php');
										break;	
									case "cek_berkas" :
										include('./modules/kasi/cek_berkas.php');
										break;
									case "paraf_surat" :
										include('./modules/kasi/paraf_surat.php');
										break;
									case "paraf_mediasi" :
										include('./modules/kasi/paraf_mediasi.php');
										break;
									case "lembar_disposisi" :
										include('./modules/kasi/lembar_disposisi/edit.php');
										break;	
									case "lembar_kendali" :
										include('./modules/kasi/lbr_kendali.php');
										break;	
									case "penugasan" :
										include('./modules/kasi/penugasan.php');
										break;
									case "user" :
										include('./modules/kasi/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/kasi/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/kasi/lembar_kendali/lihat.php');
										break;												
									default:
										die('Restricted Access');
								}
								break;
							case "sekretaris" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/sekretaris/main.php');
										break;
									case "utama" :
										include('./modules/sekretaris/utama.php');
										break;	
									case "terima_berkas" :
										include('./modules/sekretaris/terima_berkas.php');
										break;					
									case "paraf_mediasi" :
										include('./modules/sekretaris/paraf_mediasi.php');
										break;
									case "lembar_kendali" :
										include('./modules/sekretaris/lbr_kendali.php');
										break;				
									case "lembar_disposisi" :
										include('./modules/sekretaris/lembar_disposisi/edit.php');
										break;	
									case "paraf_surat" :
										include('./modules/sekretaris/paraf_surat.php');
										break;	
									case "user" :
										include('./modules/sekretaris/user/profil.php');
										break;	
									case "print_disposisi" :
										include('./modules/sekretaris/cetak_disposisi.php');
										break;		
									default:
										die('Restricted Access');
								}
								break;
							case "staf" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/staf/main.php');
										break;
									case "utama" :
										include('./modules/staf/utama.php');
										break;	
									case "cek_berkas" :
										include('./modules/staf/cek_berkas.php');
										break;
									case "cek_mediasi" :
										include('./modules/staf/cek_mediasi.php');
										break;
									case "lembar_disposisi" :
										include('./modules/staf/lembar_disposisi/edit.php');
										break;	
									case "buat_surat" :
										include('./modules/staf/buat_surat/surat.php');
										break;	
									case "lembar_kendali" :
										include('./modules/staf/lbr_kendali.php');
										break;	
									case "penugasan" :
										include('./modules/kasi/penugasan.php');
										break;	
									case "paraf_surat" :
										include('./modules/staf/paraf_surat.php');
										break;	
									case "lanjut_mediasi" :
										include('./modules/staf/paraf_surat/update.php');
										break;	
									case "user" :
										include('./modules/staf/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/staf/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/staf/lembar_kendali/lihat.php');
										break;									
									default:
										die('Restricted Access');
								}
								break;
							case "kadis" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/kadis/main.php');
										break;
									case "utama" :
										include('./modules/kadis/utama.php');
										break;	
									case "terima_berkas" :
										include('./modules/kadis/terima_berkas.php');
										break;
									case "paraf_surat" :
										include('./modules/kadis/paraf_surat.php');
										break;
									case "paraf_mediasi" :
										include('./modules/kadis/paraf_mediasi.php');
										break;
									case "lembar_disposisi" :
										include('./modules/kadis/lembar_disposisi/edit.php');
										break;
									case "lembar_kendali" :
										include('./modules/kadis/lbr_kendali.php');
										break;	
									case "penugasan" :
										include('./modules/kadis/penugasan.php');
										break;	
									case "user" :
										include('./modules/kadis/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/kadis/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/kadis/lembar_kendali/lihat.php');
										break;											
									default:
										die('Restricted Access');
								}
								break;
							case "kabidhubsaker" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/kabidhubsaker/main.php');
										break;
									case "utama" :
										include('./modules/kabidhubsaker/utama.php');
										break;	
									case "verifikasi_berkas" :
										include('./modules/kabidhubsaker/verifikasi_berkas.php');
										break;
									case "paraf_sk" :
										include('./modules/kabidhubsaker/paraf_sk.php');
										break;
									case "penugasan" :
										include('./modules/kabidhubsaker/penugasan.php');
										break;					
									case "paraf_sk_tugas" :
										include('./modules/kabidhubsaker/paraf_sk_tugas.php');
										break;						
									case "lembar_disposisi" :
										include('./modules/kabidhubsaker/lembar_disposisi/edit.php');
										break;	
									case "lembar_kendali" :
										include('./modules/kabidhubsaker/lbr_kendali.php');
										break;	
									case "tolak" :
										include('./modules/kabidhubsaker/tolak.php');
										break;	
									case "berkas_ditolak" :
										include('./modules/kabidhubsaker/berkas_ditolak.php');
										break;							
									case "paraf_mediasi" :
										include('./modules/kabidhubsaker/paraf_mediasi.php');
										break;	
									case "paraf_surat" :
										include('./modules/kabidhubsaker/paraf_surat.php');
										break;	
									case "user" :
										include('./modules/kabidhubsaker/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/kabidhubsaker/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/kabidhubsaker/lembar_kendali/lihat.php');
										break;									
									default:
										die('Restricted Access');
								}
								break;
							case "kabidpentaker" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/kabidpentaker/main.php');
										break;
									case "utama" :
										include('./modules/kabidpentaker/utama.php');
										break;	
									case "verifikasi_berkas" :
										include('./modules/kabidpentaker/verifikasi_berkas.php');
										break;
									case "paraf_imta" :
										include('./modules/kabidpentaker/paraf_imta.php');
										break;
									case "paraf_sk" :
										include('./modules/kabidpentaker/paraf_sk.php');
										break;
									case "lembar_disposisi" :
										include('./modules/kabidpentaker/lembar_disposisi/edit.php');
										break;	
									case "lembar_kendali" :
										include('./modules/kabidpentaker/lbr_kendali.php');
										break;	
									case "berkas_tolak" :
										include('./modules/kabidpentaker/berkas_tolak.php');
										break;		
									case "paraf_mediasi" :
										include('./modules/kabidpentaker/paraf_mediasi.php');
										break;	
									case "paraf_surat" :
										include('./modules/kabidpentaker/paraf_surat.php');
										break;	
									case "user" :
										include('./modules/kabidpentaker/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/kabidpentaker/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/kabidpentaker/lembar_kendali/lihat.php');
										break;									
									default:
										die('Restricted Access');
								}
								break;
							case "kasipentaker" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/kasipentaker/main.php');
										break;
									case "utama" :
										include('./modules/kasipentaker/utama.php');
										break;	
									case "cek_berkas" :
										include('./modules/kasipentaker/cek_berkas.php');
										break;
									case "paraf_surat" :
										include('./modules/kasipentaker/paraf_surat.php');
										break;
									case "paraf_sk" :
										include('./modules/kasipentaker/paraf_sk.php');
										break;
									case "berkas_tolak" :
										include('./modules/kasipentaker/berkas_tolak.php');
										break;					
									case "lembar_disposisi" :
										include('./modules/kasipentaker/lembar_disposisi/edit.php');
										break;	
									case "tim_periksa" :
										include('./modules/kasipentaker/tim_periksa/edit.php');
										break;
									case "buat_surat" :
										include('./modules/kasipentaker/tim_periksa/cetak.php');
										break;
									case "lembar_kendali" :
										include('./modules/kasipentaker/lbr_kendali.php');
										break;	
									case "penugasan" :
										include('./modules/kasipentaker/penugasan.php');
										break;	
									case "user" :
										include('./modules/kasipentaker/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/kasipentaker/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/kasipentaker/lembar_kendali/lihat.php');
										break;											
									default:
										die('Restricted Access');
								}
								break;
							case "pemeriksa" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/pemeriksa/main.php');
										break;
									case "cek_berkas" :
										include('./modules/pemeriksa/cek_berkas.php');
										break;
									case "hasil_lap" :
										include('./modules/pemeriksa/hasil_lap.php');
										break;
									case "verifikasi" :
										include('./modules/pemeriksa/verifikasi/edit.php');
										break;
									case "verifikasi_cetak" :
										include('./modules/pemeriksa/verifikasi/cetak.php');
										break;
									case "lembar_disposisi" :
										include('./modules/pemeriksa/lembar_disposisi/edit.php');
										break;	
									case "lembar_kendali" :
										include('./modules/pemeriksa/lbr_kendali.php');
										break;	
									case "teruskan" :
										include('./modules/pemeriksa/cek_berkas/teruskan.php');
										break;	
									case "user" :
										include('./modules/pemeriksa/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/pemeriksa/user/simpan.php');
										break;
									case "lihat_kendali" :
										include('./modules/pemeriksa/lembar_kendali/lihat.php');
										break;											
									default:
										die('Restricted Access Pemeriksa');
								}
								break;
							case "stafkasi" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/stafkasi/main.php');
										break;
									case "utama" :
										include('./modules/stafkasi/utama.php');
										break;	
									case "cek_berkas" :
										include('./modules/stafkasi/cek_berkas.php');
										break;
									case "cetak" :
										include('./modules/stafkasi/cek_berkas/cetak.php');
										break;
									case "cetak_ulang" :
										include('./modules/stafkasi/cetak_ulang.php');
										break;					
									case "lembar_kendali" :
										include('./modules/stafkasi/lbr_kendali.php');
										break;
									case "lembar_disposisi" :
										include('./modules/stafkasi/lembar_disposisi/edit.php');
										break;	
									case "user" :
										include('./modules/stafkasi/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/stafkasi/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/stafkasi/lembar_kendali/lihat.php');
										break;											
									default:
										die('Restricted Access STAF KASI');
								}
								break;
								
					//--------------------

							case "kabidwasnaker" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/kabidwasnaker/main.php');
										break;
									case "utama" :
										include('./modules/kabidwasnaker/utama.php');
										break;	
									case "verifikasi_berkas" :
										include('./modules/kabidwasnaker/verifikasi_berkas.php');
										break;
									case "berkas_tolak" :
										include('./modules/kabidwasnaker/berkas_tolak.php');
										break;
									case "paraf_sk" :
										include('./modules/kabidwasnaker/paraf_sk.php');
										break;
									case "lembar_disposisi" :
										include('./modules/kabidwasnaker/lembar_disposisi/edit.php');
										break;	
									case "lembar_kendali" :
										include('./modules/kabidwasnaker/lbr_kendali.php');
										break;	
									case "tolak" :
										include('./modules/kabidwasnaker/tolak.php');
										break;			
									case "paraf_surat" :
										include('./modules/kabidwasnaker/paraf_surat.php');
										break;	
									case "user" :
										include('./modules/kabidwasnaker/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/kabidwasnaker/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/kabidwasnaker/lembar_kendali/lihat.php');
										break;									
									default:
										die('Restricted Access');
								}
								break;
							case "kasiwasnaker" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/kasiwasnaker/main.php');
										break;
									case "utama" :
										include('./modules/kasiwasnaker/utama.php');
										break;	
									case "cek_berkas" :
										include('./modules/kasiwasnaker/cek_berkas.php');
										break;
									case "paraf_surat" :
										include('./modules/kasiwasnaker/paraf_surat.php');
										break;
									case "paraf_sk" :
										include('./modules/kasiwasnaker/paraf_sk.php');
										break;
									case "lembar_disposisi" :
										include('./modules/kasiwasnaker/lembar_disposisi/edit.php');
										break;	
									case "tim_periksa" :
										include('./modules/kasiwasnaker/tim_periksa/edit.php');
										break;
									case "buat_surat" :
										include('./modules/kasiwasnaker/tim_periksa/cetak.php');
										break;
									case "lembar_kendali" :
										include('./modules/kasiwasnaker/lbr_kendali.php');
										break;	
									case "berkas_tolak" :
										include('./modules/kasiwasnaker/berkas_tolak.php');
										break;	
									case "penugasan" :
										include('./modules/kasiwasnaker/penugasan.php');
										break;							
									case "user" :
										include('./modules/kasiwasnaker/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/kasiwasnaker/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/kasiwasnaker/lembar_kendali/lihat.php');
										break;										
									default:
										die('Restricted Access');
								}
								break;
							case "pengawas" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/pengawas/main.php');
										break;
									case "cek_berkas" :
										include('./modules/pengawas/cek_berkas.php');
										break;
									case "hasil_lap" :
										include('./modules/pengawas/hasil_lap.php');
										break;
									case "verifikasi" :
										include('./modules/pengawas/verifikasi/edit.php');
										break;
									case "verifikasi_cetak" :
										include('./modules/pengawas/verifikasi/cetak.php');
										break;
									case "lembar_disposisi" :
										include('./modules/pengawas/lembar_disposisi/edit.php');
										break;	
									case "lembar_kendali" :
										include('./modules/pengawas/lbr_kendali.php');
										break;	
									case "teruskan" :
										include('./modules/pengawas/cek_berkas/teruskan.php');
										break;	
									case "user" :
										include('./modules/pengawas/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/pengawas/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/pengawas/lembar_kendali/lihat.php');
										break;											
									default:
										die('Restricted Access Pemeriksa');
								}
								break;
							case "stafkasiwasnaker" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/stafkasiwasnaker/main.php');
										break;
									case "utama" :
										include('./modules/stafkasiwasnaker/utama.php');
										break;	
									case "cek_berkas" :
										include('./modules/stafkasiwasnaker/cek_berkas.php');
										break;
									case "cetak" :
										include('./modules/stafkasiwasnaker/cek_berkas/cetak.php');
										break;
									case "lembar_kendali" :
										include('./modules/stafkasiwasnaker/lbr_kendali.php');
										break;
									case "lembar_disposisi" :
										include('./modules/stafkasiwasnaker/lembar_disposisi/edit.php');
										break;	
									case "user" :
										include('./modules/stafkasiwasnaker/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/stafkasiwasnaker/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/stafkasiwasnaker/lembar_kendali/lihat.php');
										break;	
									case "cetak_ulang" :
										include('./modules/stafkasiwasnaker/cetak_ulang.php');
										break;															
									default:
										die('Restricted Access STAF KASI');
								}
								break;
							//kasi hubsaker
							case "kasihubsaker" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/kasihubsaker/main.php');
										break;
									case "utama" :
										include('./modules/kasihubsaker/utama.php');
										break;	
									case "cek_berkas" :
										include('./modules/kasihubsaker/cek_berkas.php');
										break;
									case "paraf_surat" :
										include('./modules/kasihubsaker/paraf_surat.php');
										break;
									case "paraf_sk" :
										include('./modules/kasihubsaker/paraf_sk.php');
										break;
									
									case "lembar_disposisi" :
										include('./modules/kasihubsaker/lembar_disposisi/edit.php');
										break;	
									case "tim_periksa" :
										include('./modules/kasihubsaker/tim_periksa/edit.php');
										break;
									case "buat_surat" :
										include('./modules/kasihubsaker/tim_periksa/cetak.php');
										break;
									case "lembar_kendali" :
										include('./modules/kasihubsaker/lbr_kendali.php');
										break;	
									case "berkas_tolak" :
										include('./modules/kasihubsaker/berkas_tolak.php');
										break;	
									case "penugasan" :
										include('./modules/kasihubsaker/penugasan.php');
										break;							
									case "user" :
										include('./modules/kasihubsaker/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/kasihubsaker/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/kasihubsaker/lembar_kendali/lihat.php');
										break;										
									default:
										die('Restricted Access');
								}
								break;

							//staf kasihubsaker
							case "stafkasihubsaker" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/stafkasihubsaker/main.php');
										break;
									case "utama" :
										include('./modules/kabidlatih/utama.php');
										break;	
									case "cek_berkas" :
										include('./modules/stafkasihubsaker/cek_berkas.php');
										break;
									case "cetak" :
										include('./modules/stafkasihubsaker/cek_berkas/cetak.php');
										break;
									case "lembar_kendali" :
										include('./modules/stafkasihubsaker/lbr_kendali.php');
										break;
									case "lembar_disposisi" :
										include('./modules/stafkasihubsaker/lembar_disposisi/edit.php');
										break;	
									case "user" :
										include('./modules/stafkasihubsaker/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/stafkasihubsaker/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/stafkasihubsaker/lembar_kendali/lihat.php');
										break;	
									case "cetak_ulang" :
										include('./modules/stafkasihubsaker/cetak_ulang.php');
										break;															
									default:
										die('Restricted Access STAF KASI');
								}
								break;
							case "peninjau" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/peninjau/main.php');
										break;
									case "cek_berkas" :
										include('./modules/peninjau/cek_berkas.php');
										break;
									case "hasil_lap" :
										include('./modules/peninjau/hasil_lap.php');
										break;
									case "verifikasi" :
										include('./modules/peninjau/verifikasi/edit.php');
										break;
									case "verifikasi_cetak" :
										include('./modules/peninjau/verifikasi/cetak.php');
										break;
									case "lembar_disposisi" :
										include('./modules/peninjau/lembar_disposisi/edit.php');
										break;	
									case "lembar_kendali" :
										include('./modules/peninjau/lbr_kendali.php');
										break;	
									case "teruskan" :
										include('./modules/peninjau/cek_berkas/teruskan.php');
										break;	
									case "user" :
										include('./modules/peninjau/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/peninjau/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/peninjau/lembar_kendali/lihat.php');
										break;											
									default:
										die('Restricted Access');
								}
								break;			
							case "pemantau" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/pemantau/main.php');
										break;
									case "cek_berkas" :
										include('./modules/pemantau/cek_berkas.php');
										break;
									case "hasil_lap" :
										include('./modules/pemantau/hasil_lap.php');
										break;
									case "verifikasi" :
										include('./modules/pemantau/verifikasi/edit.php');
										break;
									case "verifikasi_cetak" :
										include('./modules/pemantau/verifikasi/cetak.php');
										break;
									case "lembar_disposisi" :
										include('./modules/pemantau/lembar_disposisi/edit.php');
										break;	
									case "lembar_kendali" :
										include('./modules/pemantau/lbr_kendali.php');
										break;	
									case "teruskan" :
										include('./modules/pemantau/cek_berkas/teruskan.php');
										break;	
									case "user" :
										include('./modules/pemantau/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/pemantau/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/pemantau/lembar_kendali/lihat.php');
										break;											
									default:
										die('Restricted Access');
								}
								break;						
					//----------------kabidlatih----
							case "kabidlatih" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/kabidlatih/main.php');
										break;
									case "utama" :
										include('./modules/kabidlatih/utama.php');
										break;	
									case "verifikasi_berkas" :
										include('./modules/kabidlatih/verifikasi_berkas.php');
										break;
									case "berkas_tolak" :
										include('./modules/kabidlatih/berkas_tolak.php');
										break;
									case "paraf_sk" :
										include('./modules/kabidlatih/paraf_sk.php');
										break;
									case "penugasan" :
										include('./modules/kabidlatih/penugasan.php');
										break;					
									case "lembar_disposisi" :
										include('./modules/kabidlatih/lembar_disposisi/edit.php');
										break;	
									case "lembar_kendali" :
										include('./modules/kabidlatih/lbr_kendali.php');
										break;	
									case "tolak" :
										include('./modules/kabidlatih/tolak.php');
										break;			
									case "paraf_surat" :
										include('./modules/kabidlatih/paraf_surat.php');
										break;	
									case "user" :
										include('./modules/kabidlatih/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/kabidlatih/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/kabidlatih/lembar_kendali/lihat.php');
										break;									
									default:
										die('Restricted Access');
								}
								break;			
					//------------kasilatih--------		
							case "kasilatih" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/kasilatih/main.php');
										break;
									case "utama" :
										include('./modules/kasilatih/utama.php');
										break;	
									case "cek_berkas" :
										include('./modules/kasilatih/cek_berkas.php');
										break;
									case "paraf_surat" :
										include('./modules/kasilatih/paraf_surat.php');
										break;
									case "paraf_sk" :
										include('./modules/kasilatih/paraf_sk.php');
										break;
									case "lembar_disposisi" :
										include('./modules/kasilatih/lembar_disposisi/edit.php');
										break;	
									case "tim_periksa" :
										include('./modules/kasilatih/tim_periksa/edit.php');
										break;
									case "buat_surat" :
										include('./modules/kasilatih/tim_periksa/cetak.php');
										break;
									case "lembar_kendali" :
										include('./modules/kasilatih/lbr_kendali.php');
										break;	
									case "berkas_tolak" :
										include('./modules/kasilatih/berkas_tolak.php');
										break;	
									case "penugasan" :
										include('./modules/kasilatih/penugasan.php');
										break;							
									case "user" :
										include('./modules/kasilatih/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/kasilatih/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/kasilatih/lembar_kendali/lihat.php');
										break;										
									default:
										die('Restricted Access');
								}
								break;

							//staf kasilatih
							case "stafkasilatih" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/stafkasilatih/main.php');
										break;
									case "utama" :
										include('./modules/stafkasilatih/utama.php');
										break;	
									case "cek_berkas" :
										include('./modules/stafkasilatih/cek_berkas.php');
										break;
									case "cetak" :
										include('./modules/stafkasilatih/cek_berkas/cetak.php');
										break;
									case "lembar_kendali" :
										include('./modules/stafkasilatih/lbr_kendali.php');
										break;
									case "lembar_disposisi" :
										include('./modules/stafkasilatih/lembar_disposisi/edit.php');
										break;	
									case "user" :
										include('./modules/stafkasilatih/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/stafkasilatih/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/stafkasilatih/lembar_kendali/lihat.php');
										break;	
									case "cetak_ulang" :
										include('./modules/stafkasilatih/cetak_ulang.php');
										break;															
									default:
										die('Restricted Access STAF KASI');
								}
								break;	
								
							case "kasubag_umum" :
								switch ($_GET["opt"])
								{
									case "main" :
										include('./modules/kasubag_umum/main.php');
										break;
									case "utama" :
										include('./modules/kasubag_umum/utama.php');
										break;	
									case "cek_berkas" :
										include('./modules/kasubag_umum/cek_berkas.php');
										break;	
									case "penomoran_surat" :
										include('./modules/kasubag_umum/penomoran_surat.php');
										break;	
									case "penomoran_sk" :
										include('./modules/kasubag_umum/penomoran_sk.php');
										break;		
									case "lembar_disposisi" :
										include('./modules/kasubag_umum/lembar_disposisi/edit.php');
										break;		
									case "lembar_kendali" :
										include('./modules/kasubag_umum/lbr_kendali.php');
										break;		
									case "user" :
										include('./modules/kasubag_umum/user/profil.php');
										break;	
									case "usersimpan" :
										include('./modules/kasubag_umum/user/simpan.php');
										break;	
									case "lihat_kendali" :
										include('./modules/kasubag_umum/lembar_kendali/lihat.php');
										break;					
									default:
										die('Restricted Access Home Kasubag Umum');
								}
								break;
							case "auth" :
								switch ($_GET["opt"])
								{
									case "logout" :
										include('./modules/nonlogin/logout.php');
										break;					
									default:
										die('Restricted Access');
								}
								break;
							default:
								die('Dilarang Masuk');
								default:
									include('./modules/nonlogin/main.php');
							}

				
					
			}	
				
			
		}
		
		
=======
		switch($_GET["mod"])
		{	
		case "cp" :	
			switch($_GET["opt"])
			{
			case "main" :
				include('./modules/nonlogin/cp/main.php');
				break;
			case "berita_informasi" :
				switch($_GET["opts"])
				{
					case "view" :
						include('./modules/nonlogin/cp/berita/view.php');
						break;
					case "validasi" :
						include('./modules/nonlogin/cp/berita/validasi.php');
						break;								
				}	
				break;
			case "latar_belakang" :
				switch($_GET["opts"])
				{
					case "view" :
						include('./modules/nonlogin/cp/latar_belakang/view.php');
						break;
					case "validasi" :
						include('./modules/nonlogin/cp/latar_belakang/validasi.php');
						break;								
				}
				break;
			case "download" :
				switch($_GET["opts"])
				{
					case "view" :
						include('./modules/nonlogin/cp/download/view.php');
						break;
					case "validasi" :
						include('./modules/nonlogin/cp/download/validasi.php');
						break;								
				}	
				break;
			case "user" :
				include('./modules/nonlogin/cp/user/profil.php');
				break;	
			case "usersimpan" :
				include('./modules/nonlogin/cp/user/simpan.php');
				break;	
			case "member" :
				switch($_GET["opts"])
				{
					case "view" :
						include('./modules/nonlogin/cp/member/view.php');
						break;
					case "validasi" :
						include('./modules/nonlogin/cp/member/validasi.php');
						break;								
				}						
				break;

			}
			break;
		case "umum" :	
			switch($_GET["do"])
			{
				case "main" :
					include('./modules/nonlogin/main.php');
					break;
				case "berita_informasi" :
					include('./modules/nonlogin/berita_informasi.php');
					break;
				case "latar_belakang" :
					include('./modules/nonlogin/latar_belakang.php');
					break;
				case "login" :
					include('./modules/nonlogin/login.php');
					break;
				case "download" :
					include('./modules/nonlogin/download.php');
					break;
				case "edit" :
					include('./modules/nonlogin/editpass.php');
					break;
				case "validasi" :
					include('./modules/nonlogin/validasi.php');
					break;
				case "change" :
					include('./modules/nonlogin/ubah.php');
					break;
				default :
					die ('Restricted Access');
			}
			break;
				
		case "jamsostek" :
			switch ($_GET["do"])
			{				
				case "main" :
					include('./modules/jamsos/menu/main.php');
					break;
				case "daftar" :
					include('./modules/jamsos/daftar_perusahaan/main.php');
					break;
				case "detail" :
					include('./modules/jamsos/data_perusahaan/detail.php');
					break;
				case "tenaga_kerja" :
					include('./modules/jamsos/jumlah_tenagakerja/tambah_tenagakerja.php');
					break;
				case "potensial" :
					include('./modules/jamsos/data_potensial/page.php');
					break;
				case "lg" :
					include('./modules/jamsos/logout.php');
					break;
				case "profil" :
					include('./modules/jamsos/user/profil.php');
					break;
				case "data_perusahaan" :
					include('./modules/jamsos/data_perusahaan/main.php');
					break;
				case "usersimpan" :
					include('./modules/jamsos/user/simpan.php');
					break;
				case "cetak" :
					include('./modules/jamsos/cetak_data.php');
					break;	
				case "cetak_potensial" :
					include('./modules/jamsos/cetak_data_potensial.php');
					break;		
				case "laporan" :
					include('./modules/jamsos/laporan/main_lap.php');
					break;		
				case "data_perusahaan_lap" :
					include('./modules/jamsos/laporan/data_perusahaan_lap.php');
					break;	
				case "data_potensial_lap" :
					include('./modules/jamsos/laporan/data_potensial_lap.php');
					break;														
				default :
					die ('Restricted Access');
			}
			break;
		
		case "dinsos" :
			switch ($_GET["do"])
			{				
				case "main" :
					include('./modules/dinsos/menu/main.php');
					break;
				case "daftar" :
					include('./modules/dinsos/daftar_perusahaan/main.php');
					break;
				case "detail" :
					include('./modules/dinsos/data_perusahaan/detail.php');
					break;
				case "tenaga_kerja" :
					include('./modules/dinsos/jumlah_tenagakerja/tambah_tenagakerja.php');
					break;
				case "potensial" :
					include('./modules/dinsos/data_potensial/page.php');
					break;
				case "lg" :
					include('./modules/dinsos/logout.php');
					break;
				case "laporan" :
					include('./modules/dinsos/laporan/laporan.php');
					break;
				case "profil" :
					include('./modules/dinsos/user/profil.php');
					break;
				case "data_perusahaan" :
					include('./modules/dinsos/data_perusahaan/main.php');
					break;
				case "usersimpan" :
					include('./modules/dinsos/user/simpan.php');
					break;
				default :
					die ('Restricted Access');
			}
			break;
		case "loket" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/loket/main.php');
					break;
					
				case "daftar" :
					include('./modules/loket/daftar_perusahaan/main.php');
					break;
				case "detail" :
					include('./modules/loket/data_perusahaan/detail.php');
					break;
				case "potensial" :
					include('./modules/loket/data_potensial/page.php');
					break;
										
				case "proses_permohonan" :
					include('./modules/loket/permohonan.php');
					break;
				case "berkas_serah" :
					include('./modules/loket/berkas_serah.php');
					break;
				case "berkas_cabut" :
					include('./modules/loket/berkas_cabut.php');
					break;					
				case "penyerahan_berkas" :
					include('./modules/loket/berkas_akhir.php');
					break;
				case "berkas_lengkap" :
					include('./modules/loket/berkas_lengkap.php');
					break;
				case "lembar_disposisi" :
					include('./modules/loket/lembar_disposisi/edit.php');
					break;
				case "lembar_kendali" :
					include('./modules/loket/lbr_kendali.php');
					break;
				case "print_catatan" :
					include('./modules/loket/catatan.php');
					break;					
				case "print_resi" :
					include('./modules/loket/resi.php');
					break;	
				case "user" :
					include('./modules/loket/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/loket/user/simpan.php');
					break;
				case "data_perusahaan" :
					include('./modules/loket/data_perusahaan/main.php');
					break;	
				case "lihat_kendali" :
					include('./modules/loket/lembar_kendali/lihat.php');
					break;	
				case "cetak" :
					include('./modules/loket/cetak_data.php');
					break;	
				case "cetak_potensial" :
					include('./modules/loket/cetak_data_potensial.php');
					break;	
//laporan						
				case "laporan" :
					include('./modules/loket/laporan/main_lap.php');
					break;		
				case "data_perusahaan_lap" :
					include('./modules/loket/laporan/data_perusahaan_lap.php');
					break;	
				case "data_potensial_lap" :
					include('./modules/loket/laporan/data_potensial_lap.php');
					break;	
				case "data_resi_lap" :
					include('./modules/loket/laporan/resi_lap.php');
					break;	
				case "lbr_kendali_lap" :
					include('./modules/loket/laporan/lbr_kendali_lap.php');
					break;	
				case "lihat_kendali_lap" :
					include('./modules/loket/laporan/lihat_lap.php');
					break;	
				case "berkas_lengkap_lap" :
					include('./modules/loket/laporan/berkas_lengkap_lap.php');
					break;	
				case "berkas_sudah_lap" :
					include('./modules/loket/laporan/berkas_sudah_lap.php');
					break;	
				case "berkas_serah_lap" :
					include('./modules/loket/laporan/berkas_serah_lap.php');
					break;		
				case "berkas_selesai_lap" :
					include('./modules/loket/laporan/berkas_selesai_lap.php');
					break;		
				case "berkas_proses_lap" :
					include('./modules/loket/laporan/berkas_proses_lap.php');
					break;		
				case "berkas_monitor" :
					include('./modules/loket/laporan/berkas_monitor.php');
					break;			
				case "berkas_arsip_lap" :
					include('./modules/loket/laporan/berkas_arsip_lap.php');
					break;	
				case "berkas_arsip_sudah_lap" :
					include('./modules/loket/laporan/berkas_arsip_sudah_lap.php');
					break;	
				case "pengaduan_lap" :
					include('./modules/loket/laporan/pengaduan_lap.php');
					break;			
				case "pengaduan_proses_lap" :
					include('./modules/loket/laporan/pengaduan_proses_lap.php');
					break;			
				case "pengaduan_mediasi_lap" :
					include('./modules/loket/laporan/pengaduan_mediasi_lap.php');
					break;		
				case "pengaduan_mediator_lap" :
					include('./modules/loket/laporan/pengaduan_mediator_lap.php');
					break;				
				case "pengaduan_selesai_lap" :
					include('./modules/loket/laporan/pengaduan_selesai_lap.php');
					break;	
				case "dpkk_lap" :
					include('./modules/loket/laporan/dpkk_lap.php');
					break;	
				case "imta_lap" :
					include('./modules/loket/laporan/imta_lap.php');
					break;	
				case "imta_habis_lap" :
					include('./modules/loket/laporan/imta_habis_lap.php');
					break;	
				case "wl_lap" :
					include('./modules/loket/laporan/wl_lap.php');
					break;
				case "wl_habis_lap" :
					include('./modules/loket/laporan/wl_habis_lap.php');
					break;	
				case "tenaga_lap" :
					include('./modules/loket/laporan/tenaga_lap.php');
					break;	
				case "pp_lap" :
					include('./modules/loket/laporan/pp_lap.php');
					break;	
				case "pp_proses_lap" :
					include('./modules/loket/laporan/pp_proses_lap.php');
					break;	
				case "pp_selesai_lap" :
					include('./modules/loket/laporan/pp_selesai_lap.php');
					break;	
				case "iplk_lap" :
					include('./modules/loket/laporan/iplk_lap.php');
					break;	
				case "iplk_proses_lap" :
					include('./modules/loket/laporan/iplk_proses_lap.php');
					break;	
				case "iplk_selesai_lap" :
					include('./modules/loket/laporan/iplk_selesai_lap.php');
					break;																																			
				default:
					die('Restricted Access Home Loket');
			}
			break;
		case "arsip" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/arsip/main.php');
					break;
				case "pengarsipan" :
					include('./modules/arsip/pengarsipan.php');
					break;	
				case "pengarsipan_sp" :
					include('./modules/arsip/pengarsipan_sp.php');
					break;	
				case "pengrsipan_edit" :
					include('./modules/arsip/pengarsipan_edit.php');
					break;	
				case "lembar_kendali" :
					include('./modules/arsip/lbr_kendali.php');
					break;	
				case "user" :
					include('./modules/arsip/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/arsip/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/arsip/lembar_kendali/lihat.php');
					break;												
				default:
					die('Restricted Access Home Loket');
			}
			break;
		case "kasi" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/kasi/main.php');
					break;
				case "cek_berkas" :
					include('./modules/kasi/cek_berkas.php');
					break;
				case "paraf_surat" :
					include('./modules/kasi/paraf_surat.php');
					break;
				case "paraf_mediasi" :
					include('./modules/kasi/paraf_mediasi.php');
					break;
				case "lembar_disposisi" :
					include('./modules/kasi/lembar_disposisi/edit.php');
					break;	
				case "lembar_kendali" :
					include('./modules/kasi/lbr_kendali.php');
					break;	
				case "penugasan" :
					include('./modules/kasi/penugasan.php');
					break;
				case "user" :
					include('./modules/kasi/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/kasi/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/kasi/lembar_kendali/lihat.php');
					break;												
				default:
					die('Restricted Access');
			}
			break;
		case "sekretaris" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/sekretaris/main.php');
					break;
				case "terima_berkas" :
					include('./modules/sekretaris/terima_berkas.php');
					break;					
				case "paraf_mediasi" :
					include('./modules/sekretaris/paraf_mediasi.php');
					break;
				case "lembar_kendali" :
					include('./modules/sekretaris/lbr_kendali.php');
					break;				
				case "lembar_disposisi" :
					include('./modules/sekretaris/lembar_disposisi/edit.php');
					break;	
				case "paraf_surat" :
					include('./modules/sekretaris/paraf_surat.php');
					break;	
				case "user" :
					include('./modules/sekretaris/user/profil.php');
					break;	
				case "print_disposisi" :
					include('./modules/sekretaris/cetak_disposisi.php');
					break;		
				default:
					die('Restricted Access');
			}
			break;
		case "staf" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/staf/main.php');
					break;
				case "cek_berkas" :
					include('./modules/staf/cek_berkas.php');
					break;
				case "cek_mediasi" :
					include('./modules/staf/cek_mediasi.php');
					break;
				case "lembar_disposisi" :
					include('./modules/staf/lembar_disposisi/edit.php');
					break;	
				case "buat_surat" :
					include('./modules/staf/buat_surat/surat.php');
					break;	
				case "lembar_kendali" :
					include('./modules/staf/lbr_kendali.php');
					break;	
				case "penugasan" :
					include('./modules/kasi/penugasan.php');
					break;	
				case "paraf_surat" :
					include('./modules/staf/paraf_surat.php');
					break;	
				case "lanjut_mediasi" :
					include('./modules/staf/paraf_surat/update.php');
					break;	
				case "user" :
					include('./modules/staf/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/staf/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/staf/lembar_kendali/lihat.php');
					break;									
				default:
					die('Restricted Access');
			}
			break;
		case "kadis" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/kadis/main.php');
					break;
				case "terima_berkas" :
					include('./modules/kadis/terima_berkas.php');
					break;
				case "paraf_surat" :
					include('./modules/kadis/paraf_surat.php');
					break;
				case "paraf_mediasi" :
					include('./modules/kadis/paraf_mediasi.php');
					break;
				case "lembar_disposisi" :
					include('./modules/kadis/lembar_disposisi/edit.php');
					break;
				case "lembar_kendali" :
					include('./modules/kadis/lbr_kendali.php');
					break;	
				case "penugasan" :
					include('./modules/kadis/penugasan.php');
					break;	
				case "user" :
					include('./modules/kadis/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/kadis/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/kadis/lembar_kendali/lihat.php');
					break;											
				default:
					die('Restricted Access');
			}
			break;
		case "kabidhubsaker" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/kabidhubsaker/main.php');
					break;
				case "verifikasi_berkas" :
					include('./modules/kabidhubsaker/verifikasi_berkas.php');
					break;
				case "paraf_sk" :
					include('./modules/kabidhubsaker/paraf_sk.php');
					break;
				case "penugasan" :
					include('./modules/kabidhubsaker/penugasan.php');
					break;					
				case "paraf_sk_tugas" :
					include('./modules/kabidhubsaker/paraf_sk_tugas.php');
					break;						
				case "lembar_disposisi" :
					include('./modules/kabidhubsaker/lembar_disposisi/edit.php');
					break;	
				case "lembar_kendali" :
					include('./modules/kabidhubsaker/lbr_kendali.php');
					break;	
				case "tolak" :
					include('./modules/kabidhubsaker/tolak.php');
					break;	
				case "berkas_ditolak" :
					include('./modules/kabidhubsaker/berkas_ditolak.php');
					break;							
				case "paraf_mediasi" :
					include('./modules/kabidhubsaker/paraf_mediasi.php');
					break;	
				case "paraf_surat" :
					include('./modules/kabidhubsaker/paraf_surat.php');
					break;	
				case "user" :
					include('./modules/kabidhubsaker/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/kabidhubsaker/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/kabidhubsaker/lembar_kendali/lihat.php');
					break;									
				default:
					die('Restricted Access');
			}
			break;
		case "kabidpentaker" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/kabidpentaker/main.php');
					break;
				case "verifikasi_berkas" :
					include('./modules/kabidpentaker/verifikasi_berkas.php');
					break;
				case "paraf_imta" :
					include('./modules/kabidpentaker/paraf_imta.php');
					break;
				case "paraf_sk" :
					include('./modules/kabidpentaker/paraf_sk.php');
					break;
				case "lembar_disposisi" :
					include('./modules/kabidpentaker/lembar_disposisi/edit.php');
					break;	
				case "lembar_kendali" :
					include('./modules/kabidpentaker/lbr_kendali.php');
					break;	
				case "berkas_tolak" :
					include('./modules/kabidpentaker/berkas_tolak.php');
					break;		
				case "paraf_mediasi" :
					include('./modules/kabidpentaker/paraf_mediasi.php');
					break;	
				case "paraf_surat" :
					include('./modules/kabidpentaker/paraf_surat.php');
					break;	
				case "user" :
					include('./modules/kabidpentaker/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/kabidpentaker/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/kabidpentaker/lembar_kendali/lihat.php');
					break;									
				default:
					die('Restricted Access');
			}
			break;
		case "kasipentaker" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/kasipentaker/main.php');
					break;
				case "cek_berkas" :
					include('./modules/kasipentaker/cek_berkas.php');
					break;
				case "paraf_surat" :
					include('./modules/kasipentaker/paraf_surat.php');
					break;
				case "paraf_sk" :
					include('./modules/kasipentaker/paraf_sk.php');
					break;
				case "berkas_tolak" :
					include('./modules/kasipentaker/berkas_tolak.php');
					break;					
				case "lembar_disposisi" :
					include('./modules/kasipentaker/lembar_disposisi/edit.php');
					break;	
				case "tim_periksa" :
					include('./modules/kasipentaker/tim_periksa/edit.php');
					break;
				case "buat_surat" :
					include('./modules/kasipentaker/tim_periksa/cetak.php');
					break;
				case "lembar_kendali" :
					include('./modules/kasipentaker/lbr_kendali.php');
					break;	
				case "penugasan" :
					include('./modules/kasipentaker/penugasan.php');
					break;	
				case "user" :
					include('./modules/kasipentaker/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/kasipentaker/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/kasipentaker/lembar_kendali/lihat.php');
					break;											
				default:
					die('Restricted Access');
			}
			break;
		case "pemeriksa" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/pemeriksa/main.php');
					break;
				case "cek_berkas" :
					include('./modules/pemeriksa/cek_berkas.php');
					break;
				case "hasil_lap" :
					include('./modules/pemeriksa/hasil_lap.php');
					break;
				case "verifikasi" :
					include('./modules/pemeriksa/verifikasi/edit.php');
					break;
				case "verifikasi_cetak" :
					include('./modules/pemeriksa/verifikasi/cetak.php');
					break;
				case "lembar_disposisi" :
					include('./modules/pemeriksa/lembar_disposisi/edit.php');
					break;	
				case "lembar_kendali" :
					include('./modules/pemeriksa/lbr_kendali.php');
					break;	
				case "teruskan" :
					include('./modules/pemeriksa/cek_berkas/teruskan.php');
					break;	
				case "user" :
					include('./modules/pemeriksa/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/pemeriksa/user/simpan.php');
					break;
				case "lihat_kendali" :
					include('./modules/pemeriksa/lembar_kendali/lihat.php');
					break;											
				default:
					die('Restricted Access Pemeriksa');
			}
			break;
		case "stafkasi" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/stafkasi/main.php');
					break;
				case "cek_berkas" :
					include('./modules/stafkasi/cek_berkas.php');
					break;
				case "cetak" :
					include('./modules/stafkasi/cek_berkas/cetak.php');
					break;
				case "cetak_ulang" :
					include('./modules/stafkasi/cetak_ulang.php');
					break;					
				case "lembar_kendali" :
					include('./modules/stafkasi/lbr_kendali.php');
					break;
				case "lembar_disposisi" :
					include('./modules/stafkasi/lembar_disposisi/edit.php');
					break;	
				case "user" :
					include('./modules/stafkasi/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/stafkasi/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/stafkasi/lembar_kendali/lihat.php');
					break;											
				default:
					die('Restricted Access STAF KASI');
			}
			break;
			
//--------------------

		case "kabidwasnaker" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/kabidwasnaker/main.php');
					break;
				case "verifikasi_berkas" :
					include('./modules/kabidwasnaker/verifikasi_berkas.php');
					break;
				case "berkas_tolak" :
					include('./modules/kabidwasnaker/berkas_tolak.php');
					break;
				case "paraf_sk" :
					include('./modules/kabidwasnaker/paraf_sk.php');
					break;
				case "lembar_disposisi" :
					include('./modules/kabidwasnaker/lembar_disposisi/edit.php');
					break;	
				case "lembar_kendali" :
					include('./modules/kabidwasnaker/lbr_kendali.php');
					break;	
				case "tolak" :
					include('./modules/kabidwasnaker/tolak.php');
					break;			
				case "paraf_surat" :
					include('./modules/kabidwasnaker/paraf_surat.php');
					break;	
				case "user" :
					include('./modules/kabidwasnaker/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/kabidwasnaker/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/kabidwasnaker/lembar_kendali/lihat.php');
					break;									
				default:
					die('Restricted Access');
			}
			break;
		case "kasiwasnaker" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/kasiwasnaker/main.php');
					break;
				case "cek_berkas" :
					include('./modules/kasiwasnaker/cek_berkas.php');
					break;
				case "paraf_surat" :
					include('./modules/kasiwasnaker/paraf_surat.php');
					break;
				case "paraf_sk" :
					include('./modules/kasiwasnaker/paraf_sk.php');
					break;
				case "lembar_disposisi" :
					include('./modules/kasiwasnaker/lembar_disposisi/edit.php');
					break;	
				case "tim_periksa" :
					include('./modules/kasiwasnaker/tim_periksa/edit.php');
					break;
				case "buat_surat" :
					include('./modules/kasiwasnaker/tim_periksa/cetak.php');
					break;
				case "lembar_kendali" :
					include('./modules/kasiwasnaker/lbr_kendali.php');
					break;	
				case "berkas_tolak" :
					include('./modules/kasiwasnaker/berkas_tolak.php');
					break;	
				case "penugasan" :
					include('./modules/kasiwasnaker/penugasan.php');
					break;							
				case "user" :
					include('./modules/kasiwasnaker/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/kasiwasnaker/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/kasiwasnaker/lembar_kendali/lihat.php');
					break;										
				default:
					die('Restricted Access');
			}
			break;
		case "pengawas" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/pengawas/main.php');
					break;
				case "cek_berkas" :
					include('./modules/pengawas/cek_berkas.php');
					break;
				case "hasil_lap" :
					include('./modules/pengawas/hasil_lap.php');
					break;
				case "verifikasi" :
					include('./modules/pengawas/verifikasi/edit.php');
					break;
				case "verifikasi_cetak" :
					include('./modules/pengawas/verifikasi/cetak.php');
					break;
				case "lembar_disposisi" :
					include('./modules/pengawas/lembar_disposisi/edit.php');
					break;	
				case "lembar_kendali" :
					include('./modules/pengawas/lbr_kendali.php');
					break;	
				case "teruskan" :
					include('./modules/pengawas/cek_berkas/teruskan.php');
					break;	
				case "user" :
					include('./modules/pengawas/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/pengawas/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/pengawas/lembar_kendali/lihat.php');
					break;											
				default:
					die('Restricted Access Pemeriksa');
			}
			break;
		case "stafkasiwasnaker" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/stafkasiwasnaker/main.php');
					break;
				case "cek_berkas" :
					include('./modules/stafkasiwasnaker/cek_berkas.php');
					break;
				case "cetak" :
					include('./modules/stafkasiwasnaker/cek_berkas/cetak.php');
					break;
				case "lembar_kendali" :
					include('./modules/stafkasiwasnaker/lbr_kendali.php');
					break;
				case "lembar_disposisi" :
					include('./modules/stafkasiwasnaker/lembar_disposisi/edit.php');
					break;	
				case "user" :
					include('./modules/stafkasiwasnaker/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/stafkasiwasnaker/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/stafkasiwasnaker/lembar_kendali/lihat.php');
					break;	
				case "cetak_ulang" :
					include('./modules/stafkasiwasnaker/cetak_ulang.php');
					break;															
				default:
					die('Restricted Access STAF KASI');
			}
			break;
		//kasi hubsaker
		case "kasihubsaker" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/kasihubsaker/main.php');
					break;
				case "cek_berkas" :
					include('./modules/kasihubsaker/cek_berkas.php');
					break;
				case "paraf_surat" :
					include('./modules/kasihubsaker/paraf_surat.php');
					break;
				case "paraf_sk" :
					include('./modules/kasihubsaker/paraf_sk.php');
					break;
				
				case "lembar_disposisi" :
					include('./modules/kasihubsaker/lembar_disposisi/edit.php');
					break;	
				case "tim_periksa" :
					include('./modules/kasihubsaker/tim_periksa/edit.php');
					break;
				case "buat_surat" :
					include('./modules/kasihubsaker/tim_periksa/cetak.php');
					break;
				case "lembar_kendali" :
					include('./modules/kasihubsaker/lbr_kendali.php');
					break;	
				case "berkas_tolak" :
					include('./modules/kasihubsaker/berkas_tolak.php');
					break;	
				case "penugasan" :
					include('./modules/kasihubsaker/penugasan.php');
					break;							
				case "user" :
					include('./modules/kasihubsaker/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/kasihubsaker/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/kasihubsaker/lembar_kendali/lihat.php');
					break;										
				default:
					die('Restricted Access');
			}
			break;

		//staf kasihubsaker
		case "stafkasihubsaker" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/stafkasihubsaker/main.php');
					break;
				case "cek_berkas" :
					include('./modules/stafkasihubsaker/cek_berkas.php');
					break;
				case "cetak" :
					include('./modules/stafkasihubsaker/cek_berkas/cetak.php');
					break;
				case "lembar_kendali" :
					include('./modules/stafkasihubsaker/lbr_kendali.php');
					break;
				case "lembar_disposisi" :
					include('./modules/stafkasihubsaker/lembar_disposisi/edit.php');
					break;	
				case "user" :
					include('./modules/stafkasihubsaker/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/stafkasihubsaker/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/stafkasihubsaker/lembar_kendali/lihat.php');
					break;	
				case "cetak_ulang" :
					include('./modules/stafkasihubsaker/cetak_ulang.php');
					break;															
				default:
					die('Restricted Access STAF KASI');
			}
			break;
		case "peninjau" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/peninjau/main.php');
					break;
				case "cek_berkas" :
					include('./modules/peninjau/cek_berkas.php');
					break;
				case "hasil_lap" :
					include('./modules/peninjau/hasil_lap.php');
					break;
				case "verifikasi" :
					include('./modules/peninjau/verifikasi/edit.php');
					break;
				case "verifikasi_cetak" :
					include('./modules/peninjau/verifikasi/cetak.php');
					break;
				case "lembar_disposisi" :
					include('./modules/peninjau/lembar_disposisi/edit.php');
					break;	
				case "lembar_kendali" :
					include('./modules/peninjau/lbr_kendali.php');
					break;	
				case "teruskan" :
					include('./modules/peninjau/cek_berkas/teruskan.php');
					break;	
				case "user" :
					include('./modules/peninjau/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/peninjau/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/peninjau/lembar_kendali/lihat.php');
					break;											
				default:
					die('Restricted Access');
			}
			break;			
		case "pemantau" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/pemantau/main.php');
					break;
				case "cek_berkas" :
					include('./modules/pemantau/cek_berkas.php');
					break;
				case "hasil_lap" :
					include('./modules/pemantau/hasil_lap.php');
					break;
				case "verifikasi" :
					include('./modules/pemantau/verifikasi/edit.php');
					break;
				case "verifikasi_cetak" :
					include('./modules/pemantau/verifikasi/cetak.php');
					break;
				case "lembar_disposisi" :
					include('./modules/pemantau/lembar_disposisi/edit.php');
					break;	
				case "lembar_kendali" :
					include('./modules/pemantau/lbr_kendali.php');
					break;	
				case "teruskan" :
					include('./modules/pemantau/cek_berkas/teruskan.php');
					break;	
				case "user" :
					include('./modules/pemantau/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/pemantau/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/pemantau/lembar_kendali/lihat.php');
					break;											
				default:
					die('Restricted Access');
			}
			break;						
//----------------kabidlatih----
		case "kabidlatih" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/kabidlatih/main.php');
					break;
				case "verifikasi_berkas" :
					include('./modules/kabidlatih/verifikasi_berkas.php');
					break;
				case "berkas_tolak" :
					include('./modules/kabidlatih/berkas_tolak.php');
					break;
				case "paraf_sk" :
					include('./modules/kabidlatih/paraf_sk.php');
					break;
				case "penugasan" :
					include('./modules/kabidlatih/penugasan.php');
					break;					
				case "lembar_disposisi" :
					include('./modules/kabidlatih/lembar_disposisi/edit.php');
					break;	
				case "lembar_kendali" :
					include('./modules/kabidlatih/lbr_kendali.php');
					break;	
				case "tolak" :
					include('./modules/kabidlatih/tolak.php');
					break;			
				case "paraf_surat" :
					include('./modules/kabidlatih/paraf_surat.php');
					break;	
				case "user" :
					include('./modules/kabidlatih/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/kabidlatih/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/kabidlatih/lembar_kendali/lihat.php');
					break;									
				default:
					die('Restricted Access');
			}
			break;			
//------------kasilatih--------		
		case "kasilatih" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/kasilatih/main.php');
					break;
				case "cek_berkas" :
					include('./modules/kasilatih/cek_berkas.php');
					break;
				case "paraf_surat" :
					include('./modules/kasilatih/paraf_surat.php');
					break;
				case "paraf_sk" :
					include('./modules/kasilatih/paraf_sk.php');
					break;
				case "lembar_disposisi" :
					include('./modules/kasilatih/lembar_disposisi/edit.php');
					break;	
				case "tim_periksa" :
					include('./modules/kasilatih/tim_periksa/edit.php');
					break;
				case "buat_surat" :
					include('./modules/kasilatih/tim_periksa/cetak.php');
					break;
				case "lembar_kendali" :
					include('./modules/kasilatih/lbr_kendali.php');
					break;	
				case "berkas_tolak" :
					include('./modules/kasilatih/berkas_tolak.php');
					break;	
				case "penugasan" :
					include('./modules/kasilatih/penugasan.php');
					break;							
				case "user" :
					include('./modules/kasilatih/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/kasilatih/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/kasilatih/lembar_kendali/lihat.php');
					break;										
				default:
					die('Restricted Access');
			}
			break;

		//staf kasilatih
		case "stafkasilatih" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/stafkasilatih/main.php');
					break;
				case "cek_berkas" :
					include('./modules/stafkasilatih/cek_berkas.php');
					break;
				case "cetak" :
					include('./modules/stafkasilatih/cek_berkas/cetak.php');
					break;
				case "lembar_kendali" :
					include('./modules/stafkasilatih/lbr_kendali.php');
					break;
				case "lembar_disposisi" :
					include('./modules/stafkasilatih/lembar_disposisi/edit.php');
					break;	
				case "user" :
					include('./modules/stafkasilatih/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/stafkasilatih/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/stafkasilatih/lembar_kendali/lihat.php');
					break;	
				case "cetak_ulang" :
					include('./modules/stafkasilatih/cetak_ulang.php');
					break;															
				default:
					die('Restricted Access STAF KASI');
			}
			break;	
			
		case "kasubag_umum" :
			switch ($_GET["opt"])
			{
				case "main" :
					include('./modules/kasubag_umum/main.php');
					break;
				case "cek_berkas" :
					include('./modules/kasubag_umum/cek_berkas.php');
					break;	
				case "penomoran_surat" :
					include('./modules/kasubag_umum/penomoran_surat.php');
					break;	
				case "penomoran_sk" :
					include('./modules/kasubag_umum/penomoran_sk.php');
					break;		
				case "lembar_disposisi" :
					include('./modules/kasubag_umum/lembar_disposisi/edit.php');
					break;		
				case "lembar_kendali" :
					include('./modules/kasubag_umum/lbr_kendali.php');
					break;		
				case "user" :
					include('./modules/kasubag_umum/user/profil.php');
					break;	
				case "usersimpan" :
					include('./modules/kasubag_umum/user/simpan.php');
					break;	
				case "lihat_kendali" :
					include('./modules/kasubag_umum/lembar_kendali/lihat.php');
					break;					
				default:
					die('Restricted Access Home Kasubag Umum');
			}
			break;
		case "auth" :
			switch ($_GET["opt"])
			{
				case "logout" :
					include('./modules/nonlogin/logout.php');
					break;					
				default:
					die('Restricted Access');
			}
			break;
		default:
			die('Dilarang Masuk');
			default:
				include('./modules/nonlogin/main.php');
		}
>>>>>>> 61b16164dbc53b4bcbd8d4faadd081d2b93a07d3
?>
		</td>
	</tr>
</table>
</div>
</body>
</html>
<?php
	ob_end_flush();
?>