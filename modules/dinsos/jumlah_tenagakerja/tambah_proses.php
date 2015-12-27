<?php
require_once("../../../../libraries/dinsos.php");
	$wnilk=$_POST["wnilk"];$wnipr=$_POST["wnipr"];$wnalk=$_POST["wnalk"];$wnapr=$_POST["wnapr"];
	
	$isupdate=$_POST["hidden"];
	$id_per=$_POST["hidden2"];

	
	if($isupdate=="y")
	{
	$aaa = "insert into log_update_jlh_tenagakerja
		(id_perusahaan,tgl_update,wnilk,wnipr,wnalk,wnapr)
		values ($id_per,curdate(),$wnilk,$wnipr,$wnalk,$wnapr)";
	$ac =mysql_query("$aaa");
		  
	
	$query = "update tbl_tenagakerja set wnilk=$wnilk, wnipr=$wnipr, wnalk=$wnalk, wnapr=$wnapr
			  where id_perusahaan='$id_per'";
	
	}
	else{
	$isVal = "0";
	$isSame = "0";
	$query = "update tbl_tenagakerja set wnilk=$wnilk, wnipr=$wnipr, wnalk=$wnalk, wnapr=$wnapr
			  where id_perusahaan='$id_per'";
	}
	$do = mysql_query("$query");

	if($do)
	{
	echo "<script type='text/javascript'>
			alert('DATA JUMLAH TENAGA KERJA BERHASIL DITAMBAHKAN');
			var t=document.getElementById('div_isi_$id_per').style.Display='none';
		</script>";
	}
		else
	{
		echo "<script type='text/javascript'>
			alert('DATA JUMLAH TENAGA KERJA  GAGAL DITAMBAHKAN');
			document.location = 'index.php?mod=menu&do=tenaga_kerja';
		</script>";
	}
?>