<?php
error_reporting(E_ALL ^ E_NOTICE);
	switch($_GET["act"])
	{
		case "search" :
			include('./modules/dinsos/daftar_perusahaan/search.php');
			break;					
		case "register" :
			include('./modules/dinsos/daftar_perusahaan/daftar_perusahaan.php');
			break;
		case "validate" :
			include('./modules/dinsos/daftar_perusahaan/register_proses.php');
			break;
		case "verify" :
			include('./modules/dinsos/daftar_perusahaan/detail.php');
			break;
		case "frame" :
			include('./modules/dinsos/daftar_perusahaan/frame.php');
			break;
		default :
			include('./modules/dinsos/daftar_perusahaan/search.php');
	}
			
?>
