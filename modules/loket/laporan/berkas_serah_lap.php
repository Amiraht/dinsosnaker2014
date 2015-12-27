<script type="text/javascript">
	function gocetak(a){
		var x ='./index.php?mod=loket&opt=berkas_serah_lap';
		var c = x+"&opts=cetak&id="+a;
		window.open(c);
	}
	function Kirim_Cari()
	{
		var y ='<?php echo $_GET["halaman"]; ?>';
		var s;
		s='./index.php?mod=loket&opt=berkas_serah_lap';
		//s='agenda_masuk.php?opts=view';
		if(y>1)
			s=s+'&halaman=1';
		if (document.fcari.cari.value!='')
		{
			s=s+'&cari='+document.fcari.cari.value;
		}
		if (document.fcari.no_resi.value!='')
		{
			s=s+'&no_resi='+document.fcari.no_resi.value;
		}	
		if (document.fcari.pengurusan.value!='0')
		{
			s=s+'&pengurusan='+document.fcari.pengurusan.value;
		}			
		if (document.fcari.rekap.value!='')
		{
			s=s+'&rekap='+document.fcari.rekap.value;
		}		
		document.location.href=s;
	}
	function Kirim_Cari1()
	{
		var cari ='<?php echo $_GET["cari"]; ?>';
		var no_resi ='<?php echo $_GET["no_resi"]; ?>';
		var pengurusan ='<?php echo $_GET["pengurusan"]; ?>';		
		var rekap ='<?php echo $_GET["rekap"]; ?>';
		var s;
		s='./index.php?mod=loket&opt=berkas_serah_lap';
		//s='agenda_masuk.php?opts=view';
		if(cari != '')
			s=s+'&cari='+cari;
		if(no_resi != '')
			s=s+'&no_resi='+no_resi;
		if(pengurusan != '0')
			s=s+'&pengurusan='+pengurusan;			
		s=s+'&halaman='+document.f2.halaman.value;		
		document.location.href=s;
	}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>LAPORAN BERKAS SELESAI BELUM DIAMBIL</a></b></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <a href='index.php?mod=loket&opt=laporan'> <span></span> LAPORAN-LAPORAN </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span><a href='#'>LAPORAN BERKAS SELESAI BELUM DIAMBIL</a>
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
            <tr><td width="160">JENIS LAPORAN</td>
            	<td><select name="rekap" id='rekap'>
                                            <option value="0">DETAIL</option>
                                            <option value="1">REKAPITULASI</option>
                                            </select></td></tr>  
            <tr><td width="160">JENIS PENGURUSAN</td>
            	<td><select name="pengurusan" id='pengurusan'>
                    <option value="0">SEMUA</option>                                            
                <?php
                $t = mysql_query("select * from tbl_pengurusan");
                while($t1 = mysql_fetch_array($t))
                {
                     echo '<option value="'.$t1["id_pengurusan"].'">'.$t1["pengurusan"].'</option>';
                }
                ?>       
                </select></td></tr>                                             
            <tr>
            	<td width="160">NAMA PERUSAHAAN</td>
            	<td><input class ='filter' type='text' name='cari' id='cari' placeholder='Nama nama'></td></tr>
             <tr><td>NOMOR RESI</td>   
            	<td><input class ='filter' type='text' name='no_resi' id='no_resi' placeholder='No Resi'></td></tr>
            <tr><td></td>    
            	<td><input type='button' value='CARI' onclick="Kirim_Cari();"></br></td></tr></table>
        </form>
        </fieldset>
		<fieldset>
		<legend>DATA HASIL</legend>
	<?php
	
	if(!empty($_GET["cari"]) || !empty($_GET["no_resi"]) || !empty($_GET["pengurusan"]))
	{
		$up = '';
		$ada = 1;
		if(!empty($_GET["cari"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." nama like '%".$_GET["cari"]."%'";
			$ada++;
		}
		if(!empty($_GET["no_resi"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." no_resi like '%".$_GET["no_resi"]."%'";
			$ada++;
		}
		if(!empty($_GET["pengurusan"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." id_pengurusan = '".$_GET["pengurusan"]."'";
			$ada++;
		}
	}

	
	if(!empty($_GET["cari"]) || !empty($_GET["no_resi"]) || !empty($_GET["pengurusan"]))
	{
		$d = mysql_query("select count(*) as jumlah from vw_info_berkas where id_proses_skrg in('13') and isDisposisi='0' and ".$up."");
	}
	else
	{
		$d = mysql_query("select count(*) as jumlah from vw_info_berkas where id_proses_skrg in('13') and isDisposisi='0'");
	}	
			


	$batas = 20;
	$halaman = $_GET["halaman"];
	
	if(empty($halaman))
	{
		$posisi = 0;
		$halaman = 1;
	}
	else
		$posisi = ($halaman - 1) * $batas;
	
	$d1 = mysql_fetch_array($d);			
	$jmldata = $d1["jumlah"];
	$jmlhal  = ceil($jmldata/$batas);
				
				

	if(!empty($_GET["cari"]) || !empty($_GET["no_resi"]) || !empty($_GET["pengurusan"]))
	{
		$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas where id_proses_skrg in('13') and isDisposisi='0' and ".$up." LIMIT ".$posisi.",".$batas."");
	}
	else
	{						
		$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas where id_proses_skrg in('13') and isDisposisi='0' LIMIT ".$posisi.",".$batas."");
	}						

	if($_GET["rekap"]==1)
	{
		echo 'HASIL REKAPITULASI = '.$jmldata ;
	}
	else
	{							
		echo '<form name=f2><span id="text">';
		echo '<span style=font-family:verdana;font-size:12px> Halaman: <select name=halaman onchange="javascript:Kirim_Cari1();">';
		echo '<option value="'.$halaman.'" selected="selected">'.$halaman.'</option>';
			for($i = 1; $i <= $jmlhal; $i++)
				if($i != $halaman)
				{
					echo '<option value='.$i.'>'.$i;		
				}
		echo '</option>';
		echo '</select>';
		echo ' dari '.$jmlhal.' Halaman</span>';
		echo "</span></form><br>";
						
	?>
    <a href="./modules/loket/laporan/berkas_serah_lap_cetak.php?mode=1&tgl1=<?php echo $_GET["tgl1"]; ?>&tgl2=<?php echo $_GET["tgl2"]; ?>&cari=<?php echo $_GET["cari"]; ?>&no_resi=<?php echo $_GET["no_resi"]; ?>&pengurusan=<?php echo $_GET["pengurusan"]; ?>" target="_blank" style="border:none"><img src="./image/printer.png" width="35" height="35" border="0" title="Export to Excel"/></a><br /><br />       
        <table border='1' class='tblisi' cellspacing='1' cellpadding='5' align='center'>
                <tr>
                    <th height="28">NO</th>
                    <th>NO RESI</th>
                    <th>TANGGAL MASUK</th>
                    <th>JENIS PENGURUSAN</th>
                    <th>PERUSAHAAN</th>
                    <th>PEMOHON</th>
                    <th>ALAMAT PERUSAHAAN</th>
                    <th>ALAMAT PEMOHON</th>
                </tr>
	<?php 
				if(mysql_num_rows($query) == '')
				{
					echo "<tr colspan='8'>
							<td>DATA TIDAK DITEMUKAN</td>
						 </tr>";
				}					
				$i=1;
						
				while($set = mysql_fetch_array($query))
				{
				$onc = "gocetak('".$set[0]."')";
				echo "
				<tr>
					<td>".($posisi+$i)."</td>
					<td> $set[0]</td>
					<td> $set[1]</td>
					<td> $set[2]</td>
					<td> $set[3]</td>
					<td> $set[4]</td>
					<td> $set[5]</td>
					<td> $set[6]</td>";
				$i++;
				}
	}
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