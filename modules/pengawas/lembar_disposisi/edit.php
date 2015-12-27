<?php
include "./libraries/dinsos.php";
$resi = $_GET["link"]; 
$q = mysql_query("select * from tbl_info_disposisi where no_resi = '$resi'");
$b = mysql_query("select id_proses_skrg from tbl_info_berkas where no_resi = '$resi'");
$bz = mysql_fetch_array($b);
$sta=$_GET["opts"];
$sblm=$bz[0];

	if($sta=='tolak')
	{
		$qry="select id_pengguna,id_proses_lanjutan from tbl_alur_baru where id_proses = '".$bz[0]."' and id_pengguna='12'";
	}
	else if($sta=='terima')
	{
		$qry="select id_pengguna,id_proses_lanjutan from tbl_alur_baru where id_proses = '".$bz[0]."' and id_pengguna='14'";
	}
	else
	{
	   $qry="select id_pengguna,id_proses_lanjutan from tbl_alur_baru where id_proses = '".$bz[0]."'";
	}
$cz = mysql_query($qry);
$userid=$_GET["id_user"];
?>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat; '> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>LEMBAR DISPOSISI</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=pengawas&opt=main" id="linkutama"> BERANDA LOGIN TIM PENGAWAS</a> 
                  <img src="./image/panah.gif"  /><a href="" id="linkutama">LEMBAR DISPOSISI</a>
                 </td>
                
            </tr>
        </table> 
    </div>
    </td>
</tr>
<!--
<tr>
<td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=pengawas&opt=main'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
</tr>-->
<tr>
	<td>
      
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
	<legend>LEMBAR DISPOSISI</legend>
    
    <table class="tblisi" border="1" cellpadding="0" cellspacing="0" align="center" width="100%">
        <tr align="center">
            <th height="20px">TANGGAL</th>
            <th>DARI</th>
            <th>LEVEL</th>
            <th>KEPADA</th>
            <th>LEVEL</th>
            <th>PESAN</th>
        </tr>
    <?php
    while($qz = mysql_fetch_array($q))
    {
            $nmpri=mysql_query("select nama from user where id_user='".$qz["dari"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $dari=$rnmpri["nama"];
            
            $nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$qz["dari_level"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $dari_level=$rnmpri["nama_level"];
            
            $nmpri=mysql_query("select nama from user where id_user='".$qz["tujuan"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $tujuan=$rnmpri["nama"];
            
            $nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$qz["tujuan_level"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $tujuan_level=$rnmpri["nama_level"];
    
    
    ?>
        <tr >
            <td><?php echo tgl_indo($qz["tgl"]); ?></td>
            <td><?php echo $dari; ?></td>
            <td><?php echo $dari_level; ?></td>
            <td><?php echo $tujuan; ?></td>
            <td><?php echo $tujuan_level; ?></td>
            <td><?php echo $qz["pesan"]; ?></td>
        </tr>
    <?php
    }
    ?>
    </table> 
    <br />
    <br /> 
    
<form action="./modules/pengawas/lembar_disposisi/disposisi_validate.php?link=<?php echo $resi; ?>&id_user=<?php echo $userid; ?>&status=<?php echo $sta; ?>" method="POST">
<table>
<tr>
	<td>DISPOSISI
	<td width="40"> :<input type="hidden" name="sblm" value=<?php echo $bz[0];?> />
	<td> 
		<select name="tujuan">
		<?php
		while($set = mysql_fetch_array($cz))
		{
		$rt = "select id_user,nama,level from user where level = '$set[0]'";
		$ac = mysql_query($rt);
		while($da = mysql_fetch_array($ac))
			{
				echo "<option value='$da[0]'>$da[1]</option> ";
			}
		}
		?>
		</select>
</tr>
<tr valign="top">
	<td>ISI PESAN
	<td width = "40"> :
	<td>
		<textarea name="pesan" cols="40" rows="7" style="font-family:verdana;font-size:12px">ISI PESAN</textarea>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" value="SIMPAN"> <input type="RESET" value="BATAL"></td>

</table>
</form>
</fieldset>
</td>
	</tr>

 <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>