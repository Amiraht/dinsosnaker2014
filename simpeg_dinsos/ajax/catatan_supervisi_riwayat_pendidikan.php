<?php
    include "../php/koneksi.php";
    include "../php/fungsi.php";
	//include "../php/mysqli_connect.php";
	
	$id = mysql_real_escape_string($_GET['id']);
	
	$sql = "SELECT * FROM tbl_riwayat_pendidikan WHERE id_data_rp = '$id'";
	$query = mysql_query($sql);
   
    $row = mysql_fetch_array($query);
	
	if($row['catatan'] != ''){
		echo "Catatan Supervisi : <br/>";
		echo $row['catatan'] . "<br/>";
	}else{
		echo "<center><b>Catatan Supervisi Kosong !!</b></center>";
	}
	
	
	
	
	