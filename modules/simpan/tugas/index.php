<?php
if(isset($_GET["mode"]) && $_GET["mode"] == 'validasi')
{
	include("validate.php");
}
include "../../../libraries/dinsos.php";
$no_resi = $_GET["link"]; 
$qry="select * from tbl_hasil_tugas where no_resi  = '$no_resi'";
$cz = mysql_query($qry) or die(mysql_error());

$number = mysql_num_rows($cz);
$act = 0; // inisialisasi variabel flag 
if($number == 0)
{
	$act=1;
}
else
{
	$act = 2;
	$dt=mysql_fetch_array($cz);
}
$userid=$_GET["id_user"];
?>
<table width="800" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>INPUT FILE SURAT TUGAS</legend>
<form action="./?mode=validasi&link=<?php echo $no_resi; ?>&act=<?php echo $act;?>" method="post" name="informasi" enctype="multipart/form-data">
<table align="center">
<tr valign="top">
	<td>JUDUL</td>
	<td>:</td>
	<td><input name="nama" type="text" size="60" value="<?php echo $dt["judul"];?>"></td>
</tr>
<tr valign="top">
	<td width="40%">FILE SURAT<font size="-1"> (Nama File tanpa spasi,maks:1,4 MB)</font></td>
	<td>:</td>
	<td><input type="file" name="file" value="<?php echo $dt["file"];?>"/></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN"></td>
</tr>
<?php
	if($act == 2){
		echo "<br/><tr><td>&nbsp;</td><td>&nbsp;</td>
				<td><a href='../../../file_lap/".$dt['file']."' target='_blank' style='text-decoration:none;color:green;'>LIHAT FILE SURAT</a></span></td></tr>
		";
	}
?>
</table>

<br/>
</fieldset>
