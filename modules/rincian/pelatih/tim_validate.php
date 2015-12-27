<?php
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"];
$nama = $_POST["nama"];
$jlh_baik = $_POST["jlh_baik"];
$jlh_cukup = $_POST["jlh_cukup"];
$jlh_kurang = $_POST["jlh_kurang"];
$tetap = $_POST["tetap"];
$cadangan = $_POST["cadangan"];
$pria = $_POST["pria"];
$wanita = $_POST["wanita"];
$jlh = $_POST["jlh"];
$ket = $_POST["ket"];
$mode=$_GET["act"];

if($mode==1)
{
	$a = "insert into tbl_iplk_pelatih(id_perusahaan,nama,jlh_baik,jlh_cukup,jlh_kurang,jlh,tetap,cadangan,pria,wanita,ket) values('".$id_per."','".$nama."','".$jlh_baik."','".$jlh_cukup."','".$jlh_kurang."','".$jlh."','".$tetap."','".$cadangan."','".$pria."','".$wanita."','".$ket."')";
}
else
{
	$id=$_GET["id"];
	$a="delete from tbl_iplk_pelatih where id='$id'";
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


