<?php
if($_GET["mode"] == 'validasi')
{
	include("tim_validate.php");
}
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"]; 
$qry="select * from tbl_iplk_instruktur where id_perusahaan  = '$id_per'";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>

<fieldset>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>INSTRUKTUR</legend>
<form action="./?mode=validasi&id_per=<?php echo $_GET["id_per"]; ?>&act=1" method="post" name="informasi">
<table>
<tr valign="top">
	<td>NAMA</td>
	<td>:</td>
	<td><input name="nama" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>UMUR</td>
	<td>:</td>
	<td><input name="umur" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>PENDIDIKAN</td>
	<td>:</td>
	<td><input name="pendidikan" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>LATIHAN TEKNIS </td>
	<td>:</td>
	<td><input name="latihan" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>PENGALAMAN TEKNIS</td>
	<td>:</td>
	<td><input name="pengalaman" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>KETERANGAN</td>
	<td>:</td>
	<td><input name="ket" type="text" size="40"></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN"> <input type="RESET" value="BATAL"></td>

</table>

<br/>
<?php
if(mysql_num_rows($cz)==0)
	echo "<h5>*BELUM MELAKUKAN PENGISIAN</h5>";
else {
	$no=1;
echo '
	<legend>INSTRUKTUR</legend><br/>
	<table class="tblisi" border="1">
		<tr>
			<td>NO</td>
			<td>NAMA</td>
			<td>UMUR</td>
			<td>PENDIDIKAN</td>
			<td>LATIHAN TEKNIS</td>
			<td>PENGALAMAN TEKNIS</td>
			<td>KETERANGAN</td>
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
				<td>$data[umur]</td>
				<td>$data[pendidikan]</td>
				<td>$data[latihan]</td>
				<td>$data[pengalaman]</td>
				<td>$data[ket]</td>
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
