<script type="text/javascript">
      $(document).ready(function(){
        $("#tgl1").datepicker({
					dateFormat  : "yy-mm-dd",        
          changeMonth : true,
          changeYear  : true					
        });
        $("#tgl2").datepicker({
					dateFormat  : "yy-mm-dd",        
          changeMonth : true,
          changeYear  : true					
        });
		});
</script>
<script type="text/javascript">
	function gocetak(a){
		var x ='./index.php?mod=loket&opt=wl_lap';
		var c = x+"&opts=cetak&id="+a;
		window.open(c);
	}
	function Kirim_Cari()
	{
		var y ='<?php echo $_GET["halaman"]; ?>';
		var s;
		s='./index.php?mod=loket&opt=wl_lap';
		//s='agenda_masuk.php?opts=view';
		if(y>1)
			s=s+'&halaman=1';
		if (document.fcari.tgl1.value!='')
		{
			s=s+'&tgl1='+document.fcari.tgl1.value;
		}
		if (document.fcari.tgl2.value!='')
		{
			s=s+'&tgl2='+document.fcari.tgl2.value;
		}			
		if (document.fcari.cari.value!='')
		{
			s=s+'&cari='+document.fcari.cari.value;
		}
		if (document.fcari.no_resi.value!='')
		{
			s=s+'&no_resi='+document.fcari.no_resi.value;
		}				
		if (document.fcari.rekap.value!='')
		{
			s=s+'&rekap='+document.fcari.rekap.value;
		}		
		document.location.href=s;
	}
	function Kirim_Cari1()
	{
		var tgl1 ='<?php echo $_GET["tgl1"]; ?>';
		var tgl2 ='<?php echo $_GET["tgl2"]; ?>';	
		var cari ='<?php echo $_GET["cari"]; ?>';
		var no_resi ='<?php echo $_GET["no_resi"]; ?>';	
		var rekap ='<?php echo $_GET["rekap"]; ?>';
		var s;
		s='./index.php?mod=loket&opt=wl_lap';
		//s='agenda_masuk.php?opts=view';
		if(tgl1 != '')
			s=s+'&tgl1='+tgl1;
		if(tgl2 != '')
			s=s+'&tgl2='+tgl2;		
		if(cari != '')
			s=s+'&cari='+cari;
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
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>LAPORAN SK WAJIB LAPOR</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <a href='index.php?mod=loket&opt=laporan'> <span></span> LAPORAN-LAPORAN </a>
                     <span> </span> <img src="./image/panah.gif" /> <span> </span><a href='#'>LAPORAN SK WAJIB LAPOR</a>
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
            <tr>
            	<td width="160">NAMA PERUSAHAAN</td>
            	<td><input class ='filter' type='text' name='cari' id='cari' placeholder='Nama'></td></tr>
             <tr><td>NOMOR RESI</td>   
            	<td><input class ='filter' type='text' name='no_resi' id='no_resi' placeholder='No Resi'></td></tr>
             <tr><td>TANGGAL MASUK</td>
                <td><input type="text" name="tgl1" id="tgl1" size="12" readonly="readonly"/>&nbsp;
                    s.d&nbsp;<input type="text" name="tgl2" id="tgl2" size="12" readonly="readonly"/></td></tr>
            <tr><td></td>    
            	<td><input type='button' value='CARI' onclick="Kirim_Cari();"></br></td></tr></table>
        </form>
        </fieldset>
		<fieldset>
		<legend>DATA HASIL</legend>
	<?php
	
	if(!empty($_GET["tgl1"]) || !empty($_GET["tgl2"]) || !empty($_GET["cari"]) || !empty($_GET["no_resi"]))
	{
		$up = '';
		$ada = 1;
		if(!empty($_GET["tgl1"]) || !empty($_GET["tgl2"]))
		{
			if($ada > 1){
				$up = $up." and ";
				}
			$up = $up." tgl_masuk>='".$_GET["tgl1"]."' and tgl_masuk<='".$_GET["tgl2"]."' ";
			$ada++;
		}		
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
	}

	if(!empty($_GET["tgl1"]) || !empty($_GET["tgl2"]) || !empty($_GET["cari"]) || !empty($_GET["no_resi"]))
	{
		$d = mysql_query("select count(*) as jumlah from vw_sk_wl where  nama is not null  and ".$up."");
	}
	else
	{
		$d = mysql_query("select count(*) as jumlah from vw_sk_wl where nama is not null");
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
	#$jmlsetoran = $d1["setoran"];
	$jmlhal  = ceil($jmldata/$batas);
				
				

	if(!empty($_GET["tgl1"]) || !empty($_GET["tgl2"]) || !empty($_GET["cari"]) || !empty($_GET["no_resi"]))
	{
		$query = mysql_query("select no_resi,tgl_masuk,nama,alamat,no_sk,berlaku,sampai from vw_sk_wl where nama is not null and ".$up." LIMIT ".$posisi.",".$batas."");
	}
	else
	{						
		$query = mysql_query("select no_resi,tgl_masuk,nama,alamat,no_sk,berlaku,sampai from vw_sk_wl where nama is not null LIMIT ".$posisi.",".$batas."");
	}						

	if($_GET["rekap"]==1)
	{
		echo 'HASIL REKAPITULASI = '.$jmldata ;
		#echo '<br><br>TOTAL SETORAN = '.$jmlsetoran ;
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
    <a href="./modules/loket/laporan/wl_lap_cetak.php?mode=1&tgl1=<?php echo $_GET["tgl1"]; ?>&tgl2=<?php echo $_GET["tgl2"]; ?>&cari=<?php echo $_GET["cari"]; ?>&no_resi=<?php echo $_GET["no_resi"]; ?>&pengurusan=<?php echo $_GET["pengurusan"]; ?>" target="_blank" style="border:none"><img src="./image/printer.png" width="35" height="35" border="0" title="Export to Excel"/></a><br /><br />       
        <table border='1' class='tblisi' cellspacing='1' cellpadding='5' align='center'>
                <tr>
                    <th height="28">NO</th>
                    <th>NO RESI</th>
                    <th>TANGGAL MASUK</th>
                    <th>NAMA PERUSAHAAN</th>
                    <th>ALAMAT</th>
                    <th>NO SK WAJIB LAPOR</th>
                    <th>TANGGAL SK WAJIB LAPOR</th>
                    <th>TANGGAL BERAKHIR</th>
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
					#$med=mysql_query("select hasil_mediasi from tbl_berkas_pengaduan where no_resi='".$set[0]."'");
					#$hsl=mysql_fetch_array($med);
					
					#$med1=mysql_query("select hasil_mediasi from tbl_hasil_mediasi where id_hasil='".$hsl[0]."'");
					#$hsl1=mysql_fetch_array($med1);
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