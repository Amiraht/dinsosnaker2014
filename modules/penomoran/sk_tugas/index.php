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
if(isset($_GET["mode"]) && $_GET["mode"] == 'validasi')
{
	include("validate.php");
}

include "../../../libraries/dinsos.php";
$no_resi = $_GET["link"]; 

$data=explode("-",$no_resi);
$jenis_urus = $data[0];

$tahun=date("Y");
if($jenis_urus=='03')
{
	$nmpri=mysql_query("select statusp1,statusp2,statusp3 from tbl_berkas_pengaduan where no_resi='$no_resi'");
	$rnmpri = mysql_fetch_array($nmpri);
	$sp1=$rnmpri["statusp1"];
	$sp2=$rnmpri["statusp2"];
	$sp3=$rnmpri["statusp3"];
	
	if($sp1=='0')
	{
		$qry="select * from tbl_sp1 where no_resi = '$no_resi' and tahun='$tahun'";
	}
	else
	{
		if($sp2=='0')
		{
			$qry="select * from tbl_sp2 where no_resi = '$no_resi' and tahun='$tahun'";
		}
		else
		{
			$qry="select * from tbl_sp3 where no_resi = '$no_resi' and tahun='$tahun'";
		}
		
	}
}
else
{
	$qry="select * from tbl_surat_tugas where no_resi  = '$no_resi' and tahun='$tahun'";
}
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
<table width="100%" border="0" cellspacing="2" cellpadding="5">
<tr>
	<td>
<fieldset style='width:85%; height:220px; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>PENOMORAN SK PENUGASAN</legend>
<form action="./?mode=validasi&link=<?php echo $no_resi; ?>&act=<?php echo $act;?>" method="post" name="informasi">
<table style="font-family:tahoma; font-size:12px;"  >
<tr>
	<td>&nbsp;</td></tr>
<tr valign="top" height="30px">
	<td>NOMOR SURAT</td>
	<td>:</td>
	<td><input name="nomor" type="text" size="60" value="<?php echo $dt["no_surat"];?>"></td>
</tr>
<tr valign="top" height="30px">
	<td>TANGGAL</td>
	<td>:</td>
	<td><input name="tanggal" type="text" size="20" id="date1" value="<?php echo $dt["tanggal"];?>"><br/><br/></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN"></td>

</table>

<br/>
</fieldset>
