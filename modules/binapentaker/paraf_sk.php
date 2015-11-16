<?php
if($_GET["opts"] == '')
{
?>
<script type="text/javascript">

function tampil(c)
{
		var t=document.getElementById("div_cek_"+c);
		if(t.innerHTML != ''){
			t.innerHTML = '';
		}
		else
			t.innerHTML='<iframe src="./modules/binapentaker/paraf_sk/tampil.php?link='+c+'" width="100%" style="height:200px" frameborder="0" scrolling="no" id="iframe_detail"></iframe>';
		
}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat; '> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>CEK BERKAS - KABID BINA PENTAKER</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=binapentaker&opt=main" id="linkutama"> BERANDA LOGIN KABID BINA PENTAKER</a>
                  <img src="./image/panah.gif"  /><a href="" id="linkutama"> CEK BERKAS </a>  
                 </td>
                
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr><td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=binapentaker&opt=main'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
	<td> 
    <div id='content' style='margin-left:2%;margin-bottom:20px;width:98%;'>
		<fieldset>
		<legend>CEK BERKAS</legend>
	<?php
			if(!empty($_POST["cari"]))
				{
					$d = mysql_query("select count(*) as jumlah from tbl_info_berkas where nama like '%".$_POST["cari"]."%'");
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
				if(isset($_POST["cari"]))
					{
						$query = mysql_query("select * from tbl_info_berkas LIMIT ".$posisi.",".$batas."");
						}
					else
						{
							$query = mysql_query("SELECT
												a.no_resi,
												b.tgl_masuk_berkas AS tgl_imta,
												c.tgl_masuk_berkas AS tgl_pengaduan,
												f.pengurusan,
												d.nama AS nama_perusahaan_imta, e.nama AS nama_perusahaan_pengaduan,
												b.nama_ta AS nama_imta, c.nama AS nama_pengaduan,
												b.alamat, c.alamat,
												d.alamat, e.alamat
											FROM
												tbl_info_berkas a
													LEFT JOIN tbl_berkas_imta b ON a.no_resi = b.no_resi
													LEFT JOIN tbl_berkas_pengaduan c ON a.no_resi = c.no_resi
													LEFT JOIN db_dinsos d ON b.id_perusahaan = d.id_perusahaan
													LEFT JOIN db_dinsos e ON c.id_perusahaan = e.id_perusahaan
													LEFT JOIN tbl_pengurusan f ON a.jenis_pengurusan = f.id_pengurusan
											WHERE		
												a.id_proses_skrg = '310' AND a.isDisposisi = '0'
											LIMIT ".$posisi.",".$batas."");
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
			<table border='1' class='tblisi' cellspacing="0" style='width:100%; margin-bottom:10px;'>
					<tr>
						<th  height="26px">NO</th>
						<th>NO RESI</th>
						<th>TANGGAL MASUK</th>
						<th>JENIS PENGURUSAN</th>
						<th>PERUSAHAAN</th>
						<th>PEMOHON</th>
						<th>ALAMAT PERUSAHAAN</th>
						<th>ALAMAT PEMOHON</th>
						<th>AKTIFITAS</th>
					</tr>
				<?php 
						if(mysql_num_rows($query) == '')
						{
					echo "<tr >
							<td colspan='9'>DATA TIDAK DITEMUKAN</td>
						 </tr>";
					}					
						$i=1;
						
						while($set = mysql_fetch_array($query))
						{
							$onc = "tampil('".$set[0]."')";
							echo "
							<tr>
								<td> $i </td>
								<td> $set[0]</td>";
							if($set[1]!=''){
							 echo	"<td> $set[1]</td>";}
							else if($set[2]!=''){
							 echo	"<td> $set[2]</td>";}
							echo"		<td> $set[3]</td>";
							if($set[4]!=''){
							 echo	"<td> $set[4]</td>";}
							else if($set[5]!=''){
							 echo	"<td> $set[5]</td>";}
							if($set[6]!=''){
							 echo	"<td> $set[6]</td>";}
							else if($set[7]!=''){
							 echo	"<td> $set[7]</td>";}

							if($set[8]!=''){
							 echo	"<td> $set[8]</td>";}
							else if($set[9]!=''){
							 echo	"<td> $set[9]</td>";}	
							if($set[10]!=''){
							 echo	"<td> $set[10]</td>";}
							else if($set[11]!=''){
							 echo	"<td> $set[11]</td>";}
							 echo "
								<td> <input type='button' value='PROSES' onClick=$onc></td>
							";
							$i++;
					echo "
					<tr id='div_if'>
						<td colspan='10'> <div id='div_cek_$set[0]'></div>
					</tr>
					";
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
		if($_GET["opts"] == 'proses')
			include('./modules/binapentaker/paraf_sk/proses.php');
		else if($_GET["opts"] == 'terima')
			include('./modules/binapentaker/verifikasi_berkas/terima.php');
		else
			die ("restricted access");
?>