<?php
include "../../libraries/dinsos.php";

$kode = $_POST["kode"];
$nama = $_POST["nama"];

$mode=$_GET["act"];

if($mode==1)
{
	$a = "insert into kbli(kode_bagian,nama_bagian) values('".$kode."','".$nama."')";
}
else
{
	$id=$_GET["id"];
	$a="delete from kbli where id='$id'";
}
$do = mysql_query($a);
if($do)
	{ 
		?>
		<script type="text/javascript">
			alert("Berhasil");
			document.location = "./index.php
		</script>
		<?php
	} 
	
	else {
	echo $a;
	echo "Gagal simpan"; }
?>


