<?php
include "../../../libraries/dinsos.php";
$resi = $_GET["link"]; 
$userid=$_GET["id_user"];
?>
<fieldset>
	<legend>LAPORAN MEDIASI</legend>
<form action="mediasi_validate.php?link=<?php echo $resi; ?>" method="POST">
<table>
<tr>
	<td>HASIL MEDIASI
	<td width="40">
	<td> 
		<select name="hasil">
		<?php
		$rt = mysql_query("select * from tbl_hasil_mediasi");
		while($da = mysql_fetch_array($rt))
			{
				echo "<option value='$da[0]'>$da[1]</option> ";
			}
		?>
		</select>
</tr>
<tr valign="top">
	<td>KETERANGAN
	<td width = "40"> :
	<td>
		<textarea name="keterangan" cols="60" rows="10" style="font-family:verdana;font-size:12px">ISI KETERANGAN</textarea>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN"><input type="RESET" value="BATAL"></td>

</table>
</form>
</fieldset>