<?php
$nama = anti_injection($_POST["nama"]);
$id_per = anti_injection($_POST["id_per"]);
$no_ktp = anti_injection($_POST["no_ktp"]);
$alamat = anti_injection($_POST["alamat"]);
$no_hp = anti_injection($_POST["no_hp"]);
$no_telp = anti_injection($_POST["no_telp"]);
$mulai_bekerja = anti_injection($_POST["mulai_bekerja"]);
$jabatan = anti_injection($_POST["jabatan"]);
$dasar_permasalahan = anti_injection($_POST["dasar_permasalahan"]);
$masa_kerja = anti_injection($_POST["masa_kerja"]);
$kronologis = anti_injection($_POST["kronologis"]);
$janji = anti_injection($_POST["janji"]);
$upah = anti_injection($_POST["upah"]);

if((int)$_GET["mode"] == 1)
{
	if($nama == '' or $id_per == '' or $no_ktp == '' or $alamat == '' or $no_hp == '' or $no_telp == '' or $mulai_bekerja == '' or $jabatan == '' or $dasar_permasalahan == '' or $masa_kerja == '' or $kronologis == '' or $janji == '' )
	{
	?>
		<script type="text/javascript">
			alert('Isi dengan lengkap !');
			document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=baru_pengaduan&id=<?php echo $id_per; ?>';
		</script>
	<?php
	}

	$query=mysql_query("SELECT no_resi FROM tbl_berkas_pengaduan ORDER BY no_resi DESC");
			if(mysql_num_rows($query)>0)
			{
				$result=mysql_fetch_row($query);
				$data=explode("-",$result[0]);
				$jenis_urus = $data[0];
				$data[1]+=1;
				if($data[1]>99)
					$no_resi="03-".$data[1];
				else if($data[1]>9)
					$no_resi="03-0".$data[1];
				else if($data[1]<=9)
					$no_resi="03-00".$data[1];
			}else
			{
				$no_resi="03-001";
				$jenis_urus="03";
			}
				
	$qinsert="INSERT INTO tbl_berkas_pengaduan(no_resi,tgl_masuk_berkas,id_perusahaan, nama,no_ktp,
	alamat,no_hp,no_telp,mulai_bekerja,jabatan,dasar_permasalahan,masa_kerja,kronologis,janji,upah)
	VALUES 
	('$no_resi',curdate(),'$id_per', '$nama', '$no_ktp','$alamat',
	 '$no_hp','$no_telp','$mulai_bekerja','$jabatan','$dasar_permasalahan',
	 '$masa_kerja','$kronologis','$janji','$upah')";

	$az = "insert into tbl_info_berkas(no_resi,jenis_pengurusan,id_perusahaan,tgl_masuk,pemohon,alamat_pemohon,id_proses_skrg,id_proses_sblm,isValid,isDisposisi)
				values
			('$no_resi','$jenis_urus','$id_per',curdate(),'$nama','$alamat','11','10','1','3')";
			
	$c = mysql_query($qinsert);
	$d = mysql_query($az);
	$encode = base64_encode(base64_encode(base64_encode(base64_encode($no_resi))));
	if($d)
	{
		benar("./index.php?mod=loket&opt=proses_permohonan&opts=main_pengaduan&no_resi=".$encode);
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
	
	if($nama == ''  or $id_per == '' or $no_ktp == '' or $alamat == '' or $no_hp == '' or $no_telp == '' or $mulai_bekerja == '' or $jabatan == '' or $dasar_permasalahan == '' or $masa_kerja == '' or $kronologis == '' or $janji == '' )
	{
	?>
		<script type="text/javascript">
			alert('Isi dengan lengkap !');
			document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=edit_pengaduan&no_resi=<?php echo $no_resi; ?>';
		</script>
	<?php
	}	
	$qryupdate="update tbl_berkas_pengaduan set nama='$nama',no_ktp='$no_ktp',alamat='$alamat',
				no_hp='$no_hp',no_telp='$no_telp',mulai_bekerja='$mulai_bekerja',jabatan='$jabatan',
				dasar_permasalahan='$dasar_permasalahan',masa_kerja='$masa_kerja',
				kronologis='$kronologis',janji='$janji',upah='$upah' where no_resi='$no_resi'";
	$qupdate = "update tbl_info_berkas set pemohon='$nama',alamat_pemohon='$alamat',id_proses_skrg='11',id_proses_sblm='12',isDisposisi='3' where no_resi='$no_resi'";
	
	$e = mysql_query($qupdate);
	$d = mysql_query($qryupdate);
	
	
	if($d)
	{
		benar("./index.php?mod=loket&opt=proses_permohonan&opts=main_pengaduan&no_resi=".$no_resi);
		exit();
	}
	else
	{
		salah("./index.php?mod=loket&opt=proses_permohonan&opts=edit_pengaduan&no_resi=".$no_resi);
		exit();
	}
}
else
	failed();
?>