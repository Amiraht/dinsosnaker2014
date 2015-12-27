<script src='../../../../libraries/jquery-1.4.3.js'></script>
<link type="text/css" href="../../../../libraries/development-bundle/themes/base/ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="../../../../libraries/development-bundle/ui/ui.core.js"></script>
<script type="text/javascript" src="../../../../libraries/development-bundle/ui/ui.datepicker.js"></script>
<script type="text/javascript" src="../../../../libraries/development-bundle/ui/i18n/ui.datepicker-id.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#date1").datepicker({ dateFormat: "yy-mm-dd", changeMonth : true,changeYear  : true });
	});
$(document).ready(function() {
    $("#date2").datepicker({ dateFormat: "yy-mm-dd", changeMonth : true,changeYear  : true });
	});
$(document).ready(function() {
    $("#date3").datepicker({ dateFormat: "yy-mm-dd", changeMonth : true,changeYear  : true });
	});		
</script>
<?php
if(isset($_GET['mode']) && $_GET["mode"] == 'validasi')
{
	include("validate.php");
}
include "../../../../libraries/dinsos.php";
$no_resi = $_GET["link"]; 
$qry="select * from tbl_sk_janji where no_resi = '$no_resi'";
$cz = mysql_query($qry);
if(mysql_num_rows($cz) == 0)
{
	$act = 1;
}
else
{
	$act = 2;
	$dt = mysql_fetch_array($cz);
}
$userid=$_GET["id_user"];
?>
<table width="900" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>
<fieldset style='width:80%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>KETERANGAN PENDAFTARAN</legend>
<form action="./?mode=validasi&link=<?php echo $no_resi; ?>&act=<?php echo $act;?>" method="post" name="informasi">
<table align="center">
<tr valign="top">
	<td>NO. PENDAFTARAN</td>
	<td>:</td>
	<td><input name="no_daftar" type="text" size="60" value="<?php echo $dt["no_daftar"];?>"></td>
</tr>

<tr valign="top">
	<td>BERLAKU MULAI</td>
	<td>:</td>
	<td><input name="tanggal1" type="text" size="20" id="date2" value="<?php echo $dt["berlaku"];?>"> S.D <input name="tanggal2" type="text" size="20" id="date3" value="<?php echo $dt["sampai"];?>"></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN"></td>

</table>

<br/>
</fieldset>
