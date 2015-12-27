<?php
include "../../../../libraries/dinsos.php";
$no_resi = $_GET["link"];
$no_daftar = $_POST["no_daftar"];
$tgl_daftar= $_POST["tgl_daftar"];
$mode=$_GET["act"];
$tgl=date("Y-m-d");
$tahun=date("Y");

if($no_resi<>''  and $no_daftar<>''  and $tgl_daftar<>'')
{
	if($mode==1)
	{
		$a = "insert into tbl_sk_iplk(no_resi,tanggal,tahun,tgl_daftar,no_daftar) values('".$no_resi."','".$tgl."','".$tahun."','".$tgl_daftar."','".$no_daftar."')";
	}
	else
	{
		$a="update tbl_sk_iplk set tgl_daftar='".$tgl_daftar."',no_daftar='".$no_daftar."' where no_resi='".$no_resi."'";
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


