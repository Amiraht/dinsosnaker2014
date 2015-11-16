<?php	
error_reporting(E_ALL ^ E_NOTICE);
	switch($_GET["act"])
	{
		case "search" :
			include('./module/jumlah_tenagakerja/search_proses.php');
			break;	
		case "daftar" :
			include('./module/daftar_perusahaan/daftar_perusahaan.php');
			break;				
		case "isi" :
			include('./module/jumlah_tenagakerja/tambah_tenagakerja.php');
			break;
		case "validate" :
			include('./module/jumlah_tenagakerja/tambah_proses.php');
			break;	
		default :
			include('./module/jumlah_tenagakerja/search.php');
	}