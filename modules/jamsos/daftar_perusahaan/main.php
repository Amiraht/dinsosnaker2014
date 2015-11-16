<?php
error_reporting(E_ALL ^ E_NOTICE);
	switch($_GET["act"])
	{
		case "search" :
			include('./modules/jamsos/daftar_perusahaan/search.php');
			break;					
		case "register" :
			include('./modules/jamsos/daftar_perusahaan/daftar_perusahaan.php');
			break;
		case "validate" :
			include('./modules/jamsos/daftar_perusahaan/register_proses.php');
			break;
		case "verify" :
			include('./modules/jamsos/daftar_perusahaan/detail.php');
			break;
		case "frame" :
			include('./modules/jamsos/daftar_perusahaan/frame.php');
			break;
		default :
			include('./modules/jamsos/daftar_perusahaan/search.php');
	}
			
?>
