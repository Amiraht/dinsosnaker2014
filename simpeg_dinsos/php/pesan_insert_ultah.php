<?php

	include "mysqli_connect.php";
	include "fungsi.php";
	
	$tujuan_list = $_POST['tujuan'];
	$dari = $_POST['dari'];
	
	$pesan = $_POST['pesan'];
	
	$sql = "";
	
	$i = 0;
	foreach($tujuan_list as $tujuan){
		$sql .= "INSERT INTO tbl_ucapan_ultah_pegawai VALUES(NULL, '".$dari."', '".$tujuan."', '".$pesan[$i]."', NOW(), CURDATE(), '1');";
		$i++;
	}
	
	$query = $con->multi_query($sql);
	
	if($query){
		header("Location:..?mod=ucapan_ultah");
	}