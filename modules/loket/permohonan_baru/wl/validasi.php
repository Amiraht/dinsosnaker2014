<?php

	$id_per = anti_injection($_POST["id_per"]);
	$tgl_pindah=anti_injection($_POST["tgl_pindah"]);
	$alamatlama = anti_injection($_POST["alamatlama"]);
	$alamatpemohon = anti_injection($_POST["alamatpemohon"]);
	$pemohon = anti_injection($_POST["pemohon"]);
	$wnipria = anti_injection($_POST["wnipria"]);
	$wniwanita = anti_injection($_POST["wniwanita"]);
	$wnapria = anti_injection($_POST["wnapria"]);
	$wnawanita = anti_injection($_POST["wnawanita"]);
	$jam1 = $_POST["jam1"];
	$jam2 = $_POST["jam2"];
	$jam3 = $_POST["jam3"];
	$jam4 = $_POST["jam4"];
	$jam5 = $_POST["jam5"];
	$jam6 = $_POST["jam6"];
	$jam7 = $_POST["jam7"];
	$jam8 = $_POST["jam8"];
	$alat1 = $_POST["alat1"];
	$alat2 = $_POST["alat2"];
	$alat3 = $_POST["alat3"];
	$alat4 = $_POST["alat4"];
	$alat5 = $_POST["alat5"];
	$alat6 = $_POST["alat6"];
	$alat7 = $_POST["alat7"];
	$alat8 = $_POST["alat8"];
	$alat9 = $_POST["alat9"];
	$alat10 = $_POST["alat10"];
	$alat11 = $_POST["alat11"];
	$alat12 = $_POST["alat12"];
	$alat13 = $_POST["alat13"];
	$alat14 = $_POST["alat14"];
	$alat15 = $_POST["alat15"];
	$alat16 = $_POST["alat16"];
	$alat17 = $_POST["alat17"];
	$limbah1 = $_POST["limbah1"];
	$limbah2 = $_POST["limbah2"];
	$limbah3 = $_POST["limbah3"];
	$olah_limbah = $_POST["olah_limbah"];
	$amdal = $_POST["amdal"];
	$sertifikat = $_POST["sertifikat"];
	$tgl_sertifikat = $_POST["tgl_sertifikat"];
	$upah = $_POST["upah"];
	$upahtinggi = $_POST["upahtinggi"];
	$upahrendah = $_POST["upahrendah"];
	$upahumr = $_POST["upahumr"];
	$thr = $_POST["thr"];
	$bonus = $_POST["bonus"];
	$sehat1 = $_POST["sehat1"];
	$sehat2 = $_POST["sehat2"];
	$sehat3 = $_POST["sehat3"];
	$sehat4 = $_POST["sehat4"];
	$sehat5 = $_POST["sehat5"];
	$sehat6 = $_POST["sehat6"];
	$sejahtera1 = $_POST["sejahtera1"];
	$sejahtera2 = $_POST["sejahtera2"];
	$sejahtera3 = $_POST["sejahtera3"];
	$sejahtera4 = $_POST["sejahtera4"];
	$sejahtera5 = $_POST["sejahtera5"];
	$sejahtera6 = $_POST["sejahtera6"];
	$sejahtera7 = $_POST["sejahtera7"];
	$tgl_jamsostek = $_POST["tgl_jamsostek"];
	$no_pendaftaran = $_POST["no_pendaftaran"];
	$peserta_tk = $_POST["peserta_tk"];
	$peserta_keluarga = $_POST["peserta_keluarga"];
	$jaminan1 = $_POST["jaminan1"];
	$jaminan2 = $_POST["jaminan2"];
	$jaminan3 = $_POST["jaminan3"];
	$jaminan4 = $_POST["jaminan4"];
	$jamin1 = $_POST["jamin1"];
	$jamin2 = $_POST["jamin2"];
	$jamin3 = $_POST["jamin3"];
	$jamin4 = $_POST["jamin4"];
	$pensiun1 = $_POST["pensiun1"];
	$pensiun2 = $_POST["pensiun2"];
	$hub1 = $_POST["hub1"];
	$hub2 = $_POST["hub2"];
	$hub3 = $_POST["hub3"];
	$org1 = $_POST["org1"];
	$org2 = $_POST["org2"];
	$org3 = $_POST["org3"];
	$org4 = $_POST["org4"];
	$jlh_tk_nanti = $_POST["jlh_tk_nanti"];
	$jlh_tk_nanti_p = $_POST["jlh_tk_nanti_p"];
	$jlh_tk_nanti_w = $_POST["jlh_tk_nanti_w"];
	$jlh_tk_skrg = $_POST["jlh_tk_skrg"];
	$jlh_tk_skrg_p = $_POST["jlh_tk_skrg_p"];
	$jlh_tk_skrg_w = $_POST["jlh_tk_skrg_w"];
	$jlh_terima = $_POST["jlh_terima"];
	$jlh_berhenti = $_POST["jlh_berhenti"];
	$pelatihan = $_POST["pelatihan"];
	$pemagangan = $_POST["pemagangan"];
	$fasilitas = $_POST["fasilitas"];
	$pengindonesiaan = $_POST["pengindonesiaan"];


