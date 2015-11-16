<?php
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"];
$nama = $_POST["nama"];
$jlh_baik = $_POST["jlh_baik"];
$jlh_ringan = $_POST["jlh_ringan"];
$jlh_berat = $_POST["jlh_berat"];
$jlh = $_POST["jlh"];
$luas = $_POST["luas"];
$ket = $_POST["ket"];
$mode=$_GET["act"];

if($mode==1)
{
	$a = "insert into tbl_iplk_fasilitas(id_perusahaan,nama,jlh_baik,jlh_ringan,jlh_berat,jlh,luas,ket) values('".$id_per."','".$nama."','".$jlh_baik."','".$jlh_ringan."','".$jlh_berat."','".$jlh."','".$luas."','".$ket."')";
}
else
{
	$id=$_GET["id"];
	$a="delete from tbl_iplk_fasilitas where id='$id'";
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


