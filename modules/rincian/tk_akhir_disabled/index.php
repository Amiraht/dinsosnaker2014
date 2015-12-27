<?php
if($_GET["mode"] == 'validasi')
{
	include("tim_validate.php");
}
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"]; 
$qry="select * from tbl_tenaga_kerja_akhir where id_perusahaan  = '$id_per'";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>

<fieldset>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>TENAGA KERJA 12 BULAN TERAKHIR</legend>
<form action="./?mode=validasi&id_per=<?php echo $_GET["id_per"]; ?>&act=1" method="post" name="informasi">
<table>
<tr valign="top">
	<td>GOL. POKOK JABATAN</td>
	<td>:</td>
	<td><input name="gol" type="text" size="20" disabled="disabled"></td>
</tr>
<tr>
	<td>PENDIDIKAN</td>
    <td>:</td>
	<td> 
		<select name="pendidikan" disabled="disabled">
		<?php
            $r = mysql_query("select * from tbl_pendidikan");
            while($r1 = mysql_fetch_array($r))
            {
                echo '<option value="'.$r1["id"].'">'.$r1["pendidikan"].'</option>';
            }
        ?>
		</select>
    </td>
</tr>
<tr>
	<td>KEWARGANEGARAAN</td>
    <td>:</td>
	<td> 
		<select name="kwn" disabled="disabled">
		<option value="WNI">WNI</option> 
        <option value="WNA">WNA</option>
        <option value="PENCA">PENCA</option> 
		</select>
    </td>
</tr>
<tr>
	<td>HUBUNGAN KERJA</td>
    <td>:</td>
	<td> 
		<select name="hub" disabled="disabled">
		<option value="TETAP">TETAP</option> 
        <option value="TIDAK TETAP">TIDAK TETAP</option>
		</select>
    </td>
</tr>
<tr valign="top">
	<td>JUMLAH</td>
	<td>:</td>
	<td><input name="jumlah" type="text" size="15" disabled="disabled"></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN" disabled="disabled"> <input type="RESET" value="BATAL" disabled="disabled"></td>

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
			<td>GOL> POKOK</td>
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
				<td>$data[golongan]</td>
				<td>$pend</td>
				<td>$data[kewarganegaraan]</td>
				<td>$data[hubungan]</td>
				<td>$data[jumlah]</td>
				<!-- <td><a href=./?mode=validasi&id=".$data[0]."&act=2>HAPUS</a></td> -->
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
