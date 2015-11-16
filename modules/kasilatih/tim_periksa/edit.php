<script type="text/javascript">
	function terima(uid,sp,x){
	//var x = '<?php echo "$no_resi"; ?>';
	s='./index.php?mod=kasilatih&opt=buat_surat&opts='+sp+'&link='+x+'&uid='+uid;
		window.open(s, '_blank');
		//parent.document.location.href=s;
	}
	
	function proses(uid,x){
	//var x = '<?php echo "$no_resi"; ?>';
	s='./index.php?mod=kasilatih&opt=lembar_disposisi&opts=periksa&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}

</script>
<?php
include "./libraries/dinsos.php";
$resi = $_GET["link"]; 
$qry="select id_user,jabatan,id from tbl_tim_periksa where no_resi = '$resi'";
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>PEMILIHAN TIM PEMANTAU</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=kasilatih&amp;opt=main" id="linkutama"> BERANDA LOGIN KASI INSTRUKTUR</a>
                  <img src="./image/panah.gif"  /><a href="./index.php?mod=kasilatih&amp;opt=main" id="linkutama"> PEMILIHAN TIM PEMERIKSA</a> 
                 </td>
               <!-- <td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=kasilatih&opt=main'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>-->
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
	<td>


<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>PEMILIHAN TIM PEMERIKSA</legend>
<form action="./modules/kasilatih/tim_periksa/tim_validate.php?mode=1&link=<?php echo $resi; ?>&amp;id_user=<?php echo $userid; ?>&amp;status=<?php echo $sta; ?>" method="POST">
<table>
<tr>
	<td>NAMA</td>
    <td></td>
	<td> 
		<select name="petugas">
		<?php

		$rt = "select id_user,nama,level from user where level in('22','23','24')";
		$ac = mysql_query($rt);
		while($da = mysql_fetch_array($ac))
		{
			echo "<option value='$da[0]'>$da[1]</option> ";
		}
		?>
		</select>
</tr>
<tr valign="top">
	<td width="140px" valign="middle">JABATAN DALAM TIM</td>
	<td></td>
	<td><input name="jabatan" type="text" size="40"></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN"> <input type="RESET" value="BATAL"></td>

</table>

<br/><br/>
<?php
if(mysql_num_rows($cz)==0)
	echo "<h5>*BELUM MEMILIH TIM PEMERIKSA</h5>";
else {
	$no=1;
echo '
	<legend>TIM PEMERIKSA</legend><br/>
	<table class="tblisi" border="0" width=100% cellspacing="0">
		<tr height="22px">
			<th>NO</th>
			<th>NAMA</th>
			<th>NIP</th>
			<th>PANGKAT</th>
			<th>GOLONGAN</th>
			<th>JABATAN</th>
			<th>HAPUS</th>
		</tr>';

	while($data=mysql_fetch_array($cz))
	{
	$nmpri=mysql_query("select * from user where id_user='$data[0]'");
	$rnmpri = mysql_fetch_array($nmpri);
	$nama=$rnmpri["nama"];
	$nip=$rnmpri["nip"];
	$pangkat=$rnmpri["pangkat"];
	$gol=$rnmpri["gol"];
	$id_tim=$data[2];
		echo"
			<tr>
				<td>$no</td>
				<td>$nama</td>
				<td>$nip</td>
				<td>$pangkat</td>
				<td>$gol</td>
				<td>$data[1]</td>
				<td><a href=./modules/kasilatih/tim_periksa/tim_validate.php?mode=2&link=$resi&id_user=$userid&id_tim=$id_tim>HAPUS</a></td>
			</tr>";
			$no++;	
	}
	echo "</table>
	</fieldset>";
	$onc="terima('".$userid."','spt','".$resi."')";
	$onc1="proses('".$userid."','".$resi."')";
	?>
    <center>
	<input type="button" onClick=<?php echo $onc;?> value="BUAT SURAT TUGAS">
    <input type="button" onClick=<?php echo $onc1;?> value="PROSES">
    </center>
    </form>
	<?php
}
?>
</fieldset><br/><br/>
</td>
	</tr>

 <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>