<?php error_reporting(0); ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("php/koneksi.php"); ?>
<?php include("php/fungsi.php"); ?>
<?php date_default_timezone_set("Asia/Jakarta"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1" />-->
	<title>:: SISTEM INFORMASI PENILAIAN PRESTASI KERJA PEGAWAI BADAN KEPEGAWAIAN DAERAH PEMERINTAH KOTA MEDAN ::</title>
	<link rel="shortcut icon" href="image/favicon no sharpen.ico" />
	<!--<script src="jquery/js/jquery.js"></script>-->
    <script src="js/jquery-1.7.2.min.js"></script>
    
	<script src="js/jquery.alerts.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min-1.11.1.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>
    
	<link rel="stylesheet" href="css/laundry.css" />
	<link rel="stylesheet" href="js/alert/jquery.alerts.css" />
    <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css" />
    <link rel="stylesheet" href="css/demo_table_jui.css" type="text/css" media="all" />
	<link rel='stylesheet' href='css/menu.css' type='text/css' />
	<link rel='stylesheet' href='css/style.css' type='text/css' />

    <!--<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />-->
    <link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.3.custom.css" type="text/css" media="all" />
	
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" />
    <link href="bootstrap/css/justified-nav.css" rel="stylesheet" />
    
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
        $('.listingtable').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
        
        // SET DIV MENJADI DIALOG JQUERY ----------------------------------------------------------------------------
        $( "#auto_search_pegawai" ).dialog({
            autoOpen: false,
    		height: "600",
    		width: "1200",
    		modal: true,
            show: "fade",
    		hide: "fade"
        });
        // ----------------------------------------------------------------------------------------------------------
        
        // KETIKA FORM DI DALAM DIALOG JQUERY DI SUBMIT -------------------------------------------------------------
        $("#frm_auto_search_pegawai").submit(function(){
            var nip = $("#as_nip").val();
            var nama_pegawai = $("#as_nama_pegawai").val();
            var id_skpd = $("#as_id_skpd").val();
            var id_textbox = $("#id_textbox").val();
            $("#as_listing_pegawai").html("");
            $("#loading_pegawai").show();
            $.ajax({
                type: "GET",
                url: "ajax/get_search_pegawai.php",
                data: "id_skpd=" + id_skpd + "&nip=" + nip + "&nama_pegawai=" + nama_pegawai + "&id_textbox=" + id_textbox,
                success: function(r){
                    $("#loading_pegawai").hide();
                    $("#as_listing_pegawai").html(r);
                }
            });
            return false;
        });
        // ----------------------------------------------------------------------------------------------------------
    });
    function ambil_tanggal(id_selector){
        $("#" + id_selector).datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    }
    
    // FUNGSI - FUNGSI DIDALAM AJAX ----------------------------------------
    function get_kabupaten(id){
        if(id == 0)
            $("#id_kabupaten").html("<option value='0''>:: Kabupaten ::</option>");
        else{
            $.ajax({
                type: "GET",
                url: "ajax/get_kabupaten.php",
                data: "id=" + id,
                success: function(r){
                    //alert(r);
                    $("#id_kabupaten").html(r);
                }
            });
        }
    }
    function get_kecamatan(id){
        if(id == 0)
            $("#id_kecamatan").html("<option value='0''>:: Kecamatan ::</option>");
        else{
            $.ajax({
                type: "GET",
                url: "ajax/get_kecamatan.php",
                data: "id=" + id,
                success: function(r){
                    //alert(r);
                    $("#id_kecamatan").html(r);
                }
            });
        }
    }
    function get_kelurahan(id){
        if(id == 0)
            $("#id_kelurahan").html("<option value='0''>:: Kelurahan ::</option>");
        else{
            $.ajax({
                type: "GET",
                url: "ajax/get_kelurahan.php",
                data: "id=" + id,
                success: function(r){
                    //alert(r);
                    $("#id_kelurahan").html(r);
                }
            });
        }
    }
    // ---------------------------------------------------------------------
    
    // NGELUARIN DIALOG JQUERY ---------------------------------------------
    function show_auto_search_pegawai(id_textbox){
        if($("#as_id_skpd").html() == ""){
            $("#harap_tunggu").show();
            $.ajax({
                type: "GET",
                url: "ajax/load_skpd_for_periode.php",
                dataType: "xml",
                success: function(r){
                    var kalimat = $("#harap_tunggu").html();
                    var jlh = $(r).find("member").length;
                    var text = "";
                    var ctr = 0;
                    $(r).find("member").each(function(){
                        ctr++;
                        var kode = $(this).find("kode").text();
                        var name = $(this).find("name").text();
                        text += "<option value='" + kode + "'>" + name + "</option>";
                        $("#harap_tunggu").html(kalimat + " : " + ctr + " / " + jlh);
                    });
                    $("#as_id_skpd").html(text);
                    $("#harap_tunggu").hide();
                }
            });
        }
        $("#as_nama_pegawai").val("");
        $("#as_nip").val("");
        $("#as_id_skpd").val("ABC");
        $("#id_textbox").val(id_textbox);
        $("#as_listing_pegawai").html("");
        $("#auto_search_pegawai").dialog("open");
    }
    // ---------------------------------------------------------------------
    
    function pilih_pegawai_ini(id_textbox, tulisan_yang_diparsing){
        $("#" + id_textbox).val(tulisan_yang_diparsing);
        $("#auto_search_pegawai").dialog("close");
    }
    </script>
