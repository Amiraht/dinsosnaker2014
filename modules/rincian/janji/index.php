<?php
if($_GET["mode"] == 'validasi')
{
	include("tim_validate.php");
}
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"]; 
$qry="select * from tbl_rencana_tk where id_perusahaan  = '$id_per'";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>

<fieldset>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>JANJI YANG DIBERIKAN</legend>
<form action="./?mode=validasi&id_per=<?php echo $_GET["id_per"]; ?>&act=1" method="post" name="informasi">
<table>
<tr valign="top">
	<td>JANJI </td>
	<td>:</td>
	<td><input name="jabatan" type="text" size="40"></td>
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
	<legend>TENAGA KERJA</legend><br/>
	<table class="tblisi" border="1">
		<tr>
			<td>NO</td>
			<td>JABATAN</td>
			<td>KODE</td>
			<td>PENDIDIKAN</td>
			<td>KEWARGANEGARAAN</td>
			<td>HUBUNGAN KERJA</td>
			<td>JUMLAH</td>
			<td>HAPUS</td>
		</tr>';

	while($data=mysql_fetch_array($cz))
	{
	$nmpri=mysql_query("select pendidikan from tbl_pendidikan where id='$data[id_pendidikan]'");
	$rnmpri = mysql_fetch_array($nmpri);
	$pend=$rnmpri["pendidikan"];	
		echo"
			<tr>
				<td>$no</td>
				<td>$data[jabatan]</td>
				<td>$data[kode]</td>
				<td>$pend</td>
				<td>$data[kewarganegaraan]</td>
				<td>$data[hubungan]</td>
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
