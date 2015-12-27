<?php
if(isset($_GET["mode"]) && $_GET["mode"] == 'validasi')
{
	include("validate.php");
}
include "../../../libraries/dinsos.php";
$no_resi = $_GET["link"]; 
$qry = "select * from tbl_hasil_lap where no_resi  = '$no_resi'";
$cz = mysql_query($qry);
if(mysql_num_rows($cz) == 0)
{
	$act=1;
}
else
{
	$act = 2;
	$dt = mysql_fetch_array($cz);
}
$userid=$_GET["id_user"];
?>
<table width="800" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>INPUT FILE LAPORAN</legend>
<form action="./?mode=validasi&link=<?php echo $no_resi; ?>&act=<?php echo $act;?>" method="post" name="informasi" enctype="multipart/form-data">
<table align="center">
<tr valign="top">
	<td>JUDUL</td>
	<td>:</td>
	<td><input name="nama" type="text" size="60" value="<?php echo $dt["judul"];?>"></td>
</tr>
<?php
	// cek ada tidaknya file laporan yang sudah di upload 
	$path =  "../../../file_lap/".$dt["file"];
	if($dt["file"] != "" && file_exists($path)){
		echo "
			<tr valign='top'>
			<td>&nbsp;</td>
		    <td>&nbsp;</td>
			<td><a href='".$path."' target='_blank' style='color:green;text-decoration:none;'>LIHAT LAMPIRAN</a></td>
			</tr>
		";
	}else if($dt["file"] != "" && !file_exixts($path)){
		echo "
			<tr valign='top'>
			<td width='40%'>FILE LAPORAN<font size='-1'> (Nama File tanpa spasi,maks:1,4 MB)</font></td>
			<td>:</td>
			<td><input type='file' name='file' value='".$dt["file"]."'/></td>
			</tr>
		";
	}else{
		echo "
			<tr valign='top'>
			<td width='40%'>FILE LAPORAN<font size='-1'> (Nama File tanpa spasi,maks:1,4 MB)</font></td>
			<td>:</td>
			<td><input type='file' name='file' value='".$dt["file"]."'/></td>
			</tr>
		";
	}
?>
	
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN"></td>
</tr>	

</table>

<br/>
</fieldset>
