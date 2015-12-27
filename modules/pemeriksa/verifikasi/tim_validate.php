<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
$dari = $_GET["id_user"];
$petugas = $_POST["status"];
$jabatan = $_POST["keterangan"];
$mode=$_GET["mode"];


$a = "update tbl_berkas_imta set status_ver='$petugas', ket_ver='$jabatan' WHERE no_resi='$resi'";

$do = mysql_query($a);
if($do)
	{ 
		?>
		<script type="text/javascript">
			var x = '<?php echo $resi; ?>';
			var uid = '<?php echo $dari; ?>';
			alert("Berhasil");
			parent.document.location = "../../../index.php?mod=pemeriksa&opt=verifikasi&link=<?php echo $resi; ?>&id_user=<?php echo $dari; ?>";
		</script>
		<?php
	} 
	
	else {
	echo $a;
	echo "Gagal simpan"; }
?>


