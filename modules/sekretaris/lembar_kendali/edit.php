<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"]; 
$data=explode("-",$no_resi);
$jenis_urus = $data[0];

$b = mysql_query("select id_proses_skrg from tbl_info_berkas where no_resi = '$resi'");
$bz = mysql_fetch_array($b);
if($jenis_urus=='04' or $jenis_urus=='05')
{
	if($bz[0]=='77')
	{
		$cz = mysql_query("select id_pengguna,id_proses_lanjutan from tbl_alur_baru where id_proses_lanjutan='410'");
	}
	else
	{
		$cz = mysql_query("select id_pengguna,id_proses_lanjutan from tbl_alur_baru where id_proses = '".$bz[0]."'");
	}
}
else
{
	$cz = mysql_query("select id_pengguna,id_proses_lanjutan from tbl_alur_baru where id_proses = '".$bz[0]."'");
}
$userid=$_GET["id_user"];

?>
<fieldset>
	<legend>LEMBAR KENDALI</legend>
<form action="disposisi_validate.php?link=<?php echo $resi; ?>&id_user=<?php echo $userid; ?>" method="POST">
<table>
<tr>
	<td>DISPOSISI
	<td width="40"><input type="hidden" name="sblm" value=<?php echo $bz[0];?> />
	<td> 
		<select name="tujuan">
		<?php
		while($set = mysql_fetch_array($cz))
		{
		$rt = "select id_user,nama,level from user where level = '$set[0]'";
		$ac = mysql_query($rt);
		while($da = mysql_fetch_array($ac))
			{
				echo "<option value='$da[0]'>$da[1]</option> ";
			}
		}
		?>
		</select>
</tr>
<tr valign="top">
	<td>ISI PESAN
	<td width = "40"> :
	<td>
		<textarea name="pesan" cols="40" rows="7" style="font-family:verdana;font-size:12px">ISI PESAN</textarea>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN"><input type="RESET" value="BATAL"></td>

</table>
</form>
</fieldset>