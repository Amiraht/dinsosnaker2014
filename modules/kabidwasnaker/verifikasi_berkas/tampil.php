<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/kabidwasnaker/verifikasi_berkas/cek_imta.php";
		include($af);
	}
elseif($jenis_urus == "03")
	{
		$af = "../../../modules/kabidwasnaker/verifikasi_berkas/cek_pengaduan.php";
		include($af);
	}
elseif($jenis_urus == "01")
	{
		$af = "../../../modules/kabidwasnaker/verifikasi_berkas/cek_wl.php";
		include($af);
	}
?>