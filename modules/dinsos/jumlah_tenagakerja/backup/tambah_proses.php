<?php
include "./module/header.php";

	$wnilk=$_POST["wnilk"];$wnipr=$_POST["wnipr"];$wnalk=$_POST["wnalk"];$wnapr=$_POST["wnapr"];
	
	$isupdate=$_POST["hidden"];
	$id_per=$_POST["hidden2"];
	$sumber=$_POST["sumber"];
	
	if($isupdate=="y")
	{
	$ac =mysql_query("insert into log_update_jlh_tenagakerja
		id_perusahaan,tgl_update,wnilk,wnipr,wnalk,wnapr)
		values ($id_per,curdate(),$wnilk,$wnipr,$wnalk,$wnapr)");
		  
	
	$query = "update tbl_tenagakerja set wnilk=$wnilk, wnipr=$wnipr, wnalk=$wnalk, wnapr=$wnapr, 
			  where id_perusahaan='$id_per'";
	
	}
	else{
	$isVal = "0";
	$isSame = "0";
	$query = "insert into tbl_tenagakerja (id_perusahaan,wnilk,wnipr,wnalk,wnapr,isValidate,isSesuai) 
			  values ($id_per,$wnilk,$wnipr,$wnalk,$wnapr,$isVal,$isSame)";
	}
	$do = mysql_query("$query");

	if($do)
	{

	echo "<script type='text/javascript'>
			alert('DATA PERUSAHAAN BERHASIL DITAMBAHKAN $ba');
			document.location = 'index.php?mod=menu&do=main';
		</script>";
	}
		else
	{
		echo "<script type='text/javascript'>
			alert('DATA PERUSAHAAN GAGAL DITAMBAHKAN\n$query');
			document.location = 'index.php?mod=menu&do=daftar&act=register';
		</script>";
	}
	include "./module/footer.php";
?>