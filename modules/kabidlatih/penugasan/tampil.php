<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/kabidlatih/penugasan/cek_imta.php";
		include($af);
	}
elseif($jenis_urus == "03")
	{
		$af = "../../../modules/kabidlatih/penugasan/cek_pengaduan.php";
		include($af);
	}
else if($jenis_urus == "04")
	{
		include("../../../modules/kabidlatih/penugasan/cek_janji.php");
	}
else if($jenis_urus == "05")
	{
		include("../../../modules/kabidlatih/penugasan/cek_sah.php");
	}	
else if($jenis_urus == "06")
	{
		include("../../../modules/kabidlatih/penugasan/cek_iplk.php");
	}	
?>