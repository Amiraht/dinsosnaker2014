<script src='../../../libraries/jquery-1.4.3.js'></script>
<link type="text/css" href="../../../libraries/development-bundle/themes/base/ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="../../../libraries/development-bundle/ui/ui.core.js"></script>
<script type="text/javascript" src="../../../libraries/development-bundle/ui/ui.datepicker.js"></script>
<script type="text/javascript" src="../../../libraries/development-bundle/ui/i18n/ui.datepicker-id.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#date1").datepicker({ dateFormat: "yy-mm-dd", changeMonth : true,changeYear  : true });
	});
</script>
<?php
if($_GET["mode"] == 'validasi')
{
	include("validate.php");
}
include "../../../libraries/dinsos.php";
$no_resi = $_GET["link"]; 
$tahun=date("Y");
$qry="select * from tbl_sp3 where no_resi  = '$no_resi' and tahun='$tahun'";
$cz = mysql_query($qry);
if(mysql_num_rows($cz)==0)
{
	$act=1;
}
else
{
	$act=2;
	$dt=mysql_fetch_array($cz);
}
$userid=$_GET["id_user"];
?>
<table width="800" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px; font-size:14px;'>
	<legend>PENGISIAN SURAT PANGGILAN III</legend>
<form action="./?mode=validasi&link=<?php echo $no_resi; ?>&act=<?php echo $act;?>" method="post" name="informasi"> 
<table align="center"  style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
<tr valign="top">
	<td width="250px">HARI PERTEMUAN</td>
	<td>:</td>
	<td><input name="hari" type="text" size="60" value="<?php echo $dt["hari_h"];?>"></td>
</tr>
<tr valign="top">
	<td>TANGGAL</td>
	<td>:</td>
	<td><input name="tanggal" type="text" size="20" id="date1" value="<?php echo $dt["tgl_h"];?>"></td>
</tr>
<tr valign="top">
	<td>PUKUL</td>
	<td>:</td>
	<td><input name="pukul" type="text" size="20" value="<?php echo $dt["pukul_h"];?>"> WIB</td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN"></td>
</tr>
</table>
<br/>
</fieldset>
</table>
