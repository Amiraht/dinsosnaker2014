<?php error_reporting(E_ALL);?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("php/koneksi.php"); ?>
<?php include("php/fungsi.php"); ?>
<?php date_default_timezone_set("America/New_York"); ?>
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
    
    <script src="js/googleapis_jquery_min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min-1.11.1.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>
    
	<link rel="stylesheet" href="css/laundry.css" />
	<link rel="stylesheet" href="js/alert/jquery.alerts.css" />
    <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css" />
    <link rel="stylesheet" href="css/demo_table_jui.css" type="text/css" media="all" />
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
    
    <!-- <MENUBAR> -->
    <link rel="stylesheet" href="css/menubar.css" type="text/css" />
    <script type="text/javascript" src="js/menubar.js"></script>
    <!-- </MENUBAR> -->
    <script type="text/javascript">
    $(document).ready(function(){
        <?php
            if(isset($_SESSION["simpeg_id_pengguna"])){
        ?>
            $("#topmenu").slideDown(500);
        <?php
            }
        ?>
        
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
        
		// KETIKA TULISAN PESAN DI KLIK
		$('#klik_pesan').click(function(){
			document.location.href="?mod=ucapan_ultah";
		});
		
        // KETIKA FORM DI DALAM DIALOG JQUERY DI SUBMIT -------------------------------------------------------------
        $("#frm_auto_search_pegawai").submit(function(){
            var nip = $("#as_nip").val();
            var nama_pegawai = $("#as_nama_pegawai").val();
            var id_skpd = $("#as_id_skpd").val();
            var id_textbox = $("#id_textbox").val();
            $("#as_listing_pegawai").html("");
            $.ajax({
                type: "GET",
                url: "ajax/get_search_pegawai.php",
                data: "id_skpd=" + id_skpd + "&nip=" + nip + "&nama_pegawai=" + nama_pegawai + "&id_textbox=" + id_textbox,
                success: function(r){
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
<body role="document" id="web_body">
<div id="header"><?php include "isi/widget/header.php"; ?></div>

<div id="body" class="thebody">
<?php
    if(empty($_SESSION["simpeg_id_pengguna"])){
        include "isi/panel/login.php";
    }else{
	   if(isset($_GET["mod"])){
			switch($_GET["mod"]){
				case "info" :
                    include "isi/widget/info.php";
                    break;
				case "" :
					include "isi/widget/beranda.php";
					break;
				case "data_pegawai" :
					include "isi/panel/data_pegawai.php";
					break;
				case "tambah_pegawai" :
					include "isi/panel/tambah_pegawai.php";
					break;
				case "edit_pegawai" :
					include "isi/panel/edit_pegawai.php";
					break;
				case "pengguna"	:
					include "isi/panel/profile.php";
					break;
				case "ucapan_ultah"	:
					include "isi/panel/kirim_pesan.php";
					break;		
                
				// supervision
				case "spv_pilih_pegawai" :
					include "isi/panel/spv_data_pegawai_pilih_pegawai.php";
					break;
                
				// RIWAYAT PANGKAT
				case "riwayat_pangkat" :
					include "isi/panel/riwayat_pangkat/riwayat_pangkat.php";
					break;
				case "riwayat_pangkat_tambah" :
					include "isi/panel/riwayat_pangkat/riwayat_pangkat_tambah.php";
					break;
				case "riwayat_pangkat_edit" :
					include "isi/panel/riwayat_pangkat/riwayat_pangkat_edit.php";
					break;
				case "spv_riwayat_pangkat" :
					if(empty($_SESSION["simpeg_id_pegawai"]))
						include "isi/panel/spv_data_pegawai_pilih_pegawai.php";
					else
						include "isi/panel/riwayat_pangkat/spv_riwayat_pangkat.php";
					break;
				case "spv_riwayat_pangkat_proses" :
					if(empty($_SESSION["simpeg_id_pegawai"]))
						include "isi/panel/spv_data_pegawai_pilih_pegawai.php";
					else
						include "isi/panel/riwayat_pangkat/spv_riwayat_pangkat_proses.php";
					break;
            
				// RIWAYAT JABATAN
				case "riwayat_jabatan" :
					include "isi/panel/riwayat_jabatan/riwayat_jabatan.php";
					break;
				case "riwayat_jabatan_tambah" :
					include "isi/panel/riwayat_jabatan/riwayat_jabatan_tambah.php";
					break;
				case "riwayat_jabatan_edit" :
					include "isi/panel/riwayat_jabatan/riwayat_jabatan_edit.php";
					break;
				case "spv_riwayat_jabatan" :
					if(empty($_SESSION["simpeg_id_pegawai"]))
						include "isi/panel/spv_data_pegawai_pilih_pegawai.php";
					else
						include "isi/panel/riwayat_jabatan/spv_riwayat_jabatan.php";
					break;
				case "spv_riwayat_jabatan_proses" :
					if(empty($_SESSION["simpeg_id_pegawai"]))
						include "isi/panel/spv_data_pegawai_pilih_pegawai.php";
					else
						include "isi/panel/riwayat_jabatan/spv_riwayat_jabatan_proses.php";
					break;
				
				// RIWAYAT PENDIDIKAN
					case "riwayat_pendidikan" :
						include "isi/panel/riwayat_pendidikan/riwayat_pendidikan.php";
						break;
					case "riwayat_pendidikan_add" :
						include "isi/panel/riwayat_pendidikan/riwayat_pendidikan_add.php";
						break;
					case "riwayat_pendidikan_edit" :
						include "isi/panel/riwayat_pendidikan/edit_riwayat_pendidikan.php";
						break;
					case "riwayat_pendidikan_pegawai" :
						include "isi/panel/riwayat_pendidikan/riwayat_pendidikan_detail.php";
						break;	
				     
				// PENGANGKATAN CPNS
				case "pengangkatan_cpns" :
					include "isi/panel/pengangkatan_cpns/pengangkatan_cpns.php";
					break;
				case "spv_pengangkatan_cpns" :
					if(empty($_SESSION["simpeg_id_pegawai"]))
						include "isi/panel/spv_data_pegawai_pilih_pegawai.php";
					else
						include "isi/panel/pengangkatan_cpns/spv_pengangkatan_cpns.php";
					break;
					
				// PENGANGKATAN PNS
            case "pengangkatan_pns" :
                include "isi/panel/pengangkatan_pns/pengangkatan_pns.php";
                break;
            case "spv_pengangkatan_pns" :
                if(empty($_SESSION["simpeg_id_pegawai"]))
                    include "isi/panel/spv_data_pegawai_pilih_pegawai.php";
                else
                    include "isi/panel/pengangkatan_pns/spv_pengangkatan_pns.php";
                break;
            
            // CUTI
            case "cuti_daftar_usulan" :
                include "isi/panel/cuti/cuti_daftar_usulan.php";
                break;
            case "cuti_daftar_usulan_tambah" :
                include "isi/panel/cuti/cuti_daftar_usulan_tambah.php";
                break;
            case "cuti_daftar_usulan_edit" :
                include "isi/panel/cuti/cuti_daftar_usulan_edit.php";
                break;
            case "cuti_proses_no_usulan" :
                include "isi/panel/cuti/cuti_proses_no_usulan.php";
                break;
            case "cuti_proses_daftar_pegawai" :
                include "isi/panel/cuti/cuti_proses_daftar_pegawai.php";
                break;
            case "cuti_daftar_ditolak" :
                include "isi/panel/cuti/cuti_daftar_ditolak.php";
                break;
            case "cuti_proses" :
                include "isi/panel/cuti/cuti_proses.php";
                break;
            case "cuti_sk" :
                include "isi/panel/cuti/cuti_sk.php";
                break;
            case "cuti_sk_tambah" :
                include "isi/panel/cuti/cuti_sk_tambah.php";
                break;
            case "cuti_sk_edit" :
                include "isi/panel/cuti/cuti_sk_edit.php";
                break;
            case "cuti_sk_daftar_pegawai" :
                include "isi/panel/cuti/cuti_sk_daftar_pegawai.php";
                break;
            case "cuti_sk_tambah_pegawai_langsung" :
                include "isi/panel/cuti/cuti_sk_tambah_pegawai_langsung.php";
                break;
            case "cuti_sk_daftar_pegawai_edit" :
                include "isi/panel/cuti/cuti_sk_daftar_pegawai_edit.php";
                break;
            case "cuti_sk_tambah_daftar_usulan" :
                include "isi/panel/cuti/cuti_sk_tambah_daftar_usulan.php";
                break;
            case "cuti_sk_tambah_pegawai_dari_usulan" :
                include "isi/panel/cuti/cuti_sk_tambah_pegawai_dari_usulan.php";
                break;
                
            // CERAI
            case "cerai_daftar_usulan" :
                include "isi/panel/cerai/cerai_daftar_usulan.php";
                break;
            case "cerai_daftar_usulan_tambah" :
                include "isi/panel/cerai/cerai_daftar_usulan_tambah.php";
                break;
            case "cerai_daftar_usulan_edit" :
                include"isi/panel/cerai/cerai_daftar_usulan_edit.php";
                break;
            case "cerai_daftar_ditolak" :
                include "isi/panel/cerai/cerai_daftar_ditolak.php";
                break;
            case "cerai_proses_no_usulan" :
                include "isi/panel/cerai/cerai_proses_no_usulan.php";
                break;
            case "cerai_proses_daftar_pegawai" :
                include "isi/panel/cerai/cerai_proses_daftar_pegawai.php";
                break;
            case "cerai_proses" :
                include "isi/panel/cerai/cerai_proses.php";
                break;
            case "cerai_sk" :
                include "isi/panel/cerai/cerai_sk.php";
                break;
            case "cerai_sk_edit" :
                include "isi/panel/cerai/cerai_sk_edit.php";
                break;
                
            // HUKUMAN DISIPLIN
            case "hdr_skpd_daftar" :
                include "isi/panel/hukuman_disiplin/hdr_skpd_daftar.php";
                break;
            case "hdr_skpd_tambah" :
                include "isi/panel/hukuman_disiplin/hdr_skpd_tambah.php";
                break;
            case "hdr_skpd_edit" :
                include "isi/panel/hukuman_disiplin/hdr_skpd_edit.php";
                break;
            case "hdsb_skpd_daftar" :
                include "isi/panel/hukuman_disiplin/hdsb_skpd_daftar.php";
                break;
            case "hdsb_skpd_tambah" :
                include "isi/panel/hukuman_disiplin/hdsb_skpd_tambah.php";
                break;
            case "hdsb_skpd_edit" :
                include "isi/panel/hukuman_disiplin/hdsb_skpd_edit.php";
                break;
            case "hdr_kesdip_daftar" :
                include "isi/panel/hukuman_disiplin/hdr_kesdip_daftar.php";
                break;
            case "hdr_kesdip_edit" :
                include "isi/panel/hukuman_disiplin/hdr_kesdip_edit.php";
                break;
            case "hdsb_kesdip_daftar" :
                include "isi/panel/hukuman_disiplin/hdsb_kesdip_daftar.php";
                break;
            case "hdsb_kesdip_edit" :
                include "isi/panel/hukuman_disiplin/hdsb_kesdip_edit.php";
                break;
                
            // BAPERTARUM
            case "bapertarum_daftar" :
                include "isi/panel/bapertarum/bapertarum_daftar.php";
                break;
            case "bapertarum_proses" :
                include "isi/panel/bapertarum/bapertarum_proses.php";
                break;
            case "laporan_bapertarum_telah_daftar" :
                include "isi/panel/bapertarum/laporan_bapertarum_telah_daftar.php";
                break;
            case "laporan_bapertarum_belum_daftar" :
                include "isi/panel/bapertarum/laporan_bapertarum_belum_daftar.php";
                break;
            case "rekap_bapertarum" :
                include "isi/panel/bapertarum/rekap_bapertarum.php";
                break;
                
            // BPJS
            case "bpjs_daftar" :
                include "isi/panel/bpjs/bpjs_daftar.php";
                break;
            case "bpjs_proses" :
                include "isi/panel/bpjs/bpjs_proses.php";
                break;
            case "laporan_bpjs_telah_daftar" :
                include "isi/panel/bpjs/laporan_bpjs_telah_daftar.php";
                break;
            case "laporan_bpjs_belum_daftar" :
                include "isi/panel/bpjs/laporan_bpjs_belum_daftar.php";
                break;
            case "rekap_bpjs" :
                include "isi/panel/bpjs/rekap_bpjs.php";
                break;
                
            // LHKPN
            case "lhkpn_wajib" :
                include "isi/panel/lhkpn/lhkpn_wajib.php";
                break;
            case "lhkpn_daftar" :
                include "isi/panel/lhkpn/lhkpn_daftar.php";
                break;
            case "lhkpn_proses_riwayat" :
                include "isi/panel/lhkpn/lhkpn_proses_riwayat.php";
                break;
            case "lhkpn_proses_tambah" :
                include "isi/panel/lhkpn/lhkpn_proses_tambah.php";
                break;
            case "lhkpn_proses_edit" :
                include "isi/panel/lhkpn/lhkpn_proses_edit.php";
                break;
            case "laporan_lhkpn_telah_daftar" :
                include "isi/panel/lhkpn/laporan_lhkpn_telah_daftar.php";
                break;
            case "laporan_lhkpn_belum_daftar" :
                include "isi/panel/lhkpn/laporan_lhkpn_belum_daftar.php";
                break;
            case "laporan_lhkpn_nhk" :
                include "isi/panel/lhkpn/laporan_lhkpn_nhk.php";
                break;
                
            // SATYA LANCANA
            case "sl_daftar_usulan" :
                include "isi/panel/satya_lancana/sl_daftar_usulan.php";
                break;
            case "sl_daftar_usulan_tambah" :
                include "isi/panel/satya_lancana/sl_daftar_usulan_tambah.php";
                break;
            case "sl_daftar_usulan_edit" :
                include "isi/panel/satya_lancana/sl_daftar_usulan_edit.php";
                break;
            case "sl_daftar_usulan_diusulkan" :
                include "isi/panel/satya_lancana/sl_daftar_usulan_diusulkan.php";
                break;
            case "sl_daftar_sk" :
                include "isi/panel/satya_lancana/sl_daftar_sk.php";
                break;
            case "sl_daftar_sk_tambah" :
                include "isi/panel/satya_lancana/sl_daftar_sk_tambah.php";
                break;
            case "sl_daftar_sk_edit" :
                include "isi/panel/satya_lancana/sl_daftar_sk_edit.php";
                break;
            case "sl_daftar_sk_diusulkan" :
                include "isi/panel/satya_lancana/sl_daftar_sk_diusulkan.php";
                break;
            case "sl_daftar_sk_diusulkan_push" :
                include "isi/panel/satya_lancana/sl_daftar_sk_diusulkan_push.php";
                break;
            case "sl_daftar_sk_diproses" :
                include "isi/panel/satya_lancana/sl_daftar_sk_diproses.php";
                break;
            case "sl_daftar_sk_diproses_lanjut" :
                include "isi/panel/satya_lancana/sl_daftar_sk_diproses_lanjut.php";
                break;
                
            // GAJI BERKALA
            case "gb_daftar_usulan" :
                include "isi/panel/gaji_berkala/gb_daftar_usulan.php";
                break;
            case "gb_daftar_usulan_tambah" :
                include "isi/panel/gaji_berkala/gb_daftar_usulan_tambah.php";
                break;
            case "gb_daftar_usulan_edit" :
                include "isi/panel/gaji_berkala/gb_daftar_usulan_edit.php";
                break;
            case "gb_daftar_usulan_diusulkan" :
                include "isi/panel/gaji_berkala/gb_daftar_usulan_diusulkan.php";
                break;
            case "gb_daftar_sk" :
                include "isi/panel/gaji_berkala/gb_daftar_sk.php";
                break;
            case "gb_daftar_sk_tambah" :
                include "isi/panel/gaji_berkala/gb_daftar_sk_tambah.php";
                break;
            case "gb_daftar_sk_edit" :
                include "isi/panel/gaji_berkala/gb_daftar_sk_edit.php";
                break;
            case "gb_daftar_sk_diusulkan" :
                include "isi/panel/gaji_berkala/gb_daftar_sk_diusulkan.php";
                break;
            case "gb_daftar_sk_diusulkan_push" :
                include "isi/panel/gaji_berkala/gb_daftar_sk_diusulkan_push.php";
                break;
            case "gb_daftar_sk_diproses" :
                include "isi/panel/gaji_berkala/gb_daftar_sk_diproses.php";
                break;
            case "gb_daftar_sk_diproses_lanjut" :
                include "isi/panel/gaji_berkala/gb_daftar_sk_diproses_lanjut.php";
                break;
                
            // PENYESUAIAN IJAZAH
            case "pi_daftar_usulan" :
                include "isi/panel/pi/pi_daftar_usulan.php";
                break;
            case "pi_daftar_usulan_tambah" :
                include "isi/panel/pi/pi_daftar_usulan_tambah.php";
                break;
            case "pi_daftar_usulan_edit" :
                include "isi/panel/pi/pi_daftar_usulan_edit.php";
                break;
            case "pi_daftar_usulan_diusulkan" :
                include "isi/panel/pi/pi_daftar_usulan_diusulkan.php";
                break;
				
			// PENYESUAIAN MASA KERJA
			case "pmk_daftar_usulan" :
				include "isi/panel/pmk/pmk_daftar_usulan.php";
				break;
			case "pmk_daftar_usulan_add" :
				include "isi/panel/pmk/pmk_daftar_usulan_add.php";
				break;
			case "pmk_daftar_usulan_edit" :
				include "isi/panel/pmk/pmk_daftar_usulan_edit.php";
				break;
			case "pmk_daftar_usulan_diusulkan" :
				include "isi/panel/pmk/pmk_daftar_usulan_diusulkan.php";
				break;	
                
            // PENCANTUMAN GELAR
            case "pg_daftar_usulan" :
                include "isi/panel/pg/pg_daftar_usulan.php";
                break;
            case "pg_daftar_usulan_tambah" :
                include "isi/panel/pg/pg_daftar_usulan_tambah.php";
                break;
            case "pg_daftar_usulan_edit" :
                include "isi/panel/pg/pg_daftar_usulan_edit.php";
                break;
            case "pg_daftar_usulan_diusulkan" :
                include "isi/panel/pg/pg_daftar_usulan_diusulkan.php";
                break;
            
            // BERITA DAN INFORMASI
            case "berita_dan_informasi_adm" :
                include "isi/panel/berita_informasi/berita_dan_informasi_adm.php";
                break;
            case "berita_dan_informasi_adm_tambah" :
                include "isi/panel/berita_informasi/berita_dan_informasi_adm_tambah.php";
                break;
            case "berita_dan_informasi_list" :
                include "isi/panel/berita_informasi/berita_dan_informasi_list.php";
                break;
            case "berita_dan_informasi_detail" :
                include "isi/panel/berita_informasi/berita_dan_informasi_detail.php";
                break;
                
            // KATA SAMBUTAN KEPALA BADAN
            case "kata_sambutan_kaban_adm" :
                include "isi/panel/kata_sambutan_kaban/kata_sambutan_kaban_adm.php";
                break;
            case "kata_sambutan_kaban" :
                include "isi/panel/kata_sambutan_kaban/kata_sambutan_kaban.php";
                break;
				
			// KENAIKAN PANGKAT
			case "daftar_kpk" : 
				include "isi/panel/kepangkatan/daftar_usulan_pangkat.php";
				break;
			case "daftar_kpk_tambah" :
				include "isi/panel/kepangkatan/usulan_pangkat_tambah.php";
				break;
			case "daftar_kpk_edit" :
				include "isi/panel/kepangkatan/usulan_pangkat_edit.php";
				break;
			case "daftar_kpk_diusulkan" :
				include "isi/panel/kepangkatan/usulan_pangkat_diusulkan.php";
				break;
			case "daftar_usulan_kpk_sedang_diproses":
				include "isi/panel/kepangkatan/daftar_usulan_pangkat_proses_bkd.php";
				break;
			case "acc_usulan_pangkat" :
				include "isi/panel/kepangkatan/acc_usulan_pangkat.php";
				break;
	        case "kenpang_daftar_sk" :
				include "isi/panel/kepangkatan/kenpang_daftar_sk.php";
				break;
			case "kenpang_sk_telah_diproses" :
				include "isi/panel/kepangkatan/kenpang_sk_telah_diproses.php";
				break;	
			case "kenpang_tambah_sk" :
				include "isi/panel/kepangkatan/kenpang_tambah_sk.php";
				break;	
			case "kenpang_daftar_sk_edit" :
				include "isi/panel/kepangkatan/kenpang_daftar_sk_edit.php";
				break;
			case "kenpang_daftar_sk_diusulkan" :
				include "isi/panel/kepangkatan/kenpang_daftar_sk_diusulkan.php";
				break;
			case "kenpang_daftar_sk_diproses" :
				include "isi/panel/kepangkatan/kenpang_daftar_sk_diproses.php";
				break;
			case "upload_sk_kenpang" :
				include "isi/panel/kepangkatan/upload_sk_kenpang.php";
				break;	
		
                
            // FILE DOWNLOAD
            case "file_download_adm" :
                include "isi/panel/file_download/file_download_adm.php";
                break;
            case "file_download_adm_tambah" :
                include "isi/panel/file_download/file_download_adm_tambah.php";
                break;
            case "file_download" :
                include "isi/panel/file_download/file_download.php";
                break;
				
			// UCAPAN UCAPAN SELAMAT
			case "list_ucapan_ultah" :
				include "isi/panel/ucapan/daftar_ucapan_ultah.php";
				break;
			case "ucapan_ultah_edit" :
				include "isi/panel/ucapan/ucapan_ultah_edit.php";
				break;
        }
	  }	
    }
?>
</div>
<div style="clear: both;"></div>
<div id="footer" style="background-color: #eeeedd; padding: 5px;"><?php include "isi/widget/footer.php"; ?></div>

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
                    <select id="as_id_skpd"></select>
                    <br />
                    <div id="harap_tunggu" style="display: none;">Harap tunggu, sedang loading data SKPD...</div>
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