<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
$data = explode("-",$resi);
$jenis_urus = $data[0];

$dari = $_GET["id_user"];
$tujuan = $_POST["tujuan"];
$pesan = $_POST["pesan"];
$sblm = $_POST["sblm"];

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
		if($sblm=='77')
		{
			if($jenis_urus=='04' or $jenis_urus=='05')
			{
				if($tujuan_level=='15')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '21', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";			
				}
				else
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '410', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";					
				}
			}
			elseif($jenis_urus=='06')
			{
				if($tujuan_level=='15')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '21', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";			
				}
				else
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '38', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";					
				}
			}			
			else
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '31', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
		}
		elseif($sblm=='72')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '33', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			
		}
		elseif($sblm=='75')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '36', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			
		}
		elseif($sblm=='76')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '34', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			
		}					
		elseif($sblm=='73')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '35', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			
		}
		elseif($sblm=='74')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '37', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			
		}		
		elseif($sblm=='78')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '34', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			
		}		
		else
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '32', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}



		//echo $qca;
		$ca = mysql_query($qca);
		if ($ca)
		{
			if($sblm=='72' or $sblm=='75' or $sblm=='76' or $sblm=='78')
			{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "../../../index.php?mod=sekretaris&opt=paraf_surat";
			</script>
			<?php
			}
			elseif($sblm=='77')
			{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "../../../index.php?mod=sekretaris&opt=terima_berkas";
			</script>
			<?php
			}			
			else
			{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "../../../index.php?mod=sekretaris&opt=paraf_mediasi";
			</script>
			<?php
			}
		}
		else {echo $qca;}
	} 
	
	else {
	echo $a;
	echo "Gagal masukkan berkas"; }
?>

<?php

