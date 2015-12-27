<?php
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$jenis_urus = $data[0];

$af = "../../../modules/kabidwasnaker/paraf_sk/cek_wl.php";
include($af);

?>