<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/kasiwasnaker/penugasan/cek_imta.php";
		include($af);
	}
else if($jenis_urus == "03")
	{
		include("../../../modules/kasiwasnaker/penugasan/cek_pengaduan.php");
	}
else if($jenis_urus == "01")
	{
		include("../../../modules/kasiwasnaker/penugasan/cek_wl.php");
	}
?>