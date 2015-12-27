<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/kasubag_umum/penomoran_sk/cek_imta.php";
		include($af);
	}
else if($jenis_urus == "03")
	{
		include("../../../modules/kasubag_umum/penomoran_sk/cek_pengaduan.php");
	}
else if($jenis_urus == "01")
	{
		include("../../../modules/kasubag_umum/penomoran_sk/cek_wl.php");
	}	
else if($jenis_urus == "04")
	{
		include("../../../modules/kasubag_umum/penomoran_sk/cek_janji.php");
	}
else if($jenis_urus == "05")
	{
		include("../../../modules/kasubag_umum/penomoran_sk/cek_sah.php");
	}	
else if($jenis_urus == "06")
	{
		include("../../../modules/kasubag_umum/penomoran_sk/cek_iplk.php");
	}		
?>