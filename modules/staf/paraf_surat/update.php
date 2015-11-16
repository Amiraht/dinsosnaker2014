<?php
include "./libraries/dinsos.php";
$resi = $_GET["link"];
$dari = $_GET["id_user"];
$mode = $_GET["opts"];
if($mode=='tolak')
{
	$a = "update tbl_info_berkas set id_proses_skrg='61' WHERE no_resi='$resi'";
}
elseif($mode=='terima')
{
	$a = "update tbl_info_berkas set id_proses_skrg='63' WHERE no_resi='$resi'";
}
$do = mysql_query($a);
if($do)
	{ 
		if($mode=='tolak')
		{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "./index.php?mod=staf&opt=cek_mediasi";
			</script>
			<?php
		}
		else
		{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "./index.php?mod=staf&opt=paraf_surat";
			</script>
			<?php
		}		
			
	} 
		else {echo "Gagal masukkan berkas"; }
?>


