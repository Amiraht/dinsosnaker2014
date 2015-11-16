<?php
include "../../../../libraries/dinsos.php";
$no_resi = $_GET["link"];
$lampiran = $_POST["lampiran"];
$hal = $_POST["hal"];
$no_daftar = $_POST["no_daftar"];
$tgl_daftar= $_POST["tgl_daftar"];
$urut = $_POST["urut"];
$tanggal1 = $_POST["tanggal1"];
$tanggal2 = $_POST["tanggal2"];
$mode=$_GET["act"];
$tgl=date("Y-m-d");
$tahun=date("Y");

if($no_resi<>'' and $lampiran<>'' and $hal<>'' and $no_daftar<>'' and $urut<>'' and $tgl_daftar<>'')
{
	if($mode==1)
	{
		$a = "insert into tbl_sk_wl(no_resi,tanggal,tahun,lampiran,hal,tgl_daftar,no_daftar,urut,berlaku,sampai) values('".$no_resi."','".$tgl."','".$tahun."','".$lampiran."','".$hal."','".$tgl_daftar."','".$no_daftar."','".$urut."','".$tanggal1."','".$tanggal2."')";
	}
	else
	{
		$a="update tbl_sk_wl set lampiran='".$lampiran."',hal='".$hal."',tgl_daftar='".$tgl_daftar."',no_daftar='".$no_daftar."',urut='".$urut."',berlaku='".$tanggal1."',sampai='".$tanggal2."' where no_resi='".$no_resi."'";
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


