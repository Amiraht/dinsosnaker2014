<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"];
$dari = $_GET["id_user"];
$petugas = $_POST["petugas"];
$jabatan = $_POST["jabatan"];
$mode=$_GET["mode"];

if($mode==1)
{
	$a = "insert into tbl_tim_periksa(no_resi,id_user,jabatan) values('".$resi."','".$petugas."','".$jabatan."')";
}
else
{
	$id_tim=$_GET["id_tim"];
	$a="delete from tbl_tim_periksa where id='$id_tim'";
}
$do = mysql_query($a);
if($do)
	{ 
		?>
		<script type="text/javascript">
			var x = '<?php echo $resi; ?>';
			var uid = '<?php echo $dari; ?>';
			alert("Berhasil");
			parent.document.location = "../../../index.php?mod=kasipentaker&opt=tim_periksa&link=<?php echo $resi; ?>&id_user=<?php echo $dari; ?>";
		</script>
		<?php
	} 
	
	else {
	echo $a;
	echo "Gagal simpan"; }
?>


