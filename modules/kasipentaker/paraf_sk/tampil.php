<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/kasipentaker/paraf_sk/cek_imta.php";
		include($af);
	}
else if($jenis_urus == "03")
	{
		include("../../../modules/kasipentaker/paraf_sk/cek_pengaduan.php");
	}
?>