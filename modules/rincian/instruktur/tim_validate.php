<?php
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"];
$nama = $_POST["nama"];
$umur = $_POST["umur"];
$pendidikan = $_POST["pendidikan"];
$latihan = $_POST["latihan"];
$pengalaman = $_POST["pengalaman"];
$ket = $_POST["ket"];
$mode=$_GET["act"];

if($mode==1)
{
	$a = "insert into tbl_iplk_instruktur(id_perusahaan,nama,umur,pendidikan,latihan,pengalaman,ket) values('".$id_per."','".$nama."','".$umur."','".$pendidikan."','".$latihan."','".$pengalaman."','".$ket."')";
}
else
{
	$id=$_GET["id"];
	$a="delete from tbl_iplk_instruktur where id='$id'";
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


