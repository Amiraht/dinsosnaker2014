<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
$dari = $_GET["id_user"];
$hasil = $_POST["hasil"];
$keterangan = $_POST["keterangan"];


$a = "UPDATE tbl_berkas_pengaduan SET hasil_mediasi='$hasil', ket_mediasi='$keterangan',tgl_mediasi=curdate() WHERE no_resi='$resi'";
$do = mysql_query($a);
if($do)
	{ 
		$qca="UPDATE tbl_info_berkas SET  id_proses_skrg =  '61', id_proses_sblm =  '61', isDisposisi =  '1' WHERE no_resi = '".$resi."'";

		//echo $qca;
		$ca = mysql_query($qca);
		if ($ca)
		{
			?>
			<script type="text/javascript">
				alert("Berhasil");
				parent.document.location = "../../../index.php?mod=staf&opt=lembar_kendali";
			</script>
			<?php
		}
		else {echo "Gagal Update berkas";}
	} else {echo "Gagal masukkan berkas"; }
?>

<?php

