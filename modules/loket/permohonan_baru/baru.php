<?php
	// cek terlebih dahulu mode yang ada jika tidak 
	// maka tidak melakukan apa apa, jika ada maka data
	// yang sebelumnya terinputkan akan dihapuskan dari tabel lagi..
	
	if(isset($_GET['dt']) && isset($_GET['num'])){
		
		if($_GET['dt'] == "react"){
				$no_resi = base64_decode(base64_decode(base64_decode(base64_decode($_GET['num']))));
				mysql_query("DELETE FROM tbl_info_berkas WHERE no_resi = '".$no_resi."'");
				mysql_query("DELETE FROM tbl_berkas_pengaduan WHERE no_resi = '".$no_resi."'");
		}
	}
?>
<script type="text/javascript">
	function Kirim_Cari()
	{
		var y ='<?php echo $_GET["halaman"]; ?>';
		var s;
		s='./index.php?mod=loket&opt=proses_permohonan&opts=baru';
		//s='agenda_masuk.php?opts=view';
		if(y > 1)
			s=s+'&halaman=1';
		if (document.fcari.cari.value!='')
		{
			s=s+'&cari='+document.fcari.cari.value;
		}
		document.location.href=s;
	}
	function Kirim_Cari1()
	{
		var cari ='<?php echo $_GET["cari"]; ?>';

		var s;
		s='./index.php?mod=loket&opt=proses_permohonan&opts=baru';
		//s='agenda_masuk.php?opts=view';
		if(cari != '')
			s=s+'&cari='+cari;
		s=s+'&halaman='+document.f2.halaman.value;
		document.location.href=s;
	}

	function nextMo()
	{
		var temp=document.getElementsByName('id_a');
		var s='./index.php?mod=loket&opt=proses_permohonan&opts=';
			x=s+'baru_wl';
			y=s+'baru_imta';
			z=s+'baru_pengaduan';
			x1=s+'baru_janji';
			y1=s+'baru_sah';
			z1=s+'baru_iplk';
		var ax=temp.length;
		for(var j=0; j<ax; j++){
			if(temp[j].checked){
				var val = temp[j].value;
				document.getElementById("l1").href=x+"&id="+val;
				document.getElementById("l2").href=y+"&id="+val;
				document.getElementById("l3").href=z+"&id="+val;
				document.getElementById("l4").href=x1+"&id="+val;
				document.getElementById("l5").href=y1+"&id="+val;
				document.getElementById("l6").href=z1+"&id="+val;
			}
		}		
	}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>PROSES PERMOHONAN BARU</b></a></td>
            </tr>
            <tr>
            	 <td colspan='2' style="text-align:left; padding-left:10px; border-left:0px solid black;">
				 <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
				 <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a> 
				 <img src="./image/panah.gif"  /><span id="linkutama">PROSES PERMOHONAN BARU</span>
                 </td>
                
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
			<td style="float:right;" >
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=proses_permohonan'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
                    &nbsp;&nbsp;
    			</td>
               
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
	<td>
	<div id='content' style='margin-left:2%;margin-bottom:20px;width:97%;'>
			<fieldset>
                <legend>FILTER</legend>
			<form method="POST" name="fcari">
				<table width="100%" border="0" cellpadding="3">
                <tr>
                    <td width="120">Nama Perusahaan</td>
                    <td><input class ='filter' type='text' name='cari' id='cari' placeholder='Cari Perusahaan'></td></tr>
                <tr>
                <td></td>
                <td><input type='button' value='CARI' onclick="Kirim_Cari();"></td>
                </tr>
				</table>
			</form>
			</fieldset>
			<fieldset>
                <legend>PROSES PERMOHONAN BARU</legend>
				<span style='font-family:verdana;font-size:14px;margin-top:12px;margin-bottom:15px;color:green;'>
					*)Untuk melakukan proses permohonan baru, pilih data perusahaan pada daftar di bawah ini, dan
					centang pada <i>check box</i> pilih, setelah itu klik beberapa jenis 
					pengurusan yang ada pada bagian bawah tabel.
				</span><br/><br/>
				<?php
				if(!empty($_GET["cari"]))
				{
					$d = mysql_query("select count(*) as jumlah from db_dinsos where nama like '%".$_GET["cari"]."%'");
				}
				else
					$d = mysql_query("select count(*) as jumlah from db_dinsos");
					
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
				if(isset($_GET["cari"]))
					{
						echo "<style>p{text-align:left; font-size:12px;}</style><p>HASIL PENCARIAN UNTUK PERUSAHAAN ".$_GET["cari"]." <br>";

						$query = mysql_query("select * from db_dinsos a LEFT JOIN t_jenis_usaha b ON a.jenis_usaha=b.id_jenis_usaha where nama like '%".$_GET["cari"]."%'");
						}
					else
						{
							$query = mysql_query("select * from db_dinsos a LEFT JOIN t_jenis_usaha b ON a.jenis_usaha=b.id_jenis_usaha LIMIT ".$posisi.",".$batas."");
						}
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
				<table border="1" class="tblisi" id="tblisi" style='width:100%; margin-bottom:10px;'>
					<tr>
						<th height="20px">NO</th>
						<th>NAMA PERUSAHAAN</th>
						<th>JENIS PERUSAHAAN</th>
						<th>TELEPON</th>
						<th>ALAMAT</th>
						<th>PILIH</th>
					</tr>
				<?php 
					if(mysql_num_rows($query) == '')
					{
						echo "<tr colspan='7'>
								<td>DATA TIDAK DITEMUKAN</td>
							</tr>";
					}					
						$i=1;
						
						while($set = mysql_fetch_array($query))
						{
						$onc='onChange="javascript:nextMo();"';
							$no=0;
							if($halaman>1)
							{
								$no=($halaman-1)*20;
							}
						echo "
						<tr>
							<td align='center'>",$no+$i," </td>
							<td> $set[1] </td>
							<td> $set[19] </td>
							<td> $set[5] </td>
							<td> $set[2]</td>
							<td align='center'> <input type='radio' value='$set[0]' name='id_a' id='$i' ".$onc.">
						";
						$i++;
						}
					?>
				</table>
		
				<div align="center">
                <ul>
					<li>&nbsp;<a href="" id="l1" ><img src="./././image/button/proseswajinlapor.jpg"/></a></li>
                    <li>&nbsp;<a href="" id="l2" ><img src="./././image/button/prosesimta.jpg"/></a></li>
                    <li>&nbsp;<a href="" id="l3" ><img src="./././image/button/prosespengaduan.jpg"/></a></li>
                    <li>&nbsp;<a href="" id="l4" ><img src="./././image/button/prosesjanji.jpg"/></a></li>
                    <li>&nbsp;<a href="" id="l5" ><img src="./././image/button/prosesah.jpg"/></a></li>
                    <li>&nbsp;<a href="" id="l6" ><img src="./././image/button/prosesijin.jpg"/></a></li>
               </ul>               
				</div>
        </fieldset>
	</td>
</tr>
  <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>