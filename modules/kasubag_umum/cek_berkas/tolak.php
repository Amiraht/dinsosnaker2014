<?php
if(!isset($_GET["value"]))
{
	echo "akses di tolak";
}
else
{
	$no_resi = $_GET["value"];
	$ca = mysql_query("UPDATE tbl_info_berkas 
							SET id_proses_skrg = '21', id_proses_sblm = '21', isValid = '0', isDisposisi =  '1' 
							WHERE no_resi = '".$no_resi."'");	
	if ($ca)
	{
		?>
		<script type="text/javascript">
			alert("Berhasil");
			parent.document.location = "./index.php?mod=kasubag_umum&opt=lembar_kendali";
		</script>
		<?php
	}
}
?>