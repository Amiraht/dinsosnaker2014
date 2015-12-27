<?php
	error_reporting(0);
	session_start();
	ob_start();
	set_time_limit(0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>TATA NASKAH DIGITAL ELEKTRONIK DINAS SOSIAL DAN TENAGA KERJA</title>
    <link type="image/x-icon" href="./image/icon.png" rel="shortcut icon"></link>
	<link rel='stylesheet' href='./css/template.css' type='text/css' />
    <link rel='stylesheet' href='./css/menu.css' type='text/css' />
	<link rel='stylesheet' href='./css/style.css' type='text/css' />
	<link rel='stylesheet' href='./css/tabel.css' type='text/css' />
	<link rel='stylesheet' href='./css/button.css' type='text/css' />
	<!-- Table sorter stylesheet -->
    <link rel="stylesheet" type="text/css" href="./css/tablesorter.css"  media="screen" />
    <!--<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />-->
   
	<script src='./libraries/jquery-1.4.3.js'></script>
	<!-- JQuery tablesorter plugin script-->
      <script type="text/javascript" src="./libraries/jquery.tablesorter.min.js"></script>
     <!-- JQuery pager plugin script for tablesorter tables -->
	<script type="text/javascript" src="./libraries/jquery.tablesorter.pager.js"></script>
	<link type="text/css" href="./libraries/development-bundle/themes/base/ui.all.css" rel="stylesheet" />
    <script type="text/javascript" src="./libraries/development-bundle/ui/ui.core.js"></script>
    <script type="text/javascript" src="./libraries/development-bundle/ui/ui.datepicker.js"></script>
    <script type="text/javascript" src="./libraries/development-bundle/ui/i18n/ui.datepicker-id.js"></script>
	 
	<script type="text/javascript" src="./libraries/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="./libraries/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="./libraries/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	
</head>
 <!-- Initiate tablesorter script -->
 <script type="text/javascript">
	$(document).ready(function() { 
		$("#tbllisting") 
			.tablesorter({
					// zebra coloring
					widgets: ['zebra'],
					// pass the headers argument and assing a object 
					headers: { 
						// assign the sixth column (we start counting zero) 
						6: { 
							// disable it by setting the property sorter to false 
							sorter: true
						} 
					}
				}) 
			.tablesorterPager({container: $("#pager")}); 
		}); 
</script>
<body>
	<table border='0px' id='dalam' style='margin-top:0px; height:100%;'>
		<tr>
			<td>
<?php
	   
		include "method/mysqli_connect.php";
		include "php/koneksi.php";
		include "php/fungsi.php";
		include "php/url_paradise.php";
		include "libraries/connect.php";
		
	if(!isset($_SESSION["id_pengguna"])){
		if(!isset($_GET["mod"]) || $_GET["mod"] == ""){
			include("isi/panel/nonlogin/main.php");
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
          
		   // set login act depend on id level of user
			// rules
			switch($_SESSION['id_level']){
				case 3 :
					include("isi/main/main_loket.php");
					break;
				case 17 :
					include("isi/main/main_kadis.php");
					break;
				case 16 :
					include("isi/main/main_sekretaris.php");
					break;
				case 4  :
				case 11 :
				case 7  :
				case 22 :
					include("isi/main/main_kabid.php");
					break;
				
				case 15 :
					include("isi/main/main_kasubbag_umum.php");
					break;
				case 18:
					include("isi/main/main_arsip.php");
					break;
				case 5  :
				case 8  :
				case 12 :
				case 20 :
				case 23 :
					include("isi/main/main_kasi.php");
					break;
				case 10 :
				case 14 :
				case 21 :
				case 24 :
				case 25 :
				case 6  :
					include("isi/main/main_staff.php");
					break;	
				case 19:
					include("isi/main/main_cpanel.php");
					break;
				default :
					include("isi/panel/nonlogin/main.php");
					break;
			}
        }else{
            switch($_GET["mod"]){
				// menu menu per akses level
				case "main_loket" :
						include("isi/main/main_loket.php");
						break;
				case "main_kaban" :
						include("isi/main/main_kaban.php");
						break;
				case "main_sekretaris" :
						include("isi/main/main_sekretaris.php");
						break;
				case "main_kabid" :
						include("isi/main/main_kabid.php");
						break;
				case "main_kasubbag_umum" :
						include("isi/main/main_kasubbag_umum.php");
						break;
				case "main_kasi" :
						include("isi/main/main_kasi.php");
						break;
				case "main_arsip" :
						include("isi/main/main_arsip.php");
						break;
				case "main_staff" :
						include("isi/main/main_staff.php");
						break;
				case "main_administrator" :
						include("isi/main/main_cpanel.php");
						break;
				
                case "info" :
                    include("isi/widget/info.php");
                    break;
			
				/* HALAMAN HALAMAN UTAMA */	
				case "latar_belakang" :
                    include("isi/panel/nonlogin/latar_belakang.php");
                    break;
				case "inform" :
					include("isi/panel/info.php");
                    break;
					
                /* SURAT MASUK */
                case "input_surat_masuk" :
                    include("isi/panel/input_surat_masuk.php");
                    break;
                case "edit_surat_masuk" :
                    include("isi/panel/edit_surat_masuk.php");
                    break;
                case "disposisi_surat_masuk_1" :
                    include("isi/panel/disposisi_surat_masuk_1.php");
                    break;
                case "disposisi_surat_masuk_kabid" :
                    include("isi/panel/disposisi_surat_masuk_kabid.php");
                    break;
                case "hasil_surat_masuk_kasubbid" :
                    include("isi/panel/hasil_surat_masuk_kasubbid.php");
                    break;
                case "hasil_surat_masuk_kabid" :
                    include("isi/panel/hasil_surat_masuk_kabid.php");
                    break;
                case "perbaikan_surat_masuk_kasubbid" :
                    include("isi/panel/perbaikan_surat_masuk_kasubbid.php");
                    break;
                case "hasil_surat_masuk_kaban" :
                    include("isi/panel/hasil_surat_masuk_kaban.php");
                    break;
                case "perbaikan_surat_masuk_kabid" :
                    include("isi/panel/perbaikan_surat_masuk_kabid.php");
                    break;
                        
                /* SETELAH PERBAHARUAN */
                case "file_surat_masuk" :
                    include("isi/panel/file_surat_masuk.php");
                    break;
                case "manajemen_surat_masuk_1" :
                    include("isi/panel/manajemen_surat_masuk_1.php");
                    break;
                case "posisi_surat_masuk_sekretaris" :
                    include("isi/panel/posisi_surat_masuk_sekretaris.php");
                    break;
                case "posisi_surat_masuk_kaban" :
                    include("isi/panel/posisi_surat_masuk_kaban.php");
                    break;
                case "posisi_surat_masuk_kabid" :
                    include("isi/panel/posisi_surat_masuk_kabid.php");
                    break;
                case "posisi_surat_masuk_kasubbid" :
                    include("isi/panel/posisi_surat_masuk_kasubbid.php");
                    break;
                case "proses_ulang_surat_masuk" :
                    include("isi/panel/proses_ulang_surat_masuk.php");
                    break;
                case "posisi_surat_masuk_staff" :
                    include("isi/panel/posisi_surat_masuk_staff.php");
                    break;
                case "file_surat_keluar" :
                    include("isi/panel/file_surat_keluar.php");
                    break;
                case "file_final_surat_keluar" :
                    include("isi/panel/file_final_surat_keluar.php");
                    break;
                case "manajemen_surat_keluar_1" :
                    include("isi/panel/manajemen_surat_keluar_1.php");
                    break;
                case "posisi_surat_keluar_kasubbid" :
                    include("isi/panel/posisi_surat_keluar_kasubbid.php");
                    break;
                case "posisi_surat_keluar_staff" :
                    include("isi/panel/posisi_surat_keluar_staff.php");
                    break;
                case "posisi_surat_keluar_kabid" :
                    include("isi/panel/posisi_surat_keluar_kabid.php");
                    break;
                case "posisi_surat_keluar_sekretaris" :
                    include("isi/panel/posisi_surat_keluar_sekretaris.php");
                    break;
                case "posisi_surat_keluar_kaban" :
                    include("isi/panel/posisi_surat_keluar_kaban.php");
                    break;
                case "pengiriman_surat" :
                    include("isi/panel/pengiriman_surat.php");
                    break;
                case "finalisasi_surat_keluar" :
                    include("isi/panel/finalisasi_surat_keluar.php");
                    break;
                case "pengguna" :
                    include("isi/panel/pengguna.php");
                    break;
				
				// laporan laporan	
				case "list_laporan" :
                    include("isi/panel/laporans.php");
                    break;
				
                case "lacak_surat_masuk" :
                    include("isi/panel/lacak_surat_masuk.php");
                    break;
                case "detail_posisi_surat_masuk" :
                    include("isi/panel/detail_posisi_surat_masuk.php");
                    break;
                case "cari_surat_untuk_dibalas" :
                    include("isi/panel/cari_surat_untuk_dibalas.php");
                    break;
                case "cari_surat_untuk_dibalas_asli" :
                    include("isi/panel/cari_surat_untuk_dibalas_asli.php");
                    break;
                case "pengarsipan_surat_masuk" :
                    include("isi/panel/pengarsipan_surat_masuk.php");
                    break;
                case "pengarsipan_surat_keluar" :
                    include("isi/panel/pengarsipan_surat_keluar.php");
                    break;
                 case "riwayat_surat_masuk" :
                    include("isi/panel/riwayat_surat_masuk.php");
                    break;
                 case "riwayat_surat_keluar" :
                    include("isi/panel/riwayat_surat_keluar.php");
                    break;
                case "nl_berita_dan_informasi" :
                    include("isi/panel/nl_berita_dan_informasi.php");
                    break;
                case "nl_detail_berita_dan_informasi" :
                    include("isi/panel/nl_detail_berita_dan_informasi.php");
                    break;
                case "nl_file_download" :
                    include("isi/panel/nl_file_download.php");
                    break;
                case "nl_latar_belakang" :
                    include("isi/panel/nl_latar_belakang.php");
                    break;
                case "cp_manage_sm" :
                    include("isi/panel/cp_manage_sm.php");
                    break;
                case "cp_manage_sk" :
                    include("isi/panel/cp_manage_sk.php");
                    break;
                case "cp_edit_sm" :
                    include("isi/panel/cp_edit_sm.php");
                    break;
                case "cp_berita_dan_informasi" :
                    include("isi/panel/cp_berita_dan_informasi.php");
                    break;
                case "cp_manage_berita_dan_informasi" :
                    include("isi/panel/cp_manage_berita_dan_informasi.php");
                    break;
                case "cp_latar_belakang" :
                    include("isi/panel/cp_latar_belakang.php");
                    break;
                case "cp_file_download" :
                    include("isi/panel/cp_file_download.php");
                    break;
                case "cp_tambah_file_download" :
                    include("isi/panel/cp_tambah_file_download.php");
                    break;
                case "cp_unit_kerja" :
                    include("isi/panel/cp_unit_kerja.php");
                    break;
                case "cp_pengguna" :
                    include("isi/panel/cp_pengguna.php");
                    break;
                case "daftar_pengguna" :
                    include("isi/panel/daftar_pengguna.php");
                    break;
                case "edit_data_pengguna" :
                    include("isi/panel/edit_data_pengguna.php");
                    break;
                case "cp_bypass_sm" :
                    include("isi/menubar/cp_bypass_sm.php");
                    break;
                case "cp_bypass_sk" :
                    include("isi/menubar/cp_bypass_sk.php");
                    break;
                    
                case "cp_bypass_sm_sekretaris" :
                    include("isi/bypass/posisi_surat_masuk_sekretaris.php");
                    break;
                case "cp_bypass_sm_kabid" :
                    include("isi/bypass/posisi_surat_masuk_kabid.php");
                    break;
                case "cp_bypass_sm_kasubbid" :
                    include("isi/bypass/posisi_surat_masuk_kasubbid.php");
                    break;
                case "cp_bypass_sk_kasubbid" :
                    include("isi/bypass/posisi_surat_keluar_kasubbid.php");
                    break;
                case "cp_bypass_sk_kabid" :
                    include("isi/bypass/posisi_surat_keluar_kabid.php");
                    break;
                case "cp_bypass_sk_sekretaris" :
                    include("isi/bypass/posisi_surat_keluar_sekretaris.php");
                    break;
                case "cp_bypass_sk_kaban" :
                    include("isi/bypass/posisi_surat_keluar_kaban.php");
                    break;
                    
                case "laporan_rekap_total" :
                    include("isi/panel/laporan_rekap_total.php");
                    break;
                case "laporan_rekap_posisi" :
                    include("isi/panel/laporan_rekap_posisi.php");
                    break;
                case "lanjut_rekap_total_kabbid_kasubbid" :
                    include("isi/panel/lanjut_rekap_total_kabbid_kasubbid.php");
                    break;
                case "lanjut_rekap_total_staff" :
                    include("isi/panel/lanjut_rekap_total_staff.php");
                    break;
                case "laporan_rekap_sm" :
                    include("isi/panel/laporan_rekap_sm.php");
                    break;
                case "laporan_rekap_sk" :
                    include("isi/panel/laporan_rekap_sk.php");
                    break;
                case "laporan_rekap_sma" :
                    include("isi/panel/laporan_rekap_sma.php");
                    break;
                case "laporan_rekap_ska" :
                    include("isi/panel/laporan_rekap_ska.php");
                    break;
                case "laporan_rekap_skd" :
                    include("isi/panel/laporan_rekap_skd.php");
                    break;
                case "laporan_rekap_nomor" :
                    include("isi/panel/laporan_rekap_nomor.php");
                    break;
                    
                case "laporan_mntkbn" :
                    include("isi/panel/laporan_mntkbn.php");
                    break;
                    
                case "laporan_kaban" :
                    include("isi/menubar/laporan_kaban.php");
                    break;
                case "laporan_sekretaris" :
                    include("isi/menubar/laporan_sekretaris.php");
                    break;
                case "laporan_kabid" :
                    include("isi/menubar/laporan_kabid.php");
                    break;
                case "laporan_kasubbid" :
                    include("isi/menubar/laporan_kasubbid.php");
                    break;
                case "laporan_arsip" :
                    include("isi/menubar/laporan_arsip.php");
                    break;
                case "laporan_loket" :
                    include("isi/menubar/laporan_loket.php");
                    break;
                /* =========== */
                
                
                /* SURAT KELUAR */
                case "buat_surat_keluar" :
                    include("isi/panel/input_surat_keluar.php");
                    break;
                case "edit_surat_keluar" :
                    include("isi/panel/edit_surat_keluar.php");
                    break;
                case "disposisi_surat_keluar_kabid" :
                    include("isi/panel/disposisi_surat_keluar_kabid.php");
                    break;
                case "perbaikan_surat_keluar_kasubbid" :
                    include("isi/panel/perbaikan_surat_keluar_kasubbid.php");
                    break;
                case "perbaikan_surat_keluar_kabid" :
                    include("isi/panel/perbaikan_surat_keluar_kabid.php");
                    break;
                case "disposisi_surat_keluar_kaban" :
                    include("isi/panel/disposisi_surat_keluar_kaban.php");
                    break;
                case "pengiriman_surat_keluar" :
                    include("isi/panel/pengiriman_surat_keluar.php");
                    break;
                /* ============ */
                
                /* PENGARSIPAN */
                case "arsip_surat_masuk" :
                    include("isi/panel/arsip_surat_masuk.php");
                    break;
                case "edit_arsip_surat_masuk" :
                    include("isi/panel/edit_arsip_surat_masuk.php");
                    break;
                case "detail_surat_masuk" :
                    include("isi/panel/detail_surat_masuk.php");
                    break;
                case "arsip_surat_keluar" :
                    include("isi/panel/arsip_surat_keluar.php");
                    break;
                case "edit_arsip_surat_keluar" :
                    include("isi/panel/edit_arsip_surat_keluar.php");
                    break;
                case "detail_surat_keluar" :
                    include("isi/panel/detail_surat_keluar.php");
                    break;
                /* =========== */
				/* All dialogs to show   */
				case "dialog_laporan_mntkbn" :
					include("isi/panel/modal/dialog_laporan_mntkbn.php");
					break;
            }
        }
    }
		
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