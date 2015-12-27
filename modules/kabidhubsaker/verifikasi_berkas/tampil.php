<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/kabidhubsaker/verifikasi_berkas/cek_imta.php";
		include($af);
	}
elseif($jenis_urus == "03")
	{
		$af = "../../../modules/kabidhubsaker/verifikasi_berkas/cek_pengaduan.php";
		include($af);
	}
else if($jenis_urus == "04")
	{
		include("../../../modules/kabidhubsaker/verifikasi_berkas/cek_janji.php");
	}
else if($jenis_urus == "05")
	{
		include("../../../modules/kabidhubsaker/verifikasi_berkas/cek_sah.php");
	}	
?>