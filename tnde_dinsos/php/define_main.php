<?php
	// aktifkan variabel session
	session_start();
	
	// FILE INI BERGUNA UNTUK SETTINGAN HALAMAN UTAMA PER AKSES LEVEL
	
	$main = "";
	
	switch($_SESSION['id_level']){
		case 18 :
				$main = "./?mod=main_loket";
				break;
			case 1 :
				$main = "./?mod=main_kaban";
				break;
			case 2 :
				$main = "./?mod=main_sekretaris";
				break;
			case 3 :
			case 4 :
			case 5 :
			case 6 :
				$main = "./?mod=main_kabid";
				break;
			case 7 : 
			case 8 :
			case 9 :
				$main = "./?mod=main_kasubbag_umum";
				break;
	}
	