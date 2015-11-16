<?php
//include "../../../libraries/dinsos.php";
$resi = $_GET["link"]; 
$b = mysql_query("select * from tbl_info_disposisi where no_resi = '$resi'");
/*function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = substr($tgl,5,2);
			$tahun = substr($tgl,0,4);
			return $tanggal.'-'.$bulan.'-'.$tahun;		 
	}
	*/
?>
<table width="1024" border="0" cellspacing="0" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>LEMBAR KENDALI</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
                  <img src="./image/panah.gif"  /><a href="./index.php?mod=kasiwasnaker&opt=main" id="linkutama">BERANDA LOGIN KASI WASNAKER</a>
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=kasiwasnaker&opt=lembar_kendali" id="linkutama">LEMBAR KENDALI</a> 
                  <img src="./image/panah.gif"  /><a href="" id="linkutama">LEMBAR KENDALI DETAIL</a> 
                 </td>
                
            </tr>
        </table>
    </div>
    </td>
</tr>
<tr>
<td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=kasiwasnaker&opt=lembar_kendali'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
</tr>
	<tr>
		<td>
        <fieldset>
            <legend>LEMBAR KENDALI DETAIL</legend>	
<form action="./modules/kasiwasnaker/lembar_kendali/cetak_disposisi.php?link=<?php echo $resi; ?>" method="POST">
<table class="tblisi" border="1" cellpadding="0" cellspacing="0" align="center" width="100%">
    <tr align="center">
        <th height="21px">TANGGAL</th>
        <th>DARI</th>
        <th>LEVEL</th>
        <th>KEPADA</th>
        <th>LEVEL</th>
        <th>PESAN</th>
    </tr>
<?php
while($bz = mysql_fetch_array($b))
{
		$nmpri=mysql_query("select nama from user where id_user='".$bz["dari"]."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$dari=$rnmpri["nama"];
		
		$nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$bz["dari_level"]."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$dari_level=$rnmpri["nama_level"];
		
		$nmpri=mysql_query("select nama from user where id_user='".$bz["tujuan"]."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$tujuan=$rnmpri["nama"];
		
		$nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$bz["tujuan_level"]."'");
		$rnmpri = mysql_fetch_array($nmpri);
		$tujuan_level=$rnmpri["nama_level"];


?>
    <tr>
        <td><?php echo tgl_indo($bz["tgl"]); ?></td>
        <td><?php echo $dari; ?></td>
        <td><?php echo $dari_level; ?></td>
        <td><?php echo $tujuan; ?></td>
        <td><?php echo $tujuan_level; ?></td>
        <td><?php echo $bz["pesan"]; ?></td>
    </tr>
<?php
}
?>
<tr>
	<td colspan="6"><input type="submit" value="CETAK"></td>
</tr>
</table>
</form>
</fieldset>
</td>
 <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>	