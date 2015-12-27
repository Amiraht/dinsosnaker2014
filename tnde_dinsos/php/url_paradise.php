<?php

	$url_main = "";
	
	// tentukan jenis hak akses dari masing-masing user
	// lalu tentukan halaman utama yang harus di link kan
	// di setiap halaman modul
	
	   switch($_SESSION['id_level']){
			case 3 :
				$url_main = "./?mod=main_loket";
				break;
			case 17 :
				$url_main = "./?mod=main_kaban";
				break;
			case 16 :
				$url_main = "./?mod=main_sekretaris";
				break;
			case 11 :
			case 22 :
			case 4 :
			case 7 :
				$url_main = "./?mod=main_kabid";
				break;
			case 15 :
				$url_main = "./?mod=main_kasubbag_umum";
				break;
			case 18 :
				$url_main = "./?mod=main_arsip";
				break;
			case 5  :
			case 8  :
			case 12 :
			case 20 :
			case 23 :
					$url_main = "./?mod=main_kasi";
					break;	
			case 10:
			case 14:
			case 21:
			case 24:
			case 25:
			case 6:
				$url_main = "./?mod=main_staff";
				break;
			case 19 :
				$url_main = "./?mod=main_administrator";
				break;
			default :
				$url_main = "./";
				break;
			
		}