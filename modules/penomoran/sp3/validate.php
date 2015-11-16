<?php
include "../../../libraries/dinsos.php";
$no_resi = $_GET["link"];
$hari = $_POST["hari"];
$pukul = $_POST["pukul"];
$tanggal= $_POST["tanggal"];
$mode=$_GET["act"];
$tgl=date("Y-m-d");
$tahun=date("Y");

if($no_resi<>'' and $pukul<>'' and $tanggal<>'' and $hari<>'')
{
	if($mode==1)
	{
		$a = "insert into tbl_sp3(no_resi,tanggal,tahun,hari_h,tgl_h,pukul_h) values('".$no_resi."','".$tgl."','".$tahun."','".$hari."','".$tanggal."','".$pukul."')";
	}
	else
	{
		$a="update tbl_sp3 set tgl_h='".$tanggal."',hari_h='".$hari."', pukul_h='".$pukul."'where no_resi='".$no_resi."'";
	}
	$do = mysql_query($a);
	if($do)
		{ 
			?>
			<script type="text/javascript">
				alert("Berhasil");
				document.location = "./index.php?link=<?php echo $no_resi; ?>";
			</script>
			<?php
		} 
		
		else {
		echo $a;
		echo "Gagal simpan"; }
}
?>


