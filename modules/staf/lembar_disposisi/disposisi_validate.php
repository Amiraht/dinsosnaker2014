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
		if($sblm=='61')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg ='53', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}
		else if ($sblm=='63')
		{
			if($tujuan_level=='3')
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg ='15', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
			else
			{
				$qca="UPDATE tbl_info_berkas SET  id_proses_skrg ='52', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
			}
		}
		
		//echo $qca;
		$ca = mysql_query($qca);
		if ($ca)
		{
			if($sblm=='61')
			{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "../../../index.php?mod=staf&opt=cek_berkas";
			</script>
			<?php
			}
			else
			{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "../../../index.php?mod=staf&opt=cek_mediasi";
			</script>
			<?php
			}
		}
		else {echo "Gagal Update berkas";}
	} else {echo "Gagal masukkan berkas"; }
?>

<?php

