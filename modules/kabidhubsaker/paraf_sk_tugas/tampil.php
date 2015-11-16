<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];

if($jenis_urus == "04")
	{
		include("../../../modules/kabidhubsaker/paraf_sk_tugas/cek_janji.php");
	}
else if($jenis_urus == "05")
	{
		include("../../../modules/kabidhubsaker/paraf_sk_tugas/cek_sah.php");
	}	
	
?>