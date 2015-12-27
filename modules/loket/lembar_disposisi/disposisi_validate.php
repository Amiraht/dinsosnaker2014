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
		if($tujuan_level=='18')
		{
			$ca = mysql_query("UPDATE tbl_info_berkas 
				SET  id_proses_skrg =  '81', id_proses_sblm =  '".$sblm."', isDisposisi =  '0',arsip_akhir='1' 
				WHERE no_resi = '".$resi."'");
		}
		if($tujuan_level=='11')
		{
			$ca = mysql_query("UPDATE tbl_info_berkas 
				SET  id_proses_skrg =  '111', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' 
				WHERE no_resi = '".$resi."'");
		}		
		else
		{
			$ca = mysql_query("UPDATE tbl_info_berkas 
					SET  id_proses_skrg =  '21', id_proses_sblm =  '".$sblm."', isDisposisi =  '0' 
					WHERE no_resi = '".$resi."'");
		}

		if ($ca)
			{
				if($tujuan_level == '18' or $tujuan_level == '11' or $tujuan_level == '15')
				{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					document.location.href = "../../../index.php?mod=loket&opt=proses_permohonan&opts=baru";
				</script>
				<?php
				}
				else
				{
				?>
				<script type="text/javascript">
					alert("Berhasil");
					document.location.href = "../../../index.php?mod=loket&opt=proses_permohonan&opts=perbaikan";
				</script>
				<?php
				}
			}
		else {echo "Gagal update berkas";}
	} else {echo "gagal masukkan berkas"; }
?>