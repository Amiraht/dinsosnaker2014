<?php
include "../../../../libraries/dinsos.php";
$no_resi = $_GET["link"];
$no_daftar = $_POST["no_daftar"];
$tanggal1 = $_POST["tanggal1"];
$tanggal2 = $_POST["tanggal2"];
$mode = $_GET["act"];
$tgl = date("Y-m-d");
$tahun = date("Y");

if($no_resi <> '' and $no_daftar <> '' and $tanggal1 <> '' and $tanggal2 <> '')
{
	if($mode == 1)
	{
		$a = "insert into tbl_sk_janji(no_resi,tanggal,tahun,no_daftar,berlaku,sampai) values('".$no_resi."','".$tgl."','".$tahun."','".$no_daftar."','".$tanggal1."','".$tanggal2."')";
	}
	else
	{
		$a = "update tbl_sk_janji set no_daftar='".$no_daftar."',berlaku='".$tanggal1."',sampai='".$tanggal2."' where no_resi='".$no_resi."'";
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


