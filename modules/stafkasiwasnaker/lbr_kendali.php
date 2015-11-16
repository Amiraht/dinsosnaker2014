<?php //echo $_SESSION["id_user"];?>
<script type="text/javascript">
	function Kirim_Cari()
	{
		var y ='<?php echo $_GET["halaman"]; ?>';
		var s;
		s='./index.php?mod=stafkasiwasnaker&opt=lembar_kendali';
		//s='agenda_masuk.php?opts=view';
		if(y>1)
			s=s+'&halaman=1';
		if (document.fcari.cari.value!='')
		{
			s=s+'&cari='+document.fcari.cari.value;
		}
		if (document.fcari.jenis.value!='')
		{
			s=s+'&jenis='+document.fcari.jenis.value;
		}		
		document.location.href=s;
	}
	function Kirim_Cari1()
	{
		var cari ='<?php echo $_GET["cari"]; ?>';
		var jenis ='<?php echo $_GET["jenis"]; ?>';

		var s;
		s='./index.php?mod=stafkasiwasnaker&opt=lembar_kendali';
		//s='agenda_masuk.php?opts=view';
		if(cari != '')
			s=s+'&cari='+cari;
		if(jenis != '')
			s=s+'&jenis='+jenis;			
		s=s+'&halaman='+document.f2.halaman.value;
		document.location.href=s;
	}
	
	function edit_data(c,uid)
	{
			var t=document.getElementById("div_edit_"+c);
			if(t.innerHTML != ''){
				t.innerHTML = '';
			}
			else
				t.innerHTML='<iframe src="./modules/stafkasiwasnaker/lembar_kendali/edit.php?link='+c+'&id_user='+uid+'" width="100%" style="height:300px" frameborder="0" scrolling="yes" id="iframe_detail"></iframe>';
			
	}
	
	
	function lihat_kendali(k,uid)
	{
		var s;
		s='./index.php?mod=stafkasiwasnaker&opt=lihat_kendali';
		if(k != '')
		s=s+'&link='+k;
		if(uid != '')
		s=s+'&id_user='+uid;
		
		document.location.href=s;
	} 
		
	function lihat_data(k,uid)
	{
			var t=document.getElementById("div_edit_"+k);
			if(t.innerHTML != ''){
				t.innerHTML = '';
			}
			else
				t.innerHTML='<iframe src="./modules/stafkasiwasnaker/lembar_kendali/lihat.php?link='+k+'&id_user='+uid+'" width="100%" style="height:300px" frameborder="0" scrolling="yes" id="iframe_detail"></iframe>';
		
	}
</script>
<table width="1024" border="0" cellspacing="0" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>LEMBAR KENDALI</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
                  <img src="./image/panah.gif"  /><a href="./index.php?mod=stafkasiwasnaker&opt=main" id="linkutama">BERANDA LOGIN STAF KASI WASNAKER</a>
				  <img src="./image/panah.gif"  /><a href="" id="linkutama">LEMBAR KENDALI</a> 
                 </td>
                
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
<td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=stafkasiwasnaker&opt=main'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
        <div id='content' style='margin-left:2%;margin-bottom:20px;width:98%;'>
        <fieldset>
            <legend>FILTER</legend>
            <form method="POST" name="fcari">
            <table><tr>
            	<td width="120">Nama Perusahaan</td>
                <td><input class ='filter' type='text' name='cari' id='cari' placeholder='Cari Perusahaan'></td>
                </tr>
                <tr>
                <td>Jenis Pengurusan</td>
                <td> 
             		<select name="jenis">
            <option value='0'>SEMUA PENGURUSAN</option>
			<?php
            	$a=mysql_query("select * from tbl_pengurusan");
				while($a1 = mysql_fetch_array($a))
				{echo"<option value='$a1[0]'>$a1[1]</option>";};
            ?>
            </select></td></tr>
            <tr><td></td><td>
            <input type='button' value='CARI' onclick="Kirim_Cari();"></br></td></tr></table>
            </form>
        </fieldset>
        <fieldset>
        <legend>LEMBAR KENDALI</legend>   
        <?php
		if(!empty($_GET["cari"]) and $_GET["jenis"]!='0')
				{
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas where nama like '%".$_GET["cari"]."%' and jenis_pengurusan='".$_GET["jenis"]."'");
				}
		elseif(!empty($_GET["cari"]) )
				{
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas where nama like '%".$_GET["cari"]."%' ");
				}
		elseif($_GET["jenis"]!='0'  and $_GET["jenis"] != '')
				{
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas where  jenis_pengurusan='".$_GET["jenis"]."'");
				}
				else
					$d = mysql_query("select count(*) as jumlah from vw_info_berkas");
					
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
				if(!empty($_GET["cari"]) and $_GET["jenis"]!='0')
					{
						$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas where nama like '%".$_GET["cari"]."%' and jenis_pengurusan='".$_GET["jenis"]."' LIMIT ".$posisi.",".$batas."");
						}
				elseif(!empty($_GET["cari"]) )
					{
						$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas where nama like '%".$_GET["cari"]."%' LIMIT ".$posisi.",".$batas."");
						}
				elseif($_GET["jenis"]!='0' and $_GET["jenis"] != '')
					{
						$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas where  jenis_pengurusan='".$_GET["jenis"]."' LIMIT ".$posisi.",".$batas."");
						}
					else
						{
					$query = mysql_query("select no_resi,tgl_masuk,pengurusan,nama,pemohon,alamat,alamat_pemohon from vw_info_berkas LIMIT ".$posisi.",".$batas."");
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

				<table class="tblisi" border="1" cellpadding="0" cellspacing="0" align="center" width="100%">
				<tr align="center">
					<th height="30px">NO</th>
					<th>NOMOR RESI</th>
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
						echo "<tr>
								<td  colspan='9'>DATA TIDAK DITEMUKAN</td>
							</tr>";
						}					
					$i=1;
						
					while($set = mysql_fetch_array($query))
					{
					$onc  = "edit_data('".$set[0]."','".$_SESSION["id_user"]."')";
					$onc2 = "lihat_data('".$set[0]."','".$_SESSION["id_user"]."')";
					$onc3 = "lihat_kendali('".$set[0]."','".$_SESSION["id_user"]."')";
					$no=0;
					if($halaman>1)
					{
						$no=($halaman-1)*20;
					}
					echo "<tr>					
							<td> ",$no+$i," </td>
							<td> $set[0]</td>";
					echo "<td> $set[1]</td>";
					echo "<td> $set[2]</td>"; 
					echo "<td> $set[3]</td>";
					echo "<td> $set[4]</td>";
					echo "<td> $set[5]</td>";
					echo "<td> $set[6]</td>"; 
					echo "<td align=center><input type='button' value='LIHAT' onClick=$onc3></td>
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