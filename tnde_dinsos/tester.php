<?php
	
	include "method/function.php";
	
	$url = "?mod=loket_transaksi_modul";

	echo "URL : " . $url . "<br/><br/>";

	echo "Encode URL " . encode_url($url) . "<br/><br/>";
	
	echo "Decode URL " . decode_url(encode_url($url)) . "<br/><br/>";