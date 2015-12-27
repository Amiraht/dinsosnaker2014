<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
$dari = $_GET["id_user"];
$tujuan = $_POST["tujuan"];
$pesan = $_POST["pesan"];
$sblm = $_POST["sblm"];
$catatan = $_POST["catatan"];

$data=explode("-",$resi);
$jenis_urus = $data[0];

$nmpri=mysql_query("select level from user where id_user='$dari'");
$rnmpri = mysql_fetch_array($nmpri);
$dari_level=$rnmpri["level"];

$nmpri=mysql_query("select level from user where id_user='$tujuan'");
$rnmpri = mysql_fetch_array($nmpri);
$tujuan_level=$rnmpri["level"];

$nmpri=mysql_query("select hasil_mediasi,statusp1,statusp2,statusp3 from tbl_berkas_pengaduan where no_resi='$resi'");
$rnmpri = mysql_fetch_array($nmpri);
$hasil=$rnmpri["hasil_mediasi"];
$sp1=$rnmpri["statusp1"];
$sp2=$rnmpri["statusp2"];
$sp3=$rnmpri["statusp3"];

$nmpri=mysql_query("select hasil_mediasi from tbl_hasil_mediasi where id_hasil='$hasil'");
$rnmpri = mysql_fetch_array($nmpri);
$hasil_mediasi=$rnmpri["hasil_mediasi"];

if($sp1=='0')
{
	$panggilan="Panggilan I";
	$qpanggilan="UPDATE tbl_berkas_pengaduan set statusp1='1' WHERE no_resi='$resi'";
}
else
{
	if($sp2=='0')
	{
		$panggilan="Panggilan II";
		$qpanggilan="UPDATE tbl_berkas_pengaduan set statusp2='1' WHERE no_resi='$resi'";
	}
	else
	{
		$panggilan="Panggilan III";
		$qpanggilan="UPDATE tbl_berkas_pengaduan set statusp3='1' WHERE no_resi='$resi'";
	}
	
}


$a = "insert into tbl_info_disposisi(no_resi,tgl,dari,dari_level,tujuan,tujuan_level,pesan) values('".$resi."',curdate(),'".$dari."','".$dari_level."','".$tujuan."','".$tujuan_level."','".$pesan."')";
$do = mysql_query($a);
if($do)
	{ 
		if($sblm=='22')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '54', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}
		elseif($sblm=='23')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '13', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}
		elseif($sblm=='24')
		{
			if($jenis_urus=='04' or $jenis_urus=='05')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '412', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
			elseif($jenis_urus=='06')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '224', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}			
			else			
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '56', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
		}
		elseif($sblm=='25' or $sblm=='27')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '13', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}
		elseif($sblm=='26')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '123', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}		
		else
		{
			if($tujuan_level=='3')
			{
				if($catatan==''){
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '14', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
				else{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '14', id_proses_sblm =  '".$sblm."', isDisposisi =  '0',sumber='".$dari."',catatan='".$catatan."' WHERE no_resi = '".$resi."'";}
			}
			elseif($tujuan_level=='16')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '77', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
		}
		//echo $qca;
		$ca = mysql_query($qca);
		if ($ca)
		{
			if($sblm=='22')
			{
				$upd=mysql_query($qpanggilan) or die("gagal update sp");
				$qp="DELETE FROM tbl_surat where no_resi='$resi' and perihal='$panggilan'";
				$upd=mysql_query($qp) or die("gagal input hapus");
				$qp="INSERT INTO tbl_surat(no_resi,perihal)VALUES('$resi','$panggilan')";
				$upd=mysql_query($qp) or die("gagal input surat arsip");
				?>
				<script type="text/javascript">
                    alert("Berhasil");
                    document.location = "../../../index.php?mod=kasubag_umum&opt=penomoran_surat";
                </script>
                <?php
			}
			elseif($sblm=='23')
			{
				$qp="DELETE FROM tbl_surat where no_resi='$resi' and perihal='$hasil_mediasi'";
				$upd=mysql_query($qp) or die("gagal hapus");
				$qp="INSERT INTO tbl_surat(no_resi,perihal)VALUES('$resi','$hasil_mediasi')";
				$upd=mysql_query($qp) or die("gagal input surat arsip");
				?>
				<script type="text/javascript">
                    alert("Berhasil");
                    document.location = "../../../index.php?mod=kasubag_umum&opt=penomoran_sk";
                </script>
                <?php
			}
			elseif($sblm=='27')
			{
				?>
				<script type="text/javascript">
                    alert("Berhasil");
                    document.location = "../../../index.php?mod=kasubag_umum&opt=penomoran_sk";
                </script>
                <?php
			}			
			elseif($sblm=='24')
			{
				$qp="DELETE FROM tbl_surat where no_resi='$resi' and perihal='SURAT PERINTAH TUGAS'";
				$upd=mysql_query($qp) or die("gagal hapus");
				$qp="INSERT INTO tbl_surat(no_resi,perihal)VALUES('$resi','SURAT PERINTAH TUGAS')";
				$upd=mysql_query($qp) or die("gagal input surat arsip");
				?>
				<script type="text/javascript">
                    alert("Berhasil");
                    document.location = "../../../index.php?mod=kasubag_umum&opt=penomoran_surat";
                </script>
                <?php
			}
			elseif($sblm=='26')
			{
				?>
				<script type="text/javascript">
                    alert("Berhasil");
                    document.location = "../../../index.php?mod=kasubag_umum&opt=penomoran_surat";
                </script>
                <?php
			}			
			elseif($sblm=='25')
			{
				$qp="DELETE FROM tbl_surat where no_resi='$resi' and perihal='SK IMTA'";
				$upd=mysql_query($qp) or die("gagal hapus");
				$qp="INSERT INTO tbl_surat(no_resi,perihal)VALUES('$resi','SK IMTA')";
				$upd=mysql_query($qp) or die("gagal input surat arsip");
				?>
				<script type="text/javascript">
                    alert("Berhasil");
                    document.location = "../../../index.php?mod=kasubag_umum&opt=penomoran_sk";
                </script>
                <?php
			}
			else
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					document.location = "../../../index.php?mod=kasubag_umum&opt=cek_berkas";
				</script>
				<?php
			}
		}
		else {echo "Gagal Update berkas";}
	} else {echo "Gagal masukkan berkas"; }
?>

<?php

