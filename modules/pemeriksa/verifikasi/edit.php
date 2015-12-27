<script type="text/javascript">
	function terima(uid,sp,x){
	//var x = '<?php echo "$no_resi"; ?>';
	s='./index.php?mod=pemeriksa&opt=verifikasi_cetak&link='+x+'&uid='+uid;
		window.open(s, '_blank');
		//parent.document.location.href=s;
	}
	
	function proses(uid,x){
	//var x = '<?php echo "$no_resi"; ?>';
	s='./index.php?mod=pemeriksa&opt=lembar_disposisi&opts=periksa&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}

</script>
<?php
include "./libraries/dinsos.php";
$resi = $_GET["link"]; 
$qry="select status_ver,ket_ver from tbl_berkas_imta where no_resi = '$resi'";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat; border-bottom:5px outset #0F0;'> 
      <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#">LAPORAN HASIL VERIFIKASI</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=pemeriksa&amp;opt=main" id="linkutama"> BERANDA LOGIN TIM PEMERIKSA</a> 
                 </td>
                <td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=pemeriksa&opt=main'" 
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
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>LAPORAN HASIL VERIFIKASI</legend>
<form action="./modules/pemeriksa/verifikasi/tim_validate.php?mode=1&link=<?php echo $resi; ?>&amp;id_user=<?php echo $userid; ?>&amp;status=<?php echo $sta; ?>" method="POST">
<table>
<tr>
	<td>STATUS PEMERIKSAAN</td>
    <td>:</td>
	<td> 
		<select name="status">
		<option value="terima">TERIMA</option>
		<option value="tolak">TOLAK</option>
		</select>
</tr>
<tr valign="top">
	<td>KETERANGAN</td>
	<td>:</td>
	<td><textarea name="keterangan" cols="40" rows="7">hasil verifikasi</textarea></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN"> <input type="RESET" value="BATAL"></td>

</table>

<br/>
<?php
if(mysql_num_rows($cz)==0)
	echo "<h5></h5>";
else {
	$no=1;
echo '
	<legend>LAPORAN HASIL VERIFIKASI</legend><br/>
	<table class="tblisi" border="1">
		<tr>
			<td>STATUS</td>
			<td>KETERANGAN</td>
		</tr>';

	while($data=mysql_fetch_array($cz))
	{
	$status_ver=$data[0];
	$ket_ver=$data[1];
		echo"
			<tr>
				<td>$status_ver</td>
				<td>$ket_ver</td>
			</tr>";
			$no++;	
	}
	echo "</table>
	</fieldset>";
	$onc="terima('".$userid."','spt','".$resi."')";
	$onc1="proses('".$userid."','".$resi."')";
	?>
    <center>
	<input type="button" onClick=<?php echo $onc;?> value="PRINT LAPORAN">
    <input type="button" onClick=<?php echo $onc1;?> value="PROSES">
    </center>
    </form>
	<?php
}
?>
</fieldset>
