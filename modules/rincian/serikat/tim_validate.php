<?php
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"];
$nama = $_POST["nama"];
$nomor = $_POST["nomor"];
$alamat = $_POST["alamat"];
$jumlah = $_POST["jumlah"];
$mode=$_GET["act"];

if($mode==1)
{
	$a = "insert into tbl_serikat(id_perusahaan,nama,nomor,alamat,jumlah) values('".$id_per."','".$nama."','".$nomor."','".$alamat."','".$jumlah."')";
}
else
{
	$id=$_GET["id"];
	$a="delete from tbl_serikat where id='$id'";
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


