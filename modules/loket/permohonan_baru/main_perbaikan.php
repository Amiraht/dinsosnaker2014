<?php //echo $_SESSION["id_user"];?>
<script type="text/javascript">

function Kirim_Cari1()
{
	var cari ='<?php echo $_GET["cari"]; ?>';

	var s;
	s='./index.php?mod=loket&opt=proses_permohonan&opts=perbaikan';
	//s='agenda_masuk.php?opts=view';
	if(cari != '')
		s=s+'&cari='+cari;
	s=s+'&halaman='+document.f2.halaman.value;
	document.location.href=s;
}

function kirim_edit(no_resi)
{
	var s;
	s='./index.php?mod=loket&opt=proses_permohonan&opts=perbaikan_berkas';
	if(no_resi != '')
	s=s+'&no_resi='+no_resi;
	document.location.href=s;
} 
function edit_data(c,uid)
{
		var t=document.getElementById("div_edit_"+c);
		if(t.innerHTML != ''){
			t.innerHTML = '';
		}
		else
			t.innerHTML='<iframe src="./modules/loket/lembar_kendali/edit.php?link='+c+'&id_user='+uid+'" width="100%" style="height:300px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
		
}

function lihat_data(k,uid)
{
		var t=document.getElementById("div_edit_"+k);
		if(t.innerHTML != ''){
			t.innerHTML = '';
		}
		else
			t.innerHTML='<iframe src="./modules/loket/lembar_kendali/lihat.php?link='+k+'&id_user='+uid+'" width="100%" style="height:300px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
	
}
</script>
<table width="1024" border="0" cellspacing="0" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#"><b>DATA UNTUK PROSES PERBAIKAN	</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				 <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
				 <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a> 
				 <img src="./image/panah.gif"  /><span id="linkutama">DATA UNTUK PROSES PERBAIKAN	</span>
                 </td>
                
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr><td style="float:right; padding-right:10px;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=proses_permohonan'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
	<tr>
		<td>
         <div id='content' style='margin-left:2%;margin-bottom:20px;width:97%;'>
            <fieldset>
            <legend id="linkutama1">DATA UNTUK PROSES PERBAIKAN	</legend>
        <?php
		if(isset($_GET['ract']) && $_GET['ract'] == "flush"){
			
		}
		
		if(!empty($_GET["cari"]))
				{
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas where nama like '%".$_GET["cari"]."%' and id_proses_skrg in('11','12')");
				}
				else
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas where id_proses_skrg in('11','12')");		
					
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
						$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas where nama like '%".$_GET["cari"]."%' and id_proses_skrg in('11','12') LIMIT ".$posisi.",".$batas."");
						}
					else
						{
					$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas  where id_proses_skrg in('11','12') LIMIT ".$posisi.",".$batas."");
					}						
				echo '<form name=f2><span id="text">';
				echo '<span style=font-family:verdana;font-size:12px> Halaman: <select name=halaman onchange="Kirim_Cari1();">';
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
       
				<table width="100%" class="tblisi" border="1" cellpadding="0" cellspacing="0" align="center">
				<tr align="center">
					<th height="29">NO</th>
					<th>NOMOR RESI</th>
					<th>TANGGAL MASUK</th>
					<th>JENIS PENGURUSAN</th>
					<th>PERUSAHAAN</th>
					<th>PEMOHON</th>
					<th>ALAMAT PERUSAHAAN</th>
					<th>ALAMAT PEMOHON</td>
					<th colspan="2">AKTIFITAS</th>
				</tr>
                
                
                
				<?php 
					if(mysql_num_rows($query) == '')
						{
						echo "<tr>
								<td  colspan='9'>DATA TIDAK DITEMUKAN</td>
							</tr>";
						}					
					$i=1;
						
					while($set = mysql_fetch_array($query))
					{
					$onc1  = "kirim_edit('".$set[0]."')";
					$onc  = "edit_data('".$set[0]."','".$_SESSION["id_user"]."')";
					$onc2 = "lihat_data('".$set[0]."','".$_SESSION["id_user"]."')";
					$no=0;
					if($halaman>1)
					{
						$no=($halaman-1)*20;
					}
					echo "<tr>					
							<td align='center'> ",$no+$i," </td>
							<td align='center'> $set[0]</td>";
					echo "<td> $set[1]</td>";
					echo "<td> $set[2]</td>"; 
					echo "<td> $set[3]</td>";
					echo "<td> $set[4]</td>";
					echo "<td> $set[5]</td>";
					echo "<td> $set[6]</td>"; 
					echo "<td align='center'><input type='button' value='PERBAIKI' onClick=$onc1></td>
					</tr>";
						$i++;
					echo "
					<tr>
						<td colspan='10'><div id='div_edit_$set[0]'></div> <div id='div_lihat_$set[0]'></div>
					</tr>
					";
					}
					?>
				</table>
            </fieldset>
		 </td>
 <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>	