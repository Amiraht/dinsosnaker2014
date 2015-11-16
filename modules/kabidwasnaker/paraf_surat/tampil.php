<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/kabidwasnaker/paraf_surat/cek_imta.php";
		include($af);
	}
else if($jenis_urus == "03")
	{
		include("../../../modules/kabidwasnaker/paraf_surat/cek_pengaduan.php");
	}
else if($jenis_urus == "01")
	{
		include("../../../modules/kabidwasnaker/paraf_surat/cek_wl.php");
	}
?>