</head>
<body>
	<table  border='0px' id='dalam' style='margin-top:0px; height:100%;'>
		<tr>
			<td>

<?php
    if(!isset($_SESSION["id_pengguna"])){
		if(!isset($_GET["mod"]) || $_GET["mod"] == ''){
			include("isi/panel/login.php"); // jika user yang hendak mengakses laman page ini tidak 
		}else{
			switch($_GET["mod"]){
				  case "info" :
						include("isi/widget/info.php");
						break;
				  case "fdownload" :
						include("isi/panel/download.php");
						break;
				  case "berita_dan_informasi" :
						include("isi/panel/berita_informasi.php");
						break;
				  case "latar_belakang" :
						include("isi/panel/latar_belakang.php");
						break;
				  default :
						include("isi/panel/login.php");
						break;
			}	
		}
    }else{
		/* SET The module */
		if(!isset($_GET["mod"]) || $_GET["mod"] == ""){
			switch($_SESSION["id_level"]){
			
				case 10 :
				case 14 :
				case 21 :
				case 24 : 
						include("isi/menubar/modul_1.php"); // untuk pegawai biasa
						break;
				case 17 :
						include("isi/menubar/modul_2.php");
						break;
				case 3 :
						include("isi/menubar/modul_3.php");
						break;
				case 15 :
						include("isi/menubar/modul_12.php");
						break;
				case 19 :
						include("isi/menubar/modul_14.php");
						break;
					
				
					
			}
		}else{
			switch($_GET["mod"]){
					// SUB MENU
					case "sub_menu_mod_1" :
						include("isi/menubar/submenu_1.php");
						break;
					case "sub_menu_mod_2" :
						include("isi/menubar/submenu_1.php");
						break;
					
					// Menu umum
					case "fdownload" :
						include("isi/panel/download.php");
						break;
					case "berita_dan_informasi" :
						include("isi/panel/berita_informasi.php");
						break;
					case "latar_belakang" :
						include("isi/panel/latar_belakang.php");
						break;	
						
					case "data_pegawai" :
						include("isi/panel/data_pegawai.php");
						break;
					case "tambah_pegawai" :
						include("isi/panel/tambah_pegawai.php");
						break;
					case "edit_pegawai" :
						include("isi/panel/edit_pegawai.php");
						break;
					case "pengguna" :
						if($_SESSION["simpeg_id_level"] == 1){
							include("isi/panel/pengguna/mod_1_2.php");
						}	
						break;
						
					// SKP
					case "skp_pj_1" :
						include("isi/panel/skp/skp_pj_1.php");
						break;
					case "skp_target" :
						include("isi/panel/skp/skp_target.php");
						break;
					case "spv_skp_target" :
						include("isi/panel/skp/spv_skp_target.php");
						break;
					case "spv_skp_target_proses" :
						include("isi/panel/skp/spv_skp_target_proses.php");
						break;
					case "spv_penilaian_skp_target" :
						include("isi/panel/skp/spv_penilaian_skp_target.php");
						break;
					case "spv_penilaian_skp_target_proses" :
						include("isi/panel/skp/spv_penilaian_skp_target_proses.php");
						break;
					case "skp_target_tambah" :
						include("isi/panel/skp/skp_target_tambah.php");
						break;
					case "skp_uraian" :
						include("isi/panel/skp/skp_uraian.php");
						break;
					case "skp_uraian_tambah" :
						include("isi/panel/skp/skp_uraian_tambah.php");
						break;
					case "skp_realisasi" :
						include("isi/panel/skp/skp_realisasi.php");
						break;
					case "skp_realisasi_tambah" :
						include("isi/panel/skp/skp_realisasi_tambah.php");
						break;
					case "perilaku_pj_1" :
						include("./isi/panel/skp/perilaku_pj_1.php");
						break;
					case "spv_perilaku" :
						include("isi/panel/skp/spv_perilaku.php");
						break;
					case "spv_perilaku_proses" :
						include("isi/panel/skp/spv_perilaku_proses.php");
						break;
						
					case "skp_perilaku_target_tambah" :
						include("isi/panel/skp/skp_perilaku_target_tambah.php");
						break;
						
					case "perilaku_isi" :
						include("isi/panel/skp/perilaku_isi.php");
						break;
					case "penilaian_skp_pj_1" :
						include("isi/panel/skp/penilaian_skp_pj_1.php");
						break;
					case "penilaian_skp_target" :
						include("isi/panel/skp/penilaian_skp_target.php");
						break;
					case "penilaian_skp_uraian" :
						include("isi/panel/skp/penilaian_skp_uraian.php");
						break;
					case "dp3_pj_1" :
						include("isi/panel/skp/dp3_pj_1.php");
						break;
					case "dp3_pilih_periode" :
						include("isi/panel/skp/dp3_pilih_periode.php");
						break;
					case "dp3_isi" :
						include("isi/panel/skp/dp3_isi.php");
						break;
					case "upload_dp3_pj_1" :
						include("isi/panel/skp/upload_dp3_pj_1.php");
						break;
					case "upload_dp3_pilih_periode" :
						include("isi/panel/skp/upload_dp3_pilih_periode.php");
						break;
					case "upload_dp3_proses" :
						include("isi/panel/skp/upload_dp3_proses.php");
						break;
					case "spv_upload_dp3" :
						include("isi/panel/skp/spv_upload_dp3.php");
						break;
					case "spv_upload_dp3_proses" :
						include("isi/panel/skp/spv_upload_dp3_proses.php");
						break;
					case "tugtam_kreat_input_pilih_periode" :
						include("isi/panel/skp/tugtam_kreat_input_pilih_periode.php");
						break;
					case "tugtam_kreat_input" :
						include("isi/panel/skp/tugtam_kreat_input.php");
						break;
					case "tugtam_kreat_lihat_pilih_bawahan" :
						include("isi/panel/skp/tugtam_kreat_lihat_pilih_bawahan.php");
						break;
					case "tugtam_kreat_lihat_pilih_periode" :
						include("isi/panel/skp/tugtam_kreat_lihat_pilih_periode.php");
						break;
					case "tugtam_kreat_lihat" :
						include("isi/panel/skp/tugtam_kreat_lihat.php");
						break;
					case "perilaku_isi_pilih_bawahan" :
						include("isi/panel/skp/perilaku_isi_pilih_bawahan.php");
						break;
					case "perilaku_isi_pilih_periode" :
						include("isi/panel/skp/perilaku_isi_pilih_periode.php");
						break;
					case "perilaku_lihat_pilih_periode" :
						include("isi/panel/skp/perilaku_lihat_pilih_periode.php");
						break;
					case "perilaku_lihat" :
						include("isi/panel/skp/perilaku_lihat.php");
						break;
					case "perilaku_tanggapi_pilih_bawahan" :
						include("isi/panel/skp/perilaku_tanggapi_pilih_bawahan.php");
						break;
					case "perilaku_tanggapi_pilih_periode" :
						include("isi/panel/skp/perilaku_tanggapi_pilih_periode.php");
						break;
					case "perilaku_tanggapi" :
						include("isi/panel/skp/perilaku_tanggapi.php");
						break;
					case "perilaku_keputusan_pilih_bawahan" :
						include("isi/panel/skp/perilaku_keputusan_pilih_bawahan.php");
						break;
					case "perilaku_keputusan_pilih_periode" :
						include("isi/panel/skp/perilaku_keputusan_pilih_periode.php");
						break;
					case "perilaku_keputusan" :
						include("isi/panel/skp/perilaku_keputusan.php");
						break;
						
					case "skp_output_pilih_periode" :
						include("isi/panel/skp/skp_output_pilih_periode.php");
						break;
					case "skp_output_isi" :
						include("isi/panel/skp/skp_output_isi.php");
						break;
						
					// RIWAYAT PANGKAT
					case "riwayat_pangkat" :
						include("isi/panel/riwayat_pangkat/riwayat_pangkat.php");
						break;
					case "riwayat_pangkat_tambah" :
						include("isi/panel/riwayat_pangkat/riwayat_pangkat_tambah.php");
						break;
					case "riwayat_pangkat_edit" :
						include("isi/panel/riwayat_pangkat/riwayat_pangkat_edit.php");
						break;
					
					// RIWAYAT JABATAN
					case "riwayat_jabatan" :
						include("isi/panel/riwayat_jabatan/riwayat_jabatan.php");
						break;
					case "riwayat_jabatan_tambah" :
						include("isi/panel/riwayat_jabatan/riwayat_jabatan_tambah.php");
						break;
					case "riwayat_jabatan_edit" :
						include("isi/panel/riwayat_jabatan/riwayat_jabatan_edit.php");
						break;
						
					// ADMIN
					case "reset_password_adm" :
						include("isi/panel/admin/reset_password_adm.php");
						break;
					case "laporan_adm" :
						include("isi/panel/admin/laporan_adm.php");
						break;
					case "laporan_sudah_ngisi_skp_adm" :
						include("isi/panel/admin/laporan_sudah_ngisi_skp_adm.php");
						break;
					case "laporan_belum_ngisi_skp_adm" :
						include("isi/panel/admin/laporan_belum_ngisi_skp_adm.php");
						break;
					case "laporan_sudah_ngisi_penilaian_skp_adm" :
						include("isi/panel/admin/laporan_sudah_ngisi_penilaian_skp_adm.php");
						break;
					case "laporan_belum_ngisi_penilaian_skp_adm" :
						include("isi/panel/admin/laporan_belum_ngisi_penilaian_skp_adm.php");
						break;
					case "laporan_sudah_ngisi_dp3_adm" :
						include("isi/panel/admin/laporan_sudah_ngisi_dp3_adm.php");
						break;
					case "laporan_belum_ngisi_dp3_adm" :
						include("isi/panel/admin/laporan_belum_ngisi_dp3_adm.php");
						break;
					case "laporan_sudah_ngupload_skp_dp3_adm" :
						include("isi/panel/admin/laporan_sudah_ngupload_skp_dp3_adm.php");
						break;
					case "laporan_belum_ngupload_skp_dp3_adm" :
						include("isi/panel/admin/laporan_belum_ngupload_skp_dp3_adm.php");
						break;
					case "laporan_sudah_ngisi_skp_adm_rekap" :
						include("isi/panel/admin/laporan_sudah_ngisi_skp_adm_rekap.php");
						break;
					case "laporan_sudah_ngisi_penilaian_skp_adm_rekap" :
						include("isi/panel/admin/laporan_sudah_ngisi_penilaian_skp_adm_rekap.php");
						break;
					case "laporan_sudah_ngisi_dp3_adm_rekap" :
						include("isi/panel/admin/laporan_sudah_ngisi_dp3_adm_rekap.php");
						break;
					case "laporan_sudah_ngupload_skp_dp3_adm_rekap" :
						include("isi/panel/admin/laporan_sudah_ngupload_skp_dp3_adm_rekap.php");
						break;
					case "lihat_hasil_upload_adm" :
						include("isi/panel/admin/lihat_hasil_upload_adm.php");
						break;
					case "laporan_kegiatan_verifikasi_upload_rekap" :
						include("isi/panel/admin/laporan_kegiatan_verifikasi_upload_rekap.php");
						break;
					case "laporan_absensi_pegawai_rekap" :
						include("isi/panel/admin/laporan_absensi_pegawai_rekap.php");
						break;
					case "pesan_skp_all_adm" :
						include("isi/panel/admin/pesan_skp_all_adm.php");
						break;
					case "pesan_skp_spesifik_adm" :
						include("isi/panel/admin/pesan_skp_spesifik_adm.php");
						break;
					case "pesan_skp_spesifik_adm_tambah" :
						include("isi/panel/admin/pesan_skp_spesifik_adm_tambah.php");
						break;
					// CPANEL ADMIN
					case "c_panel" :
						include "isi/panel/c_panel/panel_utama.php";
						break;	
					case "cp_manage_pengguna" :
						include "isi/panel/c_panel/cp_manage_pegawai.php";
						break;
					case "cp_tambah_pengguna"  :
						include "isi/panel/c_panel/cp_tambah_pengguna.php";
						break;
					case "edit_data_pengguna" :
						include "isi/panel/c_panel/edit_data_pengguna.php";
						break;
					case "cp_manage_skpd" :
						include "isi/panel/c_panel/cp_manage_skpd.php";
						break;
					case "cp_tambah_skpd" :
						include "isi/panel/c_panel/cp_tambah_skpd.php";
						break;
					case "cp_manage_kabupaten" :
						include "isi/panel/c_panel/cp_manage_kabupaten.php";
						break;
					case "cp_manage_kecamatan" :
						include "isi/panel/c_panel/cp_manage_kecamatan.php";
						break;
					case "cp_manage_provinsi" :
						include "isi/panel/c_panel/cp_manage_provinsi.php";
						break;
					case "cp_manage_jabatan" :
						include "isi/panel/c_panel/cp_manage_jabatan.php";
						break;
					default :
						include "isi/panel/login.php";
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

<!-- DIALOG JQUERY ---------------------------------------------------------------------------------------------- -->
<div id="auto_search_pegawai" title="AUTO SEARCH : PEGAWAI" style="display: none;">
<form name="frm_auto_search_pegawai" id="frm_auto_search_pegawai" action="" method="post">
<input type="hidden" id="id_textbox" />
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <input type="text" id="as_nip" placeholder="Cari NIP Pegawai" />
                </td>
                <td width='50%'>
                    <input type="text" id="as_nama_pegawai" placeholder="Cari Nama Pegawai" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <select id="as_id_skpd"></select><br /><div id="harap_tunggu" style="display: none;">Harap tunggu, sedang loading data SKPD...</div>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='Filter' style="height: 30px; width: 100px;" /></td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtablebackup">
            <thead>
                <tr class="headertable">
                    <th width='30px'>No.</th>
                    <th width='150px'>Nama Pegawai</th>
                    <th width='150px'>NIP</th>
                    <th width='150px'>Pangkat</th>
                    <th width='70px'>Gol. Ruang</th>
                    <th width='200px'>Jabatan</th>
                    <th>SKPD / Unit Kerja</th>
                    <th width='20px'>&nbsp;</th>
                </tr>
            </thead>
            <tbody id="as_listing_pegawai" style="overflow: scroll;">
            </tbody>
        </table>
        <div class="kelang"></div>
        <div class="alert alert-success" role="alert" id="loading_pegawai" style="display: none;">
            <strong>Loading...</strong> Harap tunggu beberapa saat.
        </div>
    </div>
</div>
</div>
<!-- ---------- ---------------------------------------------------------------------------------------------- -->
<?php ob_end_flush(); ?>