<?php

$id_per = anti_injection($_POST["id_per"]);
$nama_pemohon = anti_injection($_POST["nama_pemohon"]);
$alamat_pemohon = anti_injection($_POST["alamat_pemohon"]);
$no_surat = anti_injection($_POST["no_surat"]);
$tgl_surat = anti_injection($_POST["tgl_surat"]);
$no_jamsostek = anti_injection($_POST["no_jamsostek"]);
$tenaga_lk = anti_injection($_POST["tenaga_lk"]);
$tenaga_pr = anti_injection($_POST["tenaga_pr"]);
$tenaga_lk_cabang = anti_injection($_POST["tenaga_lk_cabang"]);
$tenaga_pr_cabang = anti_injection($_POST["tenaga_pr_cabang"]);
$upah_bulanan_max = anti_injection($_POST["upah_bulanan_max"]);
$upah_bulanan_min = anti_injection($_POST["upah_bulanan_min"]);
$upah_harian_max = anti_injection($_POST["upah_harian_max"]);
$upah_harian_min = anti_injection($_POST["upah_harian_min"]);
$hub_tentu = anti_injection($_POST["hub_tentu"]);
$hub_tak_tentu = anti_injection($_POST["hub_tak_tentu"]);
$waktu_pkb = anti_injection($_POST["waktu_pkb"]);
$pkb_daftar = anti_injection($_POST["pkb_daftar"]);
$no_apindo = anti_injection($_POST["no_apindo"]);
$koperasi = anti_injection($_POST["koperasi"]);
$no_hp = anti_injection($_POST['no_hp']);


if((int)$_GET["mode"] == 1)
{
	if($nama_pemohon == '' or $alamat_pemohon == '' or $no_surat == '' or $id_per == '' or $tgl_surat == '' or $no_jamsostek == '' or $tenaga_lk == '' or $tenaga_pr == '' or $tenaga_lk_cabang == '' or $tenaga_pr_cabang == '' or $upah_bulanan_max == '' or $upah_bulanan_min == '' or $upah_harian_max == '' or $upah_harian_min == '' or $hub_tentu == '' or $hub_tak_tentu == '' or $waktu_pkb == '' or $pkb_daftar == '' or $no_apindo == '' or $koperasi == '')
	{
	?>
		<script type="text/javascript">
			alert('Isi dengan lengkap !');
			document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=baru_janji&id=<?php echo $id_per; ?>';
		</script>
	<?php
	}

	$query=mysql_query("SELECT no_resi FROM tbl_berkas_janji ORDER BY no_resi DESC");
			if(mysql_num_rows($query)>0)
			{
				$result=mysql_fetch_row($query);
				$data=explode("-",$result[0]);
				$jenis_urus = $data[0];
				$data[1]+=1;
				if($data[1]>99)
					$no_resi="04-".$data[1];
				else if($data[1]>9)
					$no_resi="04-0".$data[1];
				else if($data[1]<=9)
					$no_resi="04-00".$data[1];
			}else
			{
				$no_resi="04-001";
				$jenis_urus="04";
			}
				
	$qinsert="INSERT INTO tbl_berkas_janji
	(no_resi,tgl_masuk_berkas,id_perusahaan, nama_pemohon,alamat_pemohon,no_hp,no_surat,tgl_surat,no_jamsostek,tenaga_lk,
	tenaga_pr,tenaga_lk_cabang,tenaga_pr_cabang,upah_bulanan_max,upah_bulanan_min,upah_harian_max,hub_tentu,
	hub_tak_tentu,waktu_pkb,upah_harian_min,pkb_daftar,no_apindo,koperasi) 
	VALUES 
	('$no_resi',curdate(),'$id_per','$nama_pemohon','$alamat_pemohon','$no_hp','$no_surat', '$tgl_surat','$no_jamsostek',
	 '$tenaga_lk','$tenaga_pr','$tenaga_lk_cabang','$tenaga_pr_cabang','$upah_bulanan_max',
	 '$upah_bulanan_min','$upah_harian_max','$hub_tentu','$hub_tak_tentu','$waktu_pkb',
	 '$upah_harian_min','$pkb_daftar','$no_apindo','$koperasi')";

	$az = "insert into tbl_info_berkas(no_resi,jenis_pengurusan,id_perusahaan,tgl_masuk,pemohon,alamat_pemohon,id_proses_skrg,id_proses_sblm,isValid,isDisposisi)
				values
			('$no_resi','$jenis_urus','$id_per',curdate(),'$nama_pemohon','$alamat_pemohon','11','10','1','3')";
			
	$c = mysql_query($qinsert);
	$d = mysql_query($az);
	
	if($d)
	{
		benar("./index.php?mod=loket&opt=proses_permohonan&opts=main_janji&no_resi=".$no_resi);
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
	
	if($nama_pemohon=='' or $alamat_pemohon == '' or $no_surat == '' or $id_per == '' or $tgl_surat == '' or $no_jamsostek == '' or $tenaga_lk == '' or $tenaga_pr == '' or $tenaga_lk_cabang == '' or $tenaga_pr_cabang == '' or $upah_bulanan_max == '' or $upah_bulanan_min == '' or $upah_harian_max == '' or $upah_harian_min == '' or $hub_tentu == '' or $hub_tak_tentu == '' or $waktu_pkb == '' or $pkb_daftar == '' or $no_apindo == '' or $koperasi == '')
	{
	?>
		<script type="text/javascript">
			alert('Isi dengan lengkap !');
			document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=edit_janji&no_resi=<?php echo $no_resi; ?>';
		</script>
	<?php
	}	
	$qryupdate="update tbl_berkas_janji set nama_pemohon='$nama_pemohon',alamat_pemohon='$alamat_pemohon',no_surat='$no_surat',tgl_surat='$tgl_surat',no_jamsostek='$no_jamsostek',
				tenaga_lk='$tenaga_lk',tenaga_pr='$tenaga_pr',tenaga_lk_cabang='$tenaga_lk_cabang',tenaga_pr_cabang='$tenaga_pr_cabang',
				upah_bulanan_max='$upah_bulanan_max',upah_bulanan_min='$upah_bulanan_min',
				upah_harian_max='$upah_harian_max',upah_harian_min='$upah_harian_min',
				hub_tentu='$hub_tentu',hub_tak_tentu='$hub_tak_tentu',
				waktu_pkb='$waktu_pkb',pkb_daftar='$pkb_daftar',no_apindo='$no_apindo',koperasi='$koperasi' where no_resi='$no_resi'";
	$qupdate = "update tbl_info_berkas set pemohon='$nama_pemohon',alamat_pemohon='$alamat_pemohon',id_proses_skrg='11',id_proses_sblm='12',isDisposisi='3' where no_resi='$no_resi'";
	
	$e = mysql_query($qupdate);
	$d = mysql_query($qryupdate);
	
	
	if($d)
	{
		benar("./index.php?mod=loket&opt=proses_permohonan&opts=main_janji&no_resi=".$no_resi);
		exit();
	}
	else
	{
		salah("./index.php?mod=loket&opt=proses_permohonan&opts=edit_janji&no_resi=".$no_resi);
		exit();
	}
}
else
	failed();
?>