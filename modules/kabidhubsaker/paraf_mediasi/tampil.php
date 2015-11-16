<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/kabidhubsaker/paraf_mediasi/cek_imta.php";
		include($af);
	}
else if($jenis_urus == "03")
	{
		include("../../../modules/kabidhubsaker/paraf_mediasi/cek_pengaduan.php");
	}
else if($jenis_urus == "04")
	{
		include("../../../modules/kabidhubsaker/paraf_mediasi/cek_janji.php");
	}
else if($jenis_urus == "05")
	{
		include("../../../modules/kabidhubsaker/paraf_mediasi/cek_sah.php");
	}		
?>