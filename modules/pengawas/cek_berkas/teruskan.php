<?php
include "./libraries/dinsos.php";
$resi = $_GET["link"];

	$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '132' WHERE no_resi = '".$resi."'";


	//echo $qca;
	$ca = mysql_query($qca);
	if ($ca)
	{

		?>
		<script type="text/javascript">
			alert("Berhasil");
			parent.document.location = "./index.php?mod=pengawas&opt=cek_berkas";
		</script>
		<?php	
	}
	else {echo "Gagal masukkan berkas";}
?>



