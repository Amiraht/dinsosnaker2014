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
		if($sblm=='33')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '22', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}
		elseif($sblm=='32')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '23', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}
		elseif($sblm=='34')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '24', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}
		elseif($sblm=='35')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '25', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}
		elseif($sblm=='36')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '26', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}
		elseif($sblm=='37')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '27', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}		
		elseif($sblm=='38')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '221', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}					
		else
		{

			if($tujuan_level=='3')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '13', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
			else
			{
				if($jenis_urus=='03')
				{
				    $qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '41', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
				else
				{
				    $qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '45', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";				
				}
			}
		}
		//echo $qca;
		$ca = mysql_query($qca);
		if ($ca)
		{
			if($sblm == '33' or $sblm == '34' or $sblm == '36')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kadis&opt=paraf_surat";
				</script>
				<?php
			}
			else if($sblm == '35')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kadis&opt=paraf_mediasi";
				</script>
				<?php
			}
			else if($sblm == '32' or $sblm == '37')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kadis&opt=paraf_mediasi";
				</script>
				<?php
			}
			else
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kadis&opt=terima_berkas";
				</script>
				<?php
			}
		}
		else {echo "Gagal Update berkas";}
	} else {echo "Gagal masukkan berkas"; }
?>

<?php

