<?php
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"];
$kewarganegaraan = $_POST["kwn"];
$pendidikan = $_POST["pendidikan"];
$gol = $_POST["gol"];
$hub = $_POST["hub"];
$jumlah = $_POST["jumlah"];
$mode=$_GET["act"];

if($mode==1)
{
	$a = "insert into tbl_tenaga_kerja_akhir(id_perusahaan,kewarganegaraan,id_pendidikan,golongan,hubungan,jumlah) values('".$id_per."','".$kewarganegaraan."','".$pendidikan."','".$gol."','".$hub."','".$jumlah."')";
}
else
{
	$id=$_GET["id"];
	$a="delete from tbl_tenaga_kerja_akhir where id='$id'";
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


