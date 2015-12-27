<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];
if($jenis_urus == "02")
	{
		$af = "../../../modules/ptkdlmnegeri/distribusi_kasus/cek_imta.php";
		include($af);
	}
?>