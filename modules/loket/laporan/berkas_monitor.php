<script type="text/javascript">
	function gocetak(a){
		var x ='./index.php?mod=loket&opt=berkas_monitor';
		var c = x+"&opts=cetak&id="+a;
		window.open(c);
	}
	function Kirim_Cari()
	{
		var y ='<?php echo $_GET["halaman"]; ?>';
		var s;
		s='./index.php?mod=loket&opt=berkas_monitor';
		//s='agenda_masuk.php?opts=view';
		if(y>1)
			s=s+'&halaman=1';
		if (document.fcari.no_resi.value!='')
		{
			s=s+'&no_resi='+document.fcari.no_resi.value;
		}		
		document.location.href=s;
	}
	function Kirim_Cari1()
	{
		var no_resi ='<?php echo $_GET["no_resi"]; ?>';
		var s;
		s='./index.php?mod=loket&opt=berkas_monitor';
		//s='agenda_masuk.php?opts=view';
		if(no_resi != '')
			s=s+'&no_resi='+no_resi;		
		s=s+'&halaman='+document.f2.halaman.value;		
		document.location.href=s;
	}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>LIHAT PROSES PENGURUSAN</a></b></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <a href='index.php?mod=loket&opt=laporan'> <span></span> LAPORAN-LAPORAN </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span><a href='#'>LIHAT PROSES PENGURUSAN</a>
                   </td>
                
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
 <td style="float:right; padding-right:10px;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=laporan'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
</tr>
<tr><td>&nbsp; </td></tr>
<tr>
	<td>
        <div id='content' style='margin-left:2%;margin-bottom:20px;width:97%;'>
        <fieldset>
            <legend>FILTER</legend>
        <form method="POST" name="fcari">
        <table border="0">
             <tr><td>NOMOR RESI</td>   
            	<td><input class ='filter' type='text' name='no_resi' id='no_resi' placeholder='No Resi'></td></tr>
            <tr><td></td>    
            	<td><input type='button' value='CARI' onclick="Kirim_Cari();"></br></td></tr></table>
        </form>
        </fieldset>
		<fieldset>
		<legend>DATA HASIL</legend>
        <table border='1' class='tblisi' cellspacing='1' cellpadding='5' align='center'>
	<?php
	
	if(!empty($_GET["no_resi"]))
	{
		$up = '';
		$ada = 1;
		if(!empty($_GET["no_resi"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." no_resi like '".$_GET["no_resi"]."'";
			$ada++;
		}
	}

	
	if(!empty($_GET["no_resi"]))
	{
		$d = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon,id_proses_skrg from vw_info_berkas where id is not null and ".$up."");
												

		if(mysql_num_rows($d) == '')
		{
			echo "<b>DATA TIDAK DITEMUKAN</b>";
		}					
		$i=1;
				
		$set = mysql_fetch_array($d);
		
		$q=mysql_query("select id_kegiatan from tbl_alur_baru where id_proses='".$set[7]."'");
		$posisi=mysql_fetch_array($q);
		
		
		
		echo '</table><br><br>';
		echo '<table>'; 
		echo '<tr height=28px><td>NOMOR RESI</td><td>:</td><td>'.$set[0].'</td></tr>' ;
		echo '<tr height=28px><td>JENIS PENGURUSAN</td><td>:</td><td>'.$set[2].'</td></tr>' ;
		echo '<tr height=28px><td>PERUSAHAAN</td><td>:</td><td>'.$set[3].'</td></tr>' ;
		echo '<tr height=28px><td>POSISI BERKAS</td><td>:</td><td>'.$posisi[0].'</td></tr>' ;
		echo '<table>';
	}
	else
	echo 'MASUKKAN RESI PENCARIAN !';
?>
</table>
</fieldset></div>
</td>
	</tr>

 <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>			