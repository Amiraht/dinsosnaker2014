<?php
if($_GET["mode"] == 'validasi')
{
	include("tim_validate.php");
}
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"]; 
$qry="select * from tbl_serikat where id_perusahaan  = '$id_per'";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>

<fieldset>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>DATA SERIKAT PEKERJA</legend>
<form action="./?mode=validasi&id_per=<?php echo $_GET["id_per"]; ?>&act=1" method="post" name="informasi">
<table>
<tr valign="top">
	<td>NAMA PERSERIKATAN </td>
	<td>:</td>
	<td><input name="nama" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>NOMOR PENDAFTARAN SERIKAT PEKERJA </td>
	<td>:</td>
	<td><input name="nomor" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>ALAMAT PERSERIKATAN </td>
	<td>:</td>
	<td><input name="alamat" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>JUMLAH ANGGOTA </td>
	<td>:</td>
	<td><input name="jumlah" type="text" size="40"></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" disabled="disabled" value="SIMPAN"> <input type="RESET" disabled="disabled" value="BATAL"></td>

</table>

<br/>
<?php
if(mysql_num_rows($cz)==0)
	echo "<h5>*BELUM MELAKUKAN PENGISIAN</h5>";
else {
	$no=1;
echo '
	<legend>DATA SERIKAT PEKERJA</legend><br/>
	<table class="tblisi" border="1">
		<tr>
			<td>NO</td>
			<td>NAMA SERIKAT PEKERJA</td>
			<td>NOMOR PENDAFTARAN SERIKAT PEKERJA</td>
			<td>ALAMAT SERIKAT PEKERJA</td>
			<td>JUMLAH ANGGOTA</td>
			<td>HAPUS</td>
		</tr>';

	while($data=mysql_fetch_array($cz))
	{
	//$nmpri=mysql_query("select pendidikan from tbl_pendidikan where id='$data[id_pendidikan]'");
	//$rnmpri = mysql_fetch_array($nmpri);
	//$pend=$rnmpri["pendidikan"];	
		echo"
			<tr>
				<td>$no</td>
				<td>$data[nama]</td>
				<td>$data[nomor]</td>
				<td>$data[alamat]</td>
				<td>$data[jumlah]</td>
				<td><a href=./?mode=validasi&id=".$data[0]."&act=2>HAPUS</a></td>
			</tr>";
			$no++;	
	}
	echo "</table>
	</fieldset>";
	?>
    </form>
	<?php
}
?>
</fieldset>
