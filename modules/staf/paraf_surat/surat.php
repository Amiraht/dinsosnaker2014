<script type="text/javascript">
	function terima(uid,sp,x){
	//var x = '<?php echo "$no_resi"; ?>';
	s='./index.php?mod=staf&opt=buat_surat&opts='+sp+'&link='+x+'&uid='+uid;
		window.open(s, '_blank');
		//parent.document.location.href=s;
	}
	
	function proses(uid,x){
	//var x = '<?php echo "$no_resi"; ?>';
	s='./index.php?mod=staf&opt=lembar_disposisi&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}

</script>
<?php
include "./libraries/dinsos.php";
$resi = $_GET["link"]; 
$b = mysql_query("select id_proses_skrg from tbl_info_berkas where no_resi = '$resi'");
$bz = mysql_fetch_array($b);
$sta=$_GET["opts"];
$sblm=$bz[0];
$userid=$_GET["id_user"];
if($_GET["opts"] == '')
{
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat; border-bottom:5px outset #0F0;'> 
      <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#">PEMBUATAN SURAT PEMANGGILAN</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=staf&opt=main" id="linkutama"> BERANDA LOGIN MEDIATOR</a> 
                 </td>
                <td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=staf&opt=main'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
	<td>
        <fieldset>
    	<?php
			$onc="terima('".$userid."','sp1','".$resi."')";
			$onc1="terima1('".$userid."','sp2')";
			$onc1="terima2('".$userid."','sp3')";
			$onc3="proses('".$userid."','".$resi."')";
		?>
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>PEMBUATAN SURAT</legend>
<form action="./modules/kasi/lembar_disposisi/disposisi_validate.php?link=<?php echo $resi; ?>&id_user=<?php echo $userid; ?>" method="POST">
<table>
<tr>
	<td>DRAFT SURAT PEMANGGILAN I</td>
	<td></td>
	<td><input type="button" onClick="<?php echo $onc; ?>" value="PRINT DRAFT"></td>
</tr>
<tr >
	<td>DRAFT SURAT PEMANGGILAN II</td>
	<td></td>
	<td><input type="button" onClick="<?php echo $onc1; ?>" disabled value="PRINT DRAFT"></td>
</tr>
<tr>
	<td>DRAFT SURAT PEMANGGILAN III</td>
	<td></td>
	<td><input type="button" onClick="<?php echo $onc2; ?>" disabled value="PRINT DRAFT"></td>
</tr>
</table>
</fieldset>
<fieldsetfieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
<center><input type="button" onClick="<?php echo $onc3; ?>"  value="PROSES"></center>
</form></fieldset>
<?php
	}else
	{
		if($_GET["opts"] == 'sp1')
			include('./modules/staf/buat_surat/cetak.php');
		else
			die ("restricted access");
	}
?>