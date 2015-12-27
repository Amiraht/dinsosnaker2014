<?php
if(!isset($_GET["value"]))
{
	echo "akses di tolak";
}
else
{
	$no_resi = $_GET["value"];
	$ca = mysql_query("UPDATE tbl_info_berkas 
							SET id_proses_skrg = '42', id_proses_sblm = '42', isDisposisi =  '1' 
							WHERE no_resi = '".$no_resi."'");	
	if ($ca)
	{
		?>
		<script type="text/javascript">
			parent.document.location = "./index.php?mod=kabidhubsaker&opt=lembar_kendali";
		</script>
		<?php
	}
}
?>