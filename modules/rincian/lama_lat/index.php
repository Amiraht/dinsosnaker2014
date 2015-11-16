<?php
if($_GET["mode"] == 'validasi')
{
	include("tim_validate.php");
}
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"]; 
$qry="select * from tbl_iplk_durasi where id_perusahaan  = '$id_per'";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>

<fieldset>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>DURASI LATIHAN DAN JUMLAH PESERTA</legend>
<form action="./?mode=validasi&id_per=<?php echo $_GET["id_per"]; ?>&act=1" method="post" name="informasi">
<table>
<tr valign="top">
	<td>NAMA PROGRAM</td>
	<td>:</td>
	<td><input name="nama" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>LAMA LATIHAN TEORI</td>
	<td>:</td>
	<td><input name="teori" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>LAMA LATIHAN PRAKTEK </td>
	<td>:</td>
	<td><input name="praktek" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>TOTAL LAMA LATIHAN </td>
	<td>:</td>
	<td><input name="total" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>MAKSIMUM SISWA PER ANGKATAN </td>
	<td>:</td>
	<td><input name="maks_angkatan" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>JUMLAH ANGKATAN PER TAHUN </td>
	<td>:</td>
	<td><input name="angkatan" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>JUMLAH SISWA PER TAHUN</td>
	<td>:</td>
	<td><input name="siswa_tahun" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>BIAYA LATIHAN PER ORANG PER PROGRAM </td>
	<td>:</td>
	<td><input name="biaya" type="text" size="40"></td>
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
	<legend>DURASI LATIHAN DAN JUMLAH PESERTA</legend><br/>
	<table class="tblisi" border="1">
		<tr>
			<td>NO</td>
			<td>NAMA PROGRAM</td>
			<td>LAMA LATIHAN TEORI</td>
			<td>LAMA LATIHAN PRAKTEK</td>
			<td>TOTAL LAMA LATIHAN</td>
			<td>MAKSIMUM SISWA PER ANGKATAN</td>
			<td>JUMLAH ANGKATAN PER TAHUN</td>
			<td>JUMLAH SISWA PER TAHUN</td>
			<td>BIAYA LATIHAN PER ORANG PER PROGRAM</td>
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
				<td>$data[teori]</td>
				<td>$data[praktek]</td>
				<td>$data[total]</td>
				<td>$data[maks_angkatan]</td>
				<td>$data[angkatan]</td>
				<td>$data[siswa_tahun]</td>
				<td>$data[biaya]</td>
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
