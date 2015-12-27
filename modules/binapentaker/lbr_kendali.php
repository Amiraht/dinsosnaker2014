<script type="text/javascript">
function Kirim_Cari1()
{
	var y = '<?php echo $_GET["cari"]; ?>';
	var s;
	s='./index.php?mod=loket&opt=lembar_kendali';
	if(y != '')
		s=s+'&cari='+y;
	s=s+'&halaman='+document.f2.halaman.value;
	document.location.href=s;
}

function edit_data(c)
{
		var t=document.getElementById("div_edit_"+c);
		if(t.innerHTML != ''){
			t.innerHTML = '';
		}
		else
			t.innerHTML='<iframe src="./modules/binapentaker/lembar_kendali/edit.php?link='+c+'" width="100%" style="height:300px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
		
}

function lihat_data(k)
{
		var t=document.getElementById("div_edit_"+k);
		if(t.innerHTML != ''){
			t.innerHTML = '';
		}
		else
			t.innerHTML='<iframe src="./modules/binapentaker/lembar_kendali/lihat.php?link='+k+'" width="100%" style="height:300px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
	
}
</script>
<table width="1024" border="0" cellspacing="0" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>LEMBAR KENDALI - KABID BINA PENTAKER</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=binapentaker&opt=main" id="linkutama"> BERANDA LOGIN KABIB BINA PENTAKER</a>
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
						onclick="document.location.href='./index.php?mod=binapentaker&opt=main'" 
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
					$d = mysql_query("select count(*) as jumlah from tbl_info_berkas where nama like '%".$_GET["cari"]."%' and jenis_pengurusan='".$_GET["jenis"]."'");
				}
		elseif(!empty($_GET["cari"]) )
				{
					$d = mysql_query("select count(*) as jumlah from tbl_info_berkas where nama like '%".$_GET["cari"]."%' ");
				}
		elseif($_GET["jenis"]!='0' and $_GET["jenis"] != '')
				{
					$d = mysql_query("select count(*) as jumlah from tbl_info_berkas where  jenis_pengurusan='".$_GET["jenis"]."'");
				}
				else
					$d = mysql_query("select count(*) as jumlah from tbl_info_berkas");
					
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
						$str = "SELECT 
									a.* , b.nama , b.alamat as alamat_usaha , c.jenis 
								FROM
									tbl_info_berkas a 
								LEFT JOIN vw_dinsos b ON a.id_perusahaan = b.id_perusahaan 
								LEFT JOIN tbl_jenis_pengurusan c ON a.jenis_pengurusan = c.kode 
                                WHERE 
									a.nama LIKE '%".$_GET['cari']."%' AND 
									a.jenis_pengurusan='".$_GET["jenis"]."'  
								LIMIT 
									 ".$posisi." , ".$batas." 				
						";
						
						$query = mysql_query($str) or die(mysql_error());
					}
				elseif(!empty($_GET["cari"]) )
					{
						$str = "SELECT 
									a.* , b.nama , b.alamat as alamat_usaha , c.jenis 
								FROM
									tbl_info_berkas a 
								LEFT JOIN vw_dinsos b ON a.id_perusahaan = b.id_perusahaan 
								LEFT JOIN tbl_jenis_pengurusan c ON a.jenis_pengurusan = c.kode 
                                WHERE 
									a.nama LIKE '%".$_GET['cari']."%'  
								LIMIT 
									 ".$posisi." , ".$batas." 				
						";
						
						$query = mysql_query($str) or die(mysql_error());
					}
				elseif($_GET["jenis"]!='0' and $_GET["jenis"] != '')
					{
						$str = "SELECT 
									a.* , b.nama , b.alamat as alamat_usaha , c.jenis 
								FROM
									tbl_info_berkas a 
								LEFT JOIN vw_dinsos b ON a.id_perusahaan = b.id_perusahaan 
								LEFT JOIN tbl_jenis_pengurusan c ON a.jenis_pengurusan = c.kode 
                                WHERE 
									a.jenis_pengurusan='".$_GET["jenis"]."'  
								LIMIT 
									 ".$posisi." , ".$batas." 				
						";
						
						$query = mysql_query($str) or die(mysql_error());
					}
					else
					{
						$str = "SELECT 
									a.* , b.nama , b.alamat as alamat_usaha , c.jenis 
								FROM
									tbl_info_berkas a 
								LEFT JOIN vw_dinsos b ON a.id_perusahaan = b.id_perusahaan 
								LEFT JOIN tbl_jenis_pengurusan c ON a.jenis_pengurusan = c.kode 
								LIMIT 
									 ".$posisi." , ".$batas." 				
						";
						
						$query = mysql_query($str) or die(mysql_error());
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
					$onc  = "edit_data('".$set['no_resi']."')";
					$onc2 = "lihat_data('".$set['no_resi']."')";
					echo "
							<tr>
								<td>",$no+$i,"</td>
								<td> ".$set['no_resi']."</td>";
							echo "<td>".tglindonesia($set['tgl_masuk'])."</td>";
							echo "<td>".$set['jenis']."</td>"; 
							echo "<td>".$set['nama']."</td>";
							echo "<td>".$set['pemohon']."</td>";
							echo "<td>".$set['alamat_usaha']."</td>";
							echo "<td>".$set['alamat_pemohon']."</td>"; 
					 echo "
							<td> <input type='button' value='EDIT' onClick=$onc></td>
							<td> <input type='button' value='LIHAT' onClick=$onc2></td>
						</tr>";
						$i++;
					echo "
					<tr>
						<td colspan='10'><div id='div_edit_".$set['no_resi']."'></div> <div id='div_lihat_".$set['no_resi']."'></div>
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