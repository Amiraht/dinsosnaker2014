<?php
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"];
$kejuruan = $_POST["kejuruan"];
$kode = $_POST["kode"];
$jumlah = $_POST["jumlah"];
$mode=$_GET["act"];

if($mode==1)
{
	$a = "insert into tbl_latihan(id_perusahaan,kejuruan,kode,jumlah) values('".$id_per."','".$kejuruan."','".$kode."','".$jumlah."')";
}
else
{
	$id=$_GET["id"];
	$a="delete from tbl_latihan where id='$id'";
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


