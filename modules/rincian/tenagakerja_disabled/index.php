<?php
if($_GET["mode"] == 'validasi')
{
	include("tim_validate.php");
}
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"]; 
$qry="select * from tbl_tenaga_kerja where id_perusahaan  = '$id_per'";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>

<fieldset>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>KEADAAN TENAGA KERJA</legend>
<form action="./?mode=validasi&id_per=<?php echo $_GET["id_per"]; ?>&act=1" method="post" name="informasi">
<table>
<tr>
	<td>KEWARGANEGARAAN</td>
    <td>:</td>
	<td> 
		<select name="kwn" disabled="disabled">
		<option value="WNI">WNI</option> 
        <option value="WNA">WNA</option> 
		</select>
    </td>
</tr>
<tr>
	<td>JENIS KELAMIN</td>
    <td>:</td>
	<td> 
		<select name="j_kel" disabled="disabled">
		<option value="LAKI-LAKI">LAKI-LAKI</option> 
        <option value="WANITA">WANITA</option> 
		</select>
    </td>
</tr>
<tr>
	<td>KELOMPOK UMUR</td>
    <td>:</td>
	<td> 
		<select name="umur" disabled="disabled">
        <option value="0"></option>
		<?php
            $r = mysql_query("select * from tbl_kelompok_umur");
            while($r1 = mysql_fetch_array($r))
            {
                echo '<option value="'.$r1["id"].'">'.$r1["kelompok"].'</option>';
            }
        ?>
		</select>
    </td>
</tr>
<tr>
	<td>HUBUNGAN KERJA</td>
    <td>:</td>
	<td> 
		<select name="hub" disabled="disabled">
		<?php
            $r = mysql_query("select * from tbl_hubungan_kerja");
            while($r1 = mysql_fetch_array($r))
            {
                echo '<option value="'.$r1["id"].'">'.$r1["hubungan"].'</option>';
            }
        ?>      
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
			<td>KEWARGANEGARAAN</td>
			<td>JENIS KELAMIN</td>
			<td>KELOMPOK UMUR</td>
			<td>HUBUNGAN KERJA</td>
			<td>JUMLAH</td>
			<td>HAPUS</td>
		</tr>';

	while($data=mysql_fetch_array($cz))
	{
	$nmpri=mysql_query("select kelompok from tbl_kelompok_umur where id='$data[kelompok_umur]'");
	$rnmpri = mysql_fetch_array($nmpri);
	$kel=$rnmpri["kelompok"];
	$nmpri=mysql_query("select hubungan from tbl_hubungan_kerja where id='$data[hubungan_kerja]'");
	$rnmpri = mysql_fetch_array($nmpri);
	$hub=$rnmpri["hubungan"];	
		echo"
			<tr>
				<td>$no</td>
				<td>$data[2]</td>
				<td>$data[3]</td>
				<td>$kel</td>
				<td>$hub</td>
				<td>$data[6]</td>
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
