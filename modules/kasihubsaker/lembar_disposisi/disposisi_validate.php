<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
$dari = $_GET["id_user"];
$tujuan = $_POST["tujuan"];
$pesan = $_POST["pesan"];
$sblm = $_POST["sblm"];
$sta = $_GET["status"];
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
		if($sblm=='153')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '161', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}			
		elseif($sblm=='152')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '44', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}					
		else
		{
			if($sta=='tolak')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '413', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
			elseif($sta == 'periksa')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '411', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
			elseif($sta=='no_periksa')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '161', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}	
		}



		//echo $qca;
		$ca = mysql_query($qca);
		if ($ca)
		{
			if($sblm=='56')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kasihubsaker&opt=paraf_surat";
				</script>
				<?php	
			}
			elseif($sblm=='57' or $sblm=='124')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kasihubsaker&opt=paraf_sk";
				</script>
				<?php	
			}
			elseif($sblm=='153')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kasihubsaker&opt=penugasan";
				</script>
				<?php	
			}	
			elseif($sblm=='152')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kasihubsaker&opt=paraf_sk";
				</script>
				<?php	
			}					
			elseif($sblm=='154')
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kasihubsaker&opt=berkas_tolak";
				</script>
				<?php	
			}							
			else
			{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					parent.document.location = "../../../index.php?mod=kasihubsaker&opt=cek_berkas";
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

