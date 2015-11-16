<?php
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"];
$nama = $_POST["nama"];

$mode=$_GET["act"];

if($mode==1)
{
	$a = "insert into tbl_iplk_program(id_perusahaan,nama) values('".$id_per."','".$nama."')";
}
else
{
	$id=$_GET["id"];
	$a="delete from tbl_iplk_program where id='$id'";
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


