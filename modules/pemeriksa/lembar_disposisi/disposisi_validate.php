<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
$dari = $_GET["id_user"];
$tujuan = $_POST["tujuan"];
$pesan = $_POST["pesan"];
$sblm = $_POST["sblm"];
$sta = $_GET["status"];

$nmpri=mysql_query("select level from user where id_user='$dari'");
$rnmpri = mysql_fetch_array($nmpri);
$dari_level=$rnmpri["level"];

$nmpri=mysql_query("select level from user where id_user='$tujuan'");
$rnmpri = mysql_fetch_array($nmpri);
$tujuan_level=$rnmpri["level"];

$nmpri=mysql_query("select status_ver from tbl_berkas_imta where no_resi='$resi'");
$rnmpri = mysql_fetch_array($nmpri);
$status_ver=$rnmpri["status_ver"];

$a = "insert into tbl_info_disposisi(no_resi,tgl,dari,dari_level,tujuan,tujuan_level,pesan) values('".$resi."',curdate(),'".$dari."','".$dari_level."','".$tujuan."','".$tujuan_level."','".$pesan."')";
$do = mysql_query($a);
if($do)
	{ 
		
		if($sta=='terima')
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '101', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}
		else
		{
			$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '58', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' WHERE no_resi = '".$resi."'";
		}

		//echo $qca;
		$ca = mysql_query($qca);
		if ($ca)
		{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "../../../index.php?mod=pemeriksa&opt=hasil_lap";
			</script>
			<?php	
		}
		else {echo $qca;}
	} 
	
	else {
	echo $a;
	echo "Gagal masukkan berkas"; }
?>

<?php

