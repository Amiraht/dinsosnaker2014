<?php
    include "../php/koneksi.php";
    include "../php/fungsi.php";
	//include "../php/mysqli_connect.php";
	
	$id_usul = mysql_real_escape_string($_GET['id_surat']);
	
	$sql = "SELECT * FROM tbl_sk_pmk WHERE id_surat = '$id_usul'";
	$query = mysql_query($sql);
   
    $row = mysql_fetch_array($query);
	
	if($row['catatan'] <> ''){
		echo "Catatan Penolakan : <br/>";
		echo $row['catatan'] . "<br/>";
	}else{
		echo "<center><b>Tidak ada catatan penolakan / supervisi</b></center>";
	}
	
	
	
	
	