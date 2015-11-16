<?php

// all POST VARIABLES from baru_iplk.php file
// CMIIWW
$id_per = anti_injection($_POST["id_per"]);
$nama_pemohon = anti_injection($_POST["nama_pemohon"]);
$alamat_pemohon = anti_injection($_POST["alamat_pemohon"]);
$no_hp = anti_injection($_POST["no_hp"]);
$nama_lembaga = anti_injection($_POST["nama_lembaga"]);
$no_akte = anti_injection($_POST["no_akte"]);
$nama_penanggung_jawab = anti_injection($_POST["nama_penanggung_jawab"]);
$bentuk_usaha = anti_injection($_POST["bentuk_usaha"]);
$sumber_siswa = anti_injection($_POST["sumber_siswa"]);
$sumber_biaya = anti_injection($_POST["sumber_biaya"]);
$sifat = anti_injection($_POST["sifat"]);
$id_urus = setIDTabel("tbl_berkas_iplk", "id_urus_janji");
$id_berkas = setIDTabel("tbl_info_berkas", "id");
//print "ID URUS : " . $id_berkas . "<br/>";

if((int)$_GET["mode"] == 1)
{
	
	if($nama_pemohon == '' or $alamat_pemohon == '' or $no_hp == '' or $nama_lembaga == '' or $id_per == '' or $no_akte == '' or $nama_penanggung_jawab == '' or $bentuk_usaha == '' or $sumber_siswa == '' or $sumber_biaya == '' or $sifat == '' )
	{
	?>
		<script type="text/javascript">
			alert('Isi dengan lengkap !');
			document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=baru_iplk&id=<?php echo $id_per; ?>';
		</script>
	<?php
	}

			$dt = iniateResi(); // calling pengaturan inisiasi nomor resi
			//echo $dt['no_resi'] . "<br/>";	
	$str = "INSERT INTO tbl_berkas_iplk 
			VALUES('$id_urus', '$nama_pemohon', '$alamat_pemohon', '$no_hp', '".$dt['no_resi']."', curdate(), '$id_per', '$nama_lembaga', 
			'$no_akte', '$nama_penanggung_jawab', '$bentuk_usaha', '$sumber_siswa', '$sumber_biaya', '$sifat')";
	
	$az = "insert into tbl_info_berkas(id, no_resi,jenis_pengurusan,id_perusahaan,tgl_masuk,pemohon,alamat_pemohon,id_proses_skrg,id_proses_sblm,isValid,isDisposisi)
				values
			('$id_berkas','".$dt['no_resi']."','".$dt['jenis_urus']."','$id_per',curdate(),'$nama_pemohon','$alamat_pemohon','11','10','1','3')";
			
	$c = mysql_query($str) or die(mysql_error());
	$d = mysql_query($az);
	
	if($c)
	{
	   // echo "sukses";
		benar("./index.php?mod=loket&opt=proses_permohonan&opts=main_iplk&no_resi=".$dt['no_resi']);
		exit();
	}
	else
	{
		//echo "gagal";
		salah("./index.php?mod=loket&opt=proses_permohonan&opts=baru");
		exit();
	}
}
else if((int)$_GET["mode"] == 2)
{
	
	$no_resi = anti_injection($_POST["no_resi"]);
	if($no_resi== '')
	{
		failed();
		exit();
	}
	
	if($nama_pemohon == '' or $alamat_pemohon == '' or $nama_lembaga == '' or $id_per == '' or $no_akte == '' or $nama_penanggung_jawab == '' or $bentuk_usaha == '' or $sumber_siswa == '' or $sumber_biaya == '' or $sifat == '' )
	{
	$tes='1'.$nama_pemohon.'2'.$alamat_pemohon.'3'.$nama_lembaga.'4'.$id_per.'5'.$no_akte.'6'.$nama_penanggung_jawab.'7'.$bentuk_usaha.'8'.$sumber_siswa.'9'.$sumber_biaya.'10'.$sifat;
	?>
		<script type="text/javascript">
			alert('<?php echo $tes;?>');
			document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=edit_iplk&no_resi=<?php echo $no_resi; ?>';
		</script>
	<?php
	}	
	$qryupdate = "update tbl_berkas_iplk set nama_pemohon='$nama_pemohon',alamat_pemohon='$alamat_pemohon',no_hp='$no_hp',nama_lembaga='$nama_lembaga',no_akte='$no_akte',nama_penanggung_jawab='$nama_penanggung_jawab',bentuk_usaha='$bentuk_usaha',sumber_biaya='$sumber_biaya',sumber_siswa='$sumber_siswa',sifat='$sifat' where no_resi='$no_resi'";
	$qupdate = "update tbl_info_berkas set pemohon='$nama_pemohon',alamat_pemohon='$alamat_pemohon',id_proses_skrg='11',id_proses_sblm='12',isDisposisi='3' where no_resi='$no_resi'";
	
	$e = mysql_query($qupdate);
	$d = mysql_query($qryupdate);
	
	if($d)
	{
		benar("./index.php?mod=loket&opt=proses_permohonan&opts=main_iplk&no_resi=".$no_resi);
		exit();
	}
	else
	{
		salah("./index.php?mod=loket&opt=proses_permohonan&opts=edit_iplk&no_resi=".$no_resi);
		exit();
	}
}
else
	failed();
?>