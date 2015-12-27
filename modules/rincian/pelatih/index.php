<?php
if($_GET["mode"] == 'validasi')
{
	include("tim_validate.php");
}
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"]; 
$qry="select * from tbl_iplk_pelatih where id_perusahaan  = '$id_per'";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>

<fieldset>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>DATA INSTRUKTUR</legend>
<form action="./?mode=validasi&id_per=<?php echo $_GET["id_per"]; ?>&act=1" method="post" name="informasi">
<table>
<tr valign="top">
	<td>JENIS LATIHAN</td>
	<td>:</td>
	<td><input name="nama" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>JLH YANG KUALIFIKASI BAIK</td>
	<td>:</td>
	<td><input name="jlh_baik" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>JLH YANG KUALIFIKASI CUKUP</td>
	<td>:</td>
	<td><input name="jlh_cukup" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>JLH YANG KUALIFIKASI KURANG </td>
	<td>:</td>
	<td><input name="jlh_kurang" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>JLH YANG TETAP</td>
	<td>:</td>
	<td><input name="tetap" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>JLH YANG TIDAK TETAP</td>
	<td>:</td>
	<td><input name="cadangan" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>JLH YANG PRIA</td>
	<td>:</td>
	<td><input name="pria" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>JLH YANG WANITA</td>
	<td>:</td>
	<td><input name="wanita" type="text" size="40"></td>
</tr>
<tr valign="top">
	<td>JUMLAH TOTAL </td>
	<td>:</td>
	<td><input name="jlh" type="text" size="40"></td>
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
	<legend>DATA INSTRUKTUR</legend><br/>
	<table class="tblisi" border="1">
		<tr>
			<td>NO</td>
			<td>NAMA PROGRAM</td>
			<td>JLH YANG KUALIFIKASI BAIK</td>
			<td>JLH YANG KUALIFIKASI CUKUP</td>
			<td>JLH YANG KUALIFIKASI KURANG</td>
			<td>JLH YANG TETAP</td>
			<td>JLH YANG TIDAK TETAP</td>
			<td>JLH YANG PRIA</td>
			<td>JLH YANG WANITA</td>
			<td>JLH TOTAL</td>
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
				<td>$data[jlh_baik]</td>
				<td>$data[jlh_cukup]</td>
				<td>$data[jlh_kurang]</td>
				<td>$data[tetap]</td>
				<td>$data[cadangan]</td>
				<td>$data[pria]</td>
				<td>$data[wanita]</td>
				<td>$data[jlh]</td>
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
