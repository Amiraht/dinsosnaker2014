<?php
if($_GET["mode"] == 'validasi')
{
	include("tim_validate.php");
}
include "../../../libraries/dinsos.php";
$qry="select kode_bagian,nama_bagian from kbli order by nama_bagian";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="800" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>

<fieldset>
<fieldset style='width:90%; margin-left:10px; padding-left:10px;min-height:10px; margin-bottom:10px;padding-right:20px;'>
<legend></legend>
<br/>
<?php
if(mysql_num_rows($cz)==0)
	echo "<h5>*BELUM MELAKUKAN PENGISIAN</h5>";
else {
	$no=1;
echo '
	<legend>DAFTAR KLUI</legend><br/>
	<table class="tblisi" border="1">
		<tr>
			<td>KODE BAGIAN</td>
			<td>NAMA BAGIAN</td>
			<td>HAPUS</td>
		</tr>';

	while($data=mysql_fetch_array($cz))
	{
		echo"
			<tr>
				<td>$data[0]</td>
				<td>$data[1]</td>
				<td><a href=./?mode=validasi&id=".$data[0]."&act=2>HAPUS</a></td>
			</tr>";
			$no++;	
	}
	echo "</table>
	</fieldset>";
}
?>
</fieldset>
