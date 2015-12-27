<?php
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"];
$kewarganegaraan = $_POST["kwn"];
$j_kel = $_POST["j_kel"];
$umur = $_POST["umur"];
$hub = $_POST["hub"];
$jumlah = $_POST["jumlah"];
$mode=$_GET["act"];

if($mode==1)
{
	$a = "insert into tbl_tenaga_kerja(id_perusahaan,kewarganegaraan,jenis_kelamin,kelompok_umur,hubungan_kerja,jumlah) values('".$id_per."','".$kewarganegaraan."','".$j_kel."','".$umur."','".$hub."','".$jumlah."')";
}
else
{
	$id=$_GET["id"];
	$a="delete from tbl_tenaga_kerja where id='$id'";
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


