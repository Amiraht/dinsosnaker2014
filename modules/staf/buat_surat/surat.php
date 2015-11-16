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
	
	function nomor(c,d,uid)
	{
			var t=document.getElementById("div_cek_"+c);
			if(t.innerHTML != ''){
				t.innerHTML = '';
			}
			else
				t.innerHTML='<iframe src="./modules/penomoran/'+c+'/index.php?link='+d+'&id_user='+uid+'" width="100%" height="300px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
			
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
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>PERIKSA BERKAS DAN BUAT SURAT PEMANGGILAN</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=staf&opt=main" id="linkutama"> BERANDA LOGIN MEDIATOR</a> 
                  <img src="./image/panah.gif"  /><a href="" id="linkutama"> PERIKSA BERKAS DAN BUAT SURAT PEMANGGILAN</a>
                 </td>
                <!--<td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=staf&opt=main'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>-->
    			</td>
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
	<td>
    <div id='content' style='margin-left:2%;margin-bottom:20px;width:98%;'>
        <fieldset>
    	<?php
			$onc="terima('".$userid."','sp1','".$resi."')";
			$onc1="terima('".$userid."','sp2','".$resi."')";
			$onc2="terima('".$userid."','sp3','".$resi."')";
			$onc3="proses('".$userid."','".$resi."')";
			$onc4 = "nomor('sp1','".$resi."','".$_SESSION["id_user"]."')";
			$onc5 = "nomor('sp2','".$resi."','".$_SESSION["id_user"]."')";
			$onc6 = "nomor('sp3','".$resi."','".$_SESSION["id_user"]."')";
		?>

	<legend>BUAT SURAT PEMANGGILAN</legend>
<form action="./modules/kasi/lembar_disposisi/disposisi_validate.php?link=<?php echo $resi; ?>&id_user=<?php echo $userid; ?>" method="POST">
<table width="100%">
<tr>
	<td width="200px">DRAFT SURAT PEMANGGILAN I</td>
	<td></td>
	<td><input type="button" onClick="<?php echo $onc4; ?>" value="ISI SURAT"> <input type="button" onClick="<?php echo $onc; ?>" value="PRINT DRAFT"></td>
</tr>
<tr id='div_if'>
    <td colspan='11'> <div id='div_cek_sp1'></div>
</tr>
<tr >
	<td>DRAFT SURAT PEMANGGILAN II</td>
	<td></td>
	<td><input type="button" onClick="<?php echo $onc5; ?>" value="ISI SURAT"> <input type="button" onClick="<?php echo $onc1; ?>" value="PRINT DRAFT"></td>
</tr>
<tr id='div_if'>
    <td colspan='11'> <div id='div_cek_sp2'></div>
</tr>
<tr>
	<td>DRAFT SURAT PEMANGGILAN III</td>
	<td></td>
	<td><input type="button" onClick="<?php echo $onc6; ?>" value="ISI SURAT"> <input type="button" onClick="<?php echo $onc2; ?>" value="PRINT DRAFT"></td>
</tr>
<tr id='div_if'>
    <td colspan='11'> <div id='div_cek_sp3'></div>
</tr>
</table>
<br/><br/><br/>
<center><input type="button" onClick="<?php echo $onc3; ?>"  value="PROSES"></center><br/>
</form></fieldset>
</div>
</td>
	</tr>

 <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>		
<?php
	}else
	{
		if($_GET["opts"] == 'sp1')
			include('./modules/staf/buat_surat/cetak.php');
		else if($_GET["opts"] == 'sp2')
			include('./modules/staf/buat_surat/cetak1.php');
		else if($_GET["opts"] == 'sp3')
			include('./modules/staf/buat_surat/cetak2.php');						
		else
			die ("restricted access");
	}
?>