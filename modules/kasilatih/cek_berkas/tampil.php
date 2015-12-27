<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/kasilatih/cek_berkas/cek_imta.php";
		include($af);
	}
else if($jenis_urus == "03")
	{
		include("../../../modules/kasilatih/cek_berkas/cek_pengaduan.php");
	}
else if($jenis_urus == "01")
	{
		include("../../../modules/kasilatih/cek_berkas/cek_wl.php");
	}
else if($jenis_urus == "06")
	{
		include("../../../modules/kasilatih/cek_berkas/cek_iplk.php");
	}	
?>