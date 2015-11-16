<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
$dari = $_GET["id_user"];
$tujuan = $_POST["tujuan"];
$pesan = $_POST["pesan"];
$sblm = $_POST["sblm"];
$catatan = $_POST["catatan"];

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
		if($tujuan_level=='12')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '121', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
		else if($tujuan_level=='3')
			{
				if($catatan==''){
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '14', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
				else{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '14', id_proses_sblm =  '".$sblm."', isDisposisi =  '0',sumber='".$dari."',catatan='".$catatan."' WHERE no_resi = '".$resi."'";}
			}
		else if($tujuan_level=='16')
			{
				if($sblm=='223')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '78', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
				elseif($sblm=='225')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '74', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
			}
		else if($tujuan_level=='17')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '34', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
		else if($tujuan_level=='23')
			{
				if($sblm=='224')
				{			
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '233', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
				else				
				{			
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '231', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
			}			
		//echo $qca;
		$ca = mysql_query($qca);
		if ($ca)
		{
			if($sblm=='223')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidlatih&opt=paraf_sk";
				</script>
				<?php
			}
			if($sblm=='224')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidlatih&opt=penugasan";
				</script>
				<?php
			}			
			if($sblm=='225')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidlatih&opt=paraf_surat";
				</script>
				<?php
			}
			if($sblm=='222')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidlatih&opt=berkas_tolak";
				</script>
				<?php
			}			
			else
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidlatih&opt=verifikasi_berkas";
				</script>
				<?php
			}
		}
		else {echo "Gagal Update berkas";}
	} else {echo "Gagal masukkan berkas"; }
?>

<?php

