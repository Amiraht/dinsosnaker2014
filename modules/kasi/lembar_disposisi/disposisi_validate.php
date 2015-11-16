<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
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
		
			if($tujuan_level=='4')
			{
				if($sblm=='51')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '42', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
					
				}
				else if($sblm=='52')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '44', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
				else if($sblm=='53')
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '43', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}									
				else
				{
					$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '43', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
				}
			}
			elseif($tujuan_level=='6')
			{

				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '61', id_proses_sblm =  '".$sblm."', isDisposisi =  '0',mediator='".$tujuan."' WHERE no_resi = '".$resi."'";
			}


		//echo $qca;
		$ca = mysql_query($qca);
		if ($ca)
		{
			if($sblm=='51')
			{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "../../../index.php?mod=kasi&opt=cek_berkas";
			</script>
			<?php
			}
			else if($sblm=='52')
			{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "../../../index.php?mod=kasi&opt=paraf_mediasi";
			</script>
			<?php
			}
			else
			{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "../../../index.php?mod=kasi&opt=paraf_surat";
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

