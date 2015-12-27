<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	
	$dari = $_POST['dari'];
	$tujuan = str_replace(" ","",$_POST['tujuan']);
	$pesan = $_POST['pesan'];
	
	$sql ="INSERT INTO tbl_ucapan_naik_pangkat VALUES(NULL, '".$dari."', '".$tujuan."', '".$pesan."' ,
			CURDATE(), '1')";
	
	$query = mysql_query($sql);

	if($query){
			header("Location:../../?mod=ucapan_kenaikan_pangkat&code=1&mode=add");
	}else{
		header("Location:../../?mod=ucapan_kenaikan_pangkat&code=2&mode=add");
	}	
	
	mysql_close();