<?php
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"];
$nama = $_POST["nama"];
$teori = $_POST["teori"];
$praktek = $_POST["praktek"];
$total = $_POST["total"];
$maks_angkatan = $_POST["maks_angkatan"];
$angkatan = $_POST["angkatan"];
$siswa_tahun = $_POST["siswa_tahun"];
$biaya = $_POST["biaya"];
$mode=$_GET["act"];

if($mode==1)
{
	$a = "insert into tbl_iplk_durasi(id_perusahaan,nama,teori,praktek,total,maks_angkatan,angkatan,siswa_tahun,biaya) values('".$id_per."','".$nama."','".$teori."','".$praktek."','".$total."','".$maks_angkatan."','".$angkatan."','".$siswa_tahun."','".$biaya."')";
}
else
{
	$id=$_GET["id"];
	$a="delete from tbl_iplk_durasi where id='$id'";
}
$do = mysql_query($a);
if($do)
	{ 
		?>
		<script type="text/javascript">
			alert("Berhasil");
			document.location = "./index.php?id_per=<?php echo $id_per; ?>
		</script>
		<?php
	} 
	
	else {
	echo $a;
	echo "Gagal simpan"; }
?>


