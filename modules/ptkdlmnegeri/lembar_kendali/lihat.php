<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"]; 
$b = mysql_query("select * from tbl_info_berkas where no_resi = '$resi'");
$bz = mysql_fetch_array($b);

$d = mysql_query("select * from tbl_info_disposisi where tujuan = '".$bz[3]."' AND no_resi = '$resi'");
$dz = mysql_fetch_array($d);

$c = mysql_query("select id_pengguna from tbl_alur where id_proses = '".$bz[4]."'");
$cz = mysql_fetch_array($c);

$rt = "select nama_level from tbl_ket_level where id_level = '$cz[0]'";
$ac = mysql_query($rt);
$da = mysql_fetch_array($ac);	

?>
<fieldset>
	<legend>LEMBAR KENDALI</legend>
	
<form action="cetak_disposisi.php?link=<?php echo $resi; ?>" method="POST">
<table>
<tr>
	<td>DISPOSISI
	<td width="40">
	<td> 
		<select name="tujuan">
		<?php
			echo "<option value=''>$da[0]</option> ";
		?>
		</select>
</tr>
<tr valign="top">
	<td>ISI PESAN
	<td width = "40"> :
	<td>
		<textarea name="pesan" cols="40" rows="7" disabled ><?php echo $dz[5]; ?>
		</textarea>
</tr>
<tr>
	<td><input type="submit" value="CETAK">
	<td>&nbsp;
	<td>&nbsp;

</table>
</form>
</fieldset>
