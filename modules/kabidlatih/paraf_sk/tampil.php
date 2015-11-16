<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];

$af = "../../../modules/kabidlatih/paraf_sk/cek_iplk.php";
include($af);

?>