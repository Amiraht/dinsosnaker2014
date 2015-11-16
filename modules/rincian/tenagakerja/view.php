<?php
if($_GET["mode"] == 'validasi')
{
	include("tim_validate.php");
}
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"]; 
$qry="select * from tbl_tenaga_kerja where id_perusahaan  = '$id_per'";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="800" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>

<fieldset>
<fieldset style='width:90%; margin-left:10px; padding-left:10px;min-height:10px; margin-bottom:10px;padding-right:20px;'>
<legend>KEADAAN TENAGA KERJA</legend>
<br/>
<?php
if(mysql_num_rows($cz)==0)
	echo "<h5>*BELUM MELAKUKAN PENGISIAN</h5>";
else {
	$no=1;
echo '
	<legend>TENAGA KERJA</legend><br/>
	<table class="tblisi" border="1">
		<tr>
			<td>NO</td>
			<td>KEWARGANEGARAAN</td>
			<td>JENIS KELAMIN</td>
			<td>KELOMPOK UMUR</td>
			<td>HUBUNGAN KERJA</td>
			<td>JUMLAH</td>
			<td>HAPUS</td>
		</tr>';

	while($data=mysql_fetch_array($cz))
	{
	$nmpri=mysql_query("select kelompok from tbl_kelompok_umur where id='$data[kelompok_umur]'");
	$rnmpri = mysql_fetch_array($nmpri);
	$kel=$rnmpri["kelompok"];
	$nmpri=mysql_query("select hubungan from tbl_hubungan_kerja where id='$data[hubungan_kerja]'");
	$rnmpri = mysql_fetch_array($nmpri);
	$hub=$rnmpri["hubungan"];	
		echo"
			<tr>
				<td>$no</td>
				<td>$data[2]</td>
				<td>$data[3]</td>
				<td>$kel</td>
				<td>$hub</td>
				<td>$data[6]</td>
				<td><a href=./?mode=validasi&id=".$data[0]."&act=2>HAPUS</a></td>
			</tr>";
			$no++;	
	}
	echo "</table>
	</fieldset>";
}
?>
</fieldset>
