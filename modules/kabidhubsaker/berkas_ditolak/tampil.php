<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/kabidhubsaker/berkas_ditolak/cek_imta.php";
		include($af);
	}
elseif($jenis_urus == "03")
	{
		$af = "../../../modules/kabidhubsaker/berkas_ditolak/cek_pengaduan.php";
		include($af);
	}
elseif($jenis_urus == "01")
	{
		$af = "../../../modules/kabidhubsaker/berkas_ditolak/cek_wl.php";
		include($af);
	}
elseif($jenis_urus == "04")
	{
		$af = "../../../modules/kabidhubsaker/berkas_ditolak/cek_janji.php";
		include($af);
	}
elseif($jenis_urus == "05")
	{
		$af = "../../../modules/kabidhubsaker/berkas_ditolak/cek_sah.php";
		include($af);
	}		
?>