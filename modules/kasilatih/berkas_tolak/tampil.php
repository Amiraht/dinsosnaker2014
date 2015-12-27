<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/kasilatih/verifikasi_berkas/cek_imta.php";
		include($af);
	}
elseif($jenis_urus == "03")
	{
		$af = "../../../modules/kasilatih/verifikasi_berkas/cek_pengaduan.php";
		include($af);
	}
elseif($jenis_urus == "01")
	{
		$af = "../../../modules/kasilatih/berkas_tolak/cek_wl.php";
		include($af);
	}
elseif($jenis_urus == "06")
	{
		$af = "../../../modules/kasilatih/berkas_tolak/cek_iplk.php";
		include($af);
	}	
?>