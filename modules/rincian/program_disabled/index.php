<?php
if($_GET["mode"] == 'validasi')
{
	include("tim_validate.php");
}
include "../../../libraries/dinsos.php";
$id_per = $_GET["id_per"]; 
$qry="select * from tbl_iplk_program where id_perusahaan  = '$id_per'";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>

<fieldset>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
<br/>
<?php
if(mysql_num_rows($cz)==0)
	echo "<h5>*BELUM MELAKUKAN PENGISIAN</h5>";
else {
	$no=1;
echo '
	<legend>JENIS PROGRAM LATIHAN KERJA</legend><br/>
	<table class="tblisi" border="1">
		<tr>
			<td>NO</td>
			<td>NAMA PROGRAM</td>
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
