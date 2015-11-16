<?php

$id_per = anti_injection($_POST["id_per"]);
$nama_ta = anti_injection($_POST["nama_ta"]);
$umur = anti_injection($_POST["umur"]);
$tgl_lahir = anti_injection($_POST["tgl_lahir"]);
$kewarganegaraan = anti_injection($_POST["kewarganegaraan"]);
$alamat = anti_injection($_POST["alamat"]);
$no_pasport = anti_injection($_POST["no_pasport"]);
$jabatan = anti_injection($_POST["jabatan"]);
$berlaku_dari = anti_injection($_POST["berlaku_dari"]);
$berlaku_sampai = anti_injection($_POST["berlaku_sampai"]);
$no_surat_permohonan = anti_injection($_POST["no_surat_permohonan"]);
$tgl_berakhir = anti_injection($_POST["tgl_berakhir"]);
$nama_imta = anti_injection($_POST["nama_imta"]);
$no_imta = anti_injection($_POST["no_imta"]);
$tgl_imta = anti_injection($_POST["tgl_imta"]);
$no_rptka = anti_injection($_POST["no_rptka"]);
$tgl_rptka = anti_injection($_POST["tgl_rptka"]);
$tgl_setoran_dpkk = anti_injection($_POST["tgl_setoran_dpkk"]);
$jlh_setoran_dpkk = anti_injection($_POST["jlh_setoran_dpkk"]);


if((int)$_GET["mode"] == 1)
{
	if($nama_ta == '' or $id_per == '' or $umur == '' or $tgl_lahir == '' or $kewarganegaraan == '' or $alamat == '' or $no_pasport == '' or $jabatan == '' or $berlaku_dari == '' or $berlaku_sampai == '' or $no_surat_permohonan == '' or $tgl_berakhir == '' or $nama_imta == '' or $no_imta == '' or $tgl_imta == '' or $no_rptka == '' or $tgl_rptka == '' or $tgl_setoran_dpkk == '' or $jlh_setoran_dpkk == '' )
	{
	?>
		<script type="text/javascript">
			alert('Isi dengan lengkap !');
			document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=baru_imta&id=<?php echo $id_per; ?>';
		</script>
	<?php
	}

	$query=mysql_query("SELECT no_resi FROM tbl_berkas_imta ORDER BY no_resi DESC");
			$result=mysql_fetch_row($query);
			$data=explode("-",$result[0]);
			$jenis_urus = $data[0];
			$data[1]+=1;
			if($data[1]>99)
				$no_resi="02-".$data[1];
			else if($data[1]>9)
				$no_resi="02-0".$data[1];
			else if($data[1]<=9)
				$no_resi="02-00".$data[1];
				
	$qinsert="	INSERT INTO tbl_berkas_imta
	(no_resi,tgl_masuk_berkas,id_perusahaan, nama_ta,umur,tgl_lahir,kewarganegaraan,
	alamat,no_passport,jabatan,berlaku_dari,berlaku_sampai,no_surat_permohonan,nama_imta,
	no_imta,tgl_imta,tgl_berakhir,no_rptka,tgl_rptka,tgl_setoran_dpkk,jlh_setoran_dpkk) 
	VALUES 

	('$no_resi',curdate(),'$id_per', '$nama_ta', '$umur','$tgl_lahir',
	 '$kewarganegaraan','$alamat','$no_pasport','$jabatan','$berlaku_dari',
	 '$berlaku_sampai','$no_surat_permohonan','$nama_imta','$no_imta','$tgl_imta',
	 '$tgl_berakhir','$no_rptka','$tgl_rptka','$tgl_setoran_dpkk','$jlh_setoran_dpkk')";

	$az = "insert into tbl_info_berkas(no_resi,jenis_pengurusan,id_perusahaan,tgl_masuk,pemohon,alamat_pemohon,id_proses_skrg,id_proses_sblm,isValid,isDisposisi)
				values
			('$no_resi','$jenis_urus','$id_per',curdate(),'$nama_ta','$alamat','11','10','1','3')";
			
	$c = mysql_query($qinsert);
	$d = mysql_query($az);
	
	if($d)
	{
		benar("./index.php?mod=loket&opt=proses_permohonan&opts=main_imta&no_resi=".$no_resi);
		exit();
	}
	else
	{
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
	
	if($nama_ta == '' or $id_per == '' or $umur == '' or $tgl_lahir == '' or $kewarganegaraan == '' or $alamat == '' or $no_pasport == '' or $jabatan == '' or $berlaku_dari == '' or $berlaku_sampai == '' or $no_surat_permohonan == '' or $tgl_berakhir == '' or $nama_imta == '' or $no_imta == '' or $tgl_imta == '' or $no_rptka == '' or $tgl_rptka == '' or $tgl_setoran_dpkk == '' or $jlh_setoran_dpkk == '' )
	{
	?>
		<script type="text/javascript">
			alert('Isi dengan lengkap !');
			document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=edit_imta&no_resi=<?php echo $no_resi; ?>';
		</script>
	<?php
	}	
	$qryupdate="update tbl_berkas_imta set nama_ta='$nama_ta',umur='$umur',tgl_lahir='$tgl_lahir',
				kewarganegaraan='$kewarganegaraan',alamat='$alamat',no_passport='$no_pasport',jabatan='$jabatan',
				berlaku_dari='$berlaku_dari',berlaku_sampai='$berlaku_sampai',
				no_surat_permohonan='$no_surat_permohonan',tgl_berakhir='$tgl_berakhir',
				nama_imta='$nama_imta',no_imta='$no_imta',jlh_setoran_dpkk='$jlh_setoran_dpkk',
				tgl_imta='$tgl_imta',no_rptka='$no_rptka',tgl_rptka='$tgl_rptka',tgl_setoran_dpkk='$tgl_setoran_dpkk' where no_resi='$no_resi'";
	$qupdate = "update tbl_info_berkas set pemohon='$nama_ta',alamat_pemohon='$alamat',id_proses_skrg='11',id_proses_sblm='12',isDisposisi='3' where no_resi='$no_resi'";
	
	$e = mysql_query($qupdate);
	$d = mysql_query($qryupdate);
	
	
	if($d)
	{
		benar("./index.php?mod=loket&opt=proses_permohonan&opts=main_imta&no_resi=".$no_resi);
		exit();
	}
	else
	{
		salah("./index.php?mod=loket&opt=proses_permohonan&opts=edit_imta&no_resi=".$no_resi);
		exit();
	}
}
else
	failed();
?>