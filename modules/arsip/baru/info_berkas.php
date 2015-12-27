<?php
include "../../../libraries/dinsos.php";
$do = $_GET["aa"];
$do2 = $_POST["kd_lemari"];
$do3 = $_POST["kd_rak"];
$do4 = $_POST["kd_folder"];
$do5 = $_POST["keterangan"];

$kueri = "insert into tbl_arsip_berkas(no_resi, id_lemari, id_rak, kode_folder, keterangan) values ('$do','$do2','$do3','$do4','$do5')";
$lak = mysql_query($kueri);
if($lak)
{
	$kueri1 = "update tbl_info_berkas set isDisposisi='1' where no_resi='$do'";
	$lak1 = mysql_query($kueri1);
	if($lak1)
	{
	?>
			<script type='text/javascript'>
					alert('INFORMASI BERKAS BERHASIL DITAMBAHKAN');
					document.location.href='../../../modules/arsip/baru/tambah.php?link=<?php echo $do; ?>';
			</script>";
	<?php
	}
}
?>
