<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"]; 

$b = mysql_query("select id_proses_skrg,id_proses_sblm from tbl_info_berkas where no_resi = '$resi'");
$bz = mysql_fetch_array($b);

$cz = mysql_query("select id_pengguna from tbl_alur where id_kegiatan = '".$bz[0]."'");
$set = mysql_fetch_array($cz);

$rt = "select nama_level from tbl_ket_level where id_level = '$set[0]'";
$ac = mysql_query($rt);
$da = mysql_fetch_array($ac);

?>
<fieldset>
	<legend>LEMBAR KENDALI</legend>
<form action="disposisi_validate.php?link=<?php echo $resi; ?>" method="POST">
<table>
<tr>
	<td>DISPOSISI
	<td width="40"><input type="hidden" name="sblm" value=<?php echo $bz[1];?> />
	<td> 
		<select name="tujuan">
		<?php
			echo "<option value='$bz[0]'>$da[0]</option> ";
		?>
		</select>
</tr>
<tr valign="top">
	<td>ISI PESAN
	<td width = "40"> :
	<td>
		<textarea name="pesan" cols="40" rows="7">
		</textarea>
</tr>
<tr>
	<td><input type="submit" value="SIMPAN">
	<td>&nbsp;
	<td><input type="RESET" value="BATAL">

</table>
</form>
</fieldset>