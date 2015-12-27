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
				if($sblm=='112')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '74', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
				else
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '75', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
			}
		else if($tujuan_level=='17')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '34', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
		//echo $qca;
		$ca = mysql_query($qca);
		if ($ca)
		{
			if($sblm=='113')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidwasnaker&opt=paraf_sk";
				</script>
				<?php
			}
			if($sblm=='112')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidwasnaker&opt=paraf_surat";
				</script>
				<?php
			}
			if($sblm=='114')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidwasnaker&opt=berkas_tolak";
				</script>
				<?php
			}			
			else
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kabidwasnaker&opt=verifikasi_berkas";
				</script>
				<?php
			}
		}
		else {echo "Gagal Update berkas";}
	} else {echo "Gagal masukkan berkas"; }
?>

<?php

