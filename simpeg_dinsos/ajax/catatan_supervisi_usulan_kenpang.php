<?php
    include "../php/koneksi.php";
    include "../php/fungsi.php";
	//include "../php/mysqli_connect.php";
	
	$id_usul = mysql_real_escape_string($_GET['id_usulan']);
	
	$sql = "SELECT * FROM tbl_usulan_pangkat WHERE id_usulan = '$id_usul'";
	$query = mysql_query($sql);
   
    $row = mysql_fetch_array($query);
	
	if($row['catatan'] <> ''){
		echo "Catatan Penolakan : <br/>";
		echo $row['catatan'] . "<br/>";
	}else{
		echo "<center><b>Tidak ada catatan penolakan / supervisi</b></center>";
	}
	
	
	
	
	