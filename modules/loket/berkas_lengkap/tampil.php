<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
/*if($jenis_urus == "02")
	{
		$af = "../../../modules/loket/berkas_serah/cek_imta.php";
		include($af);
	}
else if($jenis_urus == "03")
	{
		include("../../../modules/loket/berkas_serah/cek_pengaduan.php");
	}
*/
include("../../../modules/loket/berkas_lengkap/cek_all.php");
?>