if((int)$_GET["mode"] == 1)
{
	if($id_per == '' )
	{
	?>
		<script type="text/javascript">
			alert('Isi dengan lengkap !');
			document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=baru_wl&id=<?php echo $id_per; ?>';
		</script>
	<?php
	}

	$query=mysql_query("SELECT no_resi FROM tbl_berkas_wl ORDER BY no_resi DESC");
			if(mysql_num_rows($query)>0)
			{
				$result=mysql_fetch_row($query);
				$data=explode("-",$result[0]);
				$jenis_urus = $data[0];
				$data[1]+=1;
				if($data[1]>99)
					$no_resi="01-".$data[1];
				else if($data[1]>9)
					$no_resi="01-0".$data[1];
				else if($data[1]<=9)
					$no_resi="01-00".$data[1];
			}else
			{
				$no_resi="01-001";
				$jenis_urus="01";
			}

	$qinsert="INSERT INTO tbl_berkas_wl
	(no_resi,tgl_masuk_berkas,id_perusahaan,tgl_pindah,alamatlama,wnipria,wniwanita,wnapria,wnawanita,pemohon,alamatpemohon,
	jam1,jam2,jam3,jam4,jam5,jam6,jam7,jam8,alat1,alat2,alat3,alat4,alat5,alat6,alat7,alat8,alat9,alat10,
	alat11,alat12,alat13,alat14,alat15,alat16,alat17,limbah1,limbah2,limbah3,olah_limbah,amdal,sertifikat,
	tgl_sertifikat,jlh_upah,upah_tinggi,upah_rendah,jlh_umr,thr,bonus,
	sehat1,sehat2,sehat3,sehat4,sehat5,sehat6,sejahtera1,sejahtera2,sejahtera3,sejahtera4,sejahtera5,sejahtera6,
	sejahtera7,tgl_jamsostek,no_pendaftaran,peserta_tk,peserta_keluarga,jaminan1,jaminan2,jaminan3,jaminan4,
	jamin1,jamin2,jamin3,jamin4,pensiun1,pensiun2,hub1,hub2,hub3,org1,org2,org3,org4,
	jlh_tk_nanti,jlh_tk_nanti_p,jlh_tk_nanti_w,jlh_tk_skrg,jlh_tk_skrg_p,jlh_tk_skrg_w,
	jlh_terima,jlh_berhenti,pelatihan,pemagangan,fasilitas,pengindonesiaan) 	
	VALUES ('$no_resi',curdate(),'$id_per','$tgl_pindah','$alamatlama','$wnipria','$wniwanita','$wnapria','$wnawanita','$pemohon','$alamatpemohon',
	'$jam1','$jam2','$jam3','$jam4','$jam5','$jam6','$jam7','$jam8','$alat1','$alat2','$alat3','$alat4','$alat5','$alat6','$alat7','$alat8','$alat9','$alat10'
	,'$alat11','$alat12','$alat13','$alat14','$alat15','$alat16','$alat17','$limbah1','$limbah2','$limbah3','$olah_limbah','$amdal','$sertifikat'
	,'$tgl_sertifikat','$upah','$upahtinggi','$upahrendah','$upahumr','$thr','$bonus'
	,'$sehat1','$sehat2','$sehat3','$sehat4','$sehat5','$sehat6','$sejahtera1','$sejahtera2','$sejahtera3','$sejahtera4','$sejahtera5','$sejahtera6'
	,'$sejahtera7','$tgl_jamsostek','$no_pendaftaran','$peserta_tk','$peserta_keluarga','$jaminan1','$jaminan2','$jaminan3','$jaminan4'
	,'$jamin1','$jamin2','$jamin3','$jamin4','$pensiun1','$pensiun2','$hub1','$hub2','$hub3','$org1','$org2','$org3','$org4'
	,'$jlh_tk_nanti','$jlh_tk_nanti_p','$jlh_tk_nanti_w','$jlh_tk_skrg','$jlh_tk_skrg_p','$jlh_tk_skrg_w'
	,'$jlh_terima','$jlh_berhenti','$pelatihan','$pemagangan','$fasilitas','$pengindonesiaan')";

	$az = "insert into tbl_info_berkas(no_resi,jenis_pengurusan,id_perusahaan,tgl_masuk,pemohon,alamat_pemohon,id_proses_skrg,id_proses_sblm,isValid,isDisposisi)
				values
			('$no_resi','$jenis_urus','$id_per',curdate(),'$pemohon','$alamatpemohon','11','10','1','3')";
			
	
	$qtenaga="UPDATE tbl_tenagakerja_dinsos set wnilk='$jlh_tk_skrg_p',wnipr='$jlh_tk_skrg_w' WHERE id_perusahaan='$id_per'";
	$utenaga=mysql_query($qtenaga);
	$c = mysql_query($qinsert);
	$d = mysql_query($az);
	
	if($d)
	{
		benar("./index.php?mod=loket&opt=proses_permohonan&opts=main_wl&no_resi=".$no_resi);
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
	
	if($id_per == '' )
	{
	?>
		<script type="text/javascript">
			alert('Isi dengan lengkap !');
			document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=edit_wl&no_resi=<?php echo $no_resi; ?>';
		</script>
	<?php
	}	
	$qryupdate="update tbl_berkas_wl set tgl_pindah='$tgl_pindah',alamatlama='$alamatlama'
				,wnipria='$wnipria',wniwanita='$wniwanita',wnapria='$wnapria',wnawanita='$wnawanita',pemohon='$pemohon',alamatpemohon='$alamatpemohon'
				,jam1='$jam1',jam2='$jam2',jam3='$jam3',jam4='$jam4',jam5='$jam5',jam6='$jam6',jam7='$jam7',jam8='$jam8'
				,alat1='$alat1',alat2='$alat2',alat3='$alat3',alat4='$alat4',alat5='$alat5',alat6='$alat6',alat7='$alat7',alat8='$alat8',alat9='$alat9',alat10='$alat10'
				,alat11='$alat11',alat12='$alat12',alat13='$alat13',alat14='$alat14',alat15='$alat15',alat16='$alat16',alat17='$alat17'
				,limbah1='$limbah1',limbah2='$limbah2',limbah3='$limbah3',olah_limbah='$olah_limbah',amdal='$amdal',sertifikat='$sertifikat'
				,tgl_sertifikat='$tgl_sertifikat',jlh_upah='$upah',upah_tinggi='$upahtinggi',upah_rendah='$upahrendah',jlh_umr='$upahumr',thr='$thr',bonus='$bonus'
				,sehat1='$sehat1',sehat2='$sehat2',sehat3='$sehat3',sehat4='$sehat4',sehat5='$sehat5',sehat6='$sehat6'
				,sejahtera1='$sejahtera1',sejahtera2='$sejahtera2',sejahtera3='$sejahtera3',sejahtera4='$sejahtera4',sejahtera5='$sejahtera5'
				,sejahtera6='$sejahtera6',sejahtera7='$sejahtera7'
				,tgl_jamsostek='$tgl_jamsostek',no_pendaftaran='$no_pendaftaran',peserta_tk='$peserta_tk',peserta_keluarga='$peserta_keluarga'
				,jaminan1='$jaminan1',jaminan2='$jaminan2',jaminan3='$jaminan3',jaminan4='$jaminan4'
				,jamin1='$jamin1',jamin2='$jamin2',jamin3='$jamin3',jamin4='$jamin4'
				,pensiun1='$pensiun1',pensiun2='$pensiun2',hub1='$hub1',hub2='$hub2',hub3='$hub3'
				,org1='$org1',org2='$org2',org3='$org3',org4='$org4'
				,jlh_tk_nanti='$jlh_tk_nanti',jlh_tk_nanti_p='$jlh_tk_nanti_p',jlh_tk_nanti_w='$jlh_tk_nanti_w'
				,jlh_tk_skrg='$jlh_tk_skrg',jlh_tk_skrg_p='$jlh_tk_skrg_p',jlh_tk_skrg_w='$jlh_tk_skrg_w'
				,jlh_terima='$jlh_terima',jlh_berhenti='$jlh_berhenti',pelatihan='$pelatihan',pemagangan='$pemagangan',fasilitas='$fasilitas',pengindonesiaan='$pengindonesiaan'
				where no_resi='$no_resi'";
	$qupdate = "update tbl_info_berkas set pemohon='$pemohon',alamat_pemohon='$alamatpemohon',id_proses_skrg='11',id_proses_sblm='12',isDisposisi='3' where no_resi='$no_resi'";
	
	
	$qtenaga="UPDATE tbl_tenagakerja_dinsos set wnilk='$jlh_tk_skrg_p',wnipr='$jlh_tk_skrg_w' WHERE id_perusahaan='$id_per'";
	$utenaga=mysql_query($qtenaga);
		
	$e = mysql_query($qupdate);
	$d = mysql_query($qryupdate);
	
	
	if($d)
	{
		benar("./index.php?mod=loket&opt=proses_permohonan&opts=main_wl&no_resi=".$no_resi);
		exit();
	}
	else
	{
		salah("./index.php?mod=loket&opt=proses_permohonan&opts=edit_wl&no_resi=".$no_resi);
		exit();
	}
}
else
	failed();
?>