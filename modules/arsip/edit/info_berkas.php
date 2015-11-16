<?php
include "../../../libraries/dinsos.php";
$do = $_GET["aa"];
$do2 = $_POST["kd_lemari"];
$do3 = $_POST["kd_rak"];
$do4 = $_POST["kd_folder"];
$do5 = $_POST["keterangan"];

$kueri = "update tbl_arsip_berkas set id_lemari='$do2',id_rak='$do3',kode_folder='$do4',keterangan='$do5' WHERE no_resi='$do'";
$lak = mysql_query($kueri);
if($lak)
{
?>
		<script type='text/javascript'>
				alert('INFORMASI BERKAS BERHASIL DIUPDATE');
				document.location.href='../../../modules/arsip/edit/tambah.php?link=<?php echo $do; ?>';
		</script>";
<?php
}
?>
