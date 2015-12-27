<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
$dari = $_GET["id_user"];
$tujuan = $_POST["tujuan"];
$pesan = $_POST["pesan"];
$sblm = $_POST["sblm"];

$data=explode("-",$resi);
$jenis_urus = $data[0];

$nmpri=mysql_query("select level from user where id_user='$dari'");
$rnmpri = mysql_fetch_array($nmpri);
$dari_level=$rnmpri["level"];

$nmpri=mysql_query("select level from user where id_user='$tujuan'");
$rnmpri = mysql_fetch_array($nmpri);
$tujuan_level=$rnmpri["level"];


$a = "insert into tbl_info_disposisi(no_resi,tgl,dari,dari_level,tujuan,tujuan_level,pesan) values('".$resi."',curdate(),'".$dari."','".$dari_level."','".$tujuan."','".$tujuan_level."','".$pesan."')";
$do = mysql_query($a);
if($do)
	{ 
		if($tujuan_level=='5')
			{
				if($sblm=='43')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '53', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
				else
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '51', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
			}
		else if($tujuan_level=='3')
			{
				if($sblm=='413' or $sblm=='410')
				{			
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '14', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}				
				else
				{			
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '12', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
			}
		else if($tujuan_level=='20')
			{
				if($jenis_urus=='04' or $jenis_urus=='05')
				{
					if($sblm=='410')
					{
						$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '151', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
								
					}		
					else
					{
						$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '153', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
					}
				}
			}			
		else if($tujuan_level=='16')
			{
				if($sblm=='43')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '72', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
				elseif($sblm=='410')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '77', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}		
				elseif($sblm=='411')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '78', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}											
				else
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '71', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
				
			}
		else if($tujuan_level=='6')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '62', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
		//echo $qca;
		$ca = mysql_query($qca);
		if ($ca)
		{
			if($sblm=='54' or $sblm=='43')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidhubsaker&opt=paraf_surat";
				</script>
				<?php
			}
			else if($sblm=='44')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidhubsaker&opt=paraf_mediasi";
				</script>
				<?php
			}
			else if($sblm=='411')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidhubsaker&opt=paraf_sk_tugas";
				</script>
				<?php
			}	
			else if($sblm=='412')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidhubsaker&opt=penugasan";
				</script>
				<?php
			}	
			else if($sblm=='413')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidhubsaker&opt=berkas_ditolak";
				</script>
				<?php
			}								
			else
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidhubsaker&opt=verifikasi_berkas";
				</script>
				<?php
			}

		}
		else {echo "Gagal Update berkas";}
	} else {echo "Gagal masukkan berkas"; }
?>

<?php

