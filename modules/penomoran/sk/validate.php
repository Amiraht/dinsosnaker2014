<?php
include "../../../libraries/dinsos.php";
$no_resi = $_GET["link"];
$nomor = $_POST["nomor"];
$tanggal= $_POST["tanggal"];
$mode=$_GET["act"];
$tgl=strtotime($tanggal);
$tahun=date("Y",$tgl);

if($no_resi<>'' and $nomor<>'' and $tanggal<>'')
{
	if($mode==1)
	{
		$a = "insert into tbl_sk(no_resi,no_surat,tanggal,tahun) values('".$no_resi."','".$nomor."','".$tanggal."','".$tahun."')";
	}
	else
	{
		$a="update tbl_sk set no_surat='".$nomor."',tanggal='".$tanggal."',tahun='".$tahun."' where no_resi='".$no_resi."'";
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


