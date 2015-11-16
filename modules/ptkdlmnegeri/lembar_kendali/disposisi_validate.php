<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
$te = $_POST["tujuan"];
$te2 = $_POST["pesan"];
$te3 = $_POST["sblm"];
$a = "insert into tbl_info_disposisi(no_resi,tgl,tujuan,pesan) values('".$resi."',curdate(),'".$te."','".$te2."')";
$do = mysql_query($a);
if($do)
	{

		$ca = mysql_query("UPDATE tbl_info_berkas 
							SET isDisposisi =  '0' 
							WHERE no_resi = '".$resi."'");
		if ($ca)
			{
				?>
				<script type="text/javascript">
					parent.document.location = "../../../index.php?mod=binapentaker&opt=lembar_kendali";
				</script>
				<?php
			}
		else {echo "Gagal update berkas";}
	} else {echo "gagal masukkan berkas"; }
?>