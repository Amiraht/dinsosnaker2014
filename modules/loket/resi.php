<?php
if($_GET["opts"] == '')
{
?>
<script type="text/javascript">
	function gocetak(a){
		var x ='./index.php?mod=loket&opt=print_resi';
		var c = x+"&opts=cetak&id="+a;
		window.open(c);
	}
	function Kirim_Cari()
	{
		var y ='<?php echo $_GET["halaman"]; ?>';
		var s;
		s='./index.php?mod=loket&opt=print_resi';
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
		document.location.href=s;
	}
	function Kirim_Cari1()
	{
		var cari ='<?php echo $_GET["cari"]; ?>';
		var no_resi ='<?php echo $_GET["no_resi"]; ?>';
		var s;
		s='./index.php?mod=loket&opt=print_resi';
		//s='agenda_masuk.php?opts=view';
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
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>PRINT ULANG RESI</a></b></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a>
                  <img src="./image/panah.gif"  /><a href="" id="linkutama"> PRINT ULANG RESI</a>
                   </td>
                
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
 <td style="float:right; padding-right:10px;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=main'" 
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
            <tr><td width="160">NAMA PEMOHON</td>
            	<td><input class ='filter' type='text' name='cari' id='cari' placeholder='Nama Pemohon'></td></tr>
             <tr><td>NOMOR RESI</td>   
            	<td><input class ='filter' type='text' name='no_resi' id='no_resi' placeholder='No Resi'></td></tr>
            <tr><td></td>    
            	<td><input type='button' value='CARI' onclick="Kirim_Cari();"></br></td></tr></table>
        </form>
        </fieldset>
		<fieldset>
		<legend>PRINT ULANG RESI</legend>
	<?php
			if(!empty($_GET["cari"]) and !empty($_GET["no_resi"]))
				{
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas 
											where pemohon like '%".$_GET["cari"]."%' and no_resi like '".$_GET["no_resi"]."' and isValid='1'");
				}
				elseif(!empty($_GET["cari"]))
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas where  isValid='1' and pemohon like '%".$_GET["cari"]."%'");
				elseif(!empty($_GET["no_resi"]))
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas where  isValid='1' and no_resi like '".$_GET["no_resi"]."'");
				else
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas where  isValid='1'");
			/*elseif(!empty($_GET["cari"]))
				{
				
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas 
											where pemohon like '%".$_GET["cari"]."%' and isValid='1'");
				}
			elseif(!empty($_GET["no_resi"]))
				{
				
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas 
											where no_resi like '%".$_GET["no_resi"]."%' and isValid='1'");
				}*/
					
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
				if(!empty($_GET["cari"]) and !empty($_GET["no_resi"]))
					{
						$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas									 
											where pemohon like '%".$_GET["cari"]."%' and no_resi like '%".$_GET["no_resi"]."%' and isValid='1' LIMIT ".$posisi.",".$batas."");
						}
						elseif(!empty($_GET["cari"]))
							$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas where  isValid='1' and pemohon like '%".$_GET["cari"]."%' LIMIT ".$posisi.",".$batas."");
						elseif(!empty($_GET["no_resi"]))
						{
							$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas where  isValid='1' and no_resi like '%".$_GET["no_resi"]."%' LIMIT ".$posisi.",".$batas."");
						}
						else
						{
						$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas									 
											where  isValid='1' LIMIT ".$posisi.",".$batas."");
						}
					/*elseif(isset($_GET["cari"]))
						{
							$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas
											WHERE  pemohon like '%".$_GET["cari"]."%' and isValid = '1'	LIMIT ".$posisi.",".$batas."");
						}
					elseif(isset($_GET["no_resi"]))
						{
							$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas
											WHERE no_resi like '".$_GET["no_resi"]."' and isValid = '1'	LIMIT ".$posisi.",".$batas."");
						}*/
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
						<th>AKTIVITAS</th>
					</tr>
				<?php 
						if(mysql_num_rows($query) == '')
						{
					echo "<tr colspan='9'>
							<td>DATA TIDAK DITEMUKAN</td>
						 </tr>";
					}					
						$i=1;
						
						while($set = mysql_fetch_array($query))
						{
						$onc = "gocetak('".$set[0]."')";
						echo "
						<tr>
							<td> $i </td>
							<td> $set[0]</td>
							<td> $set[1]</td>
							<td> $set[2]</td>
							<td> $set[3]</td>
							<td> $set[4]</td>
							<td> $set[5]</td>
							<td> $set[6]</td>";
					 echo "
							<td> <input type='button' value='CETAK' onClick=$onc></td>
						";
						$i++;
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
<?php
	}else	
		if($_GET["opts"] == 'cetak')
			//include('./modules/loket/resi/cetak.php');
			include('./modules/loket/resi/card/link.php');
		else if($_GET["opts"] == 'validasi')
			include('./modules/loket/resi/validasi.php');
		else
			die ("restricted access");
?>