<script language="javascript"> 
function toggle(a) {
	var ele = document.getElementById(a);
	if(ele.style.display == "block") {
    		ele.style.display = "none";
  	}
	else {
		ele.style.display = "block";
	}
} 
	function CekAll(b) {
		document.getElementById("btn"+b).disabled=false;
		checkboxes = document.getElementsByName('berkas'+b);
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = true;
		}
	}
	
	function gomod(x){
		var a = "./index.php?mod=loket&opt=berkas_lengkapi&opts=validasi";
		document.location.href=a+"&id="+x;
	}
</script>

<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat; border-bottom:5px outset #0F0;'> 
      <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#">BERKAS YANG HARUS DILENGKAPI KEMBALI</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
                 </td>
                <td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=main'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
	<td>
		<fieldset>
		<legend>BERKAS YANG HARUS DILENGKAPI KEMBALI</legend>

<?php
$query = mysql_query("SELECT 

a.no_resi,c.tgl_masuk_berkas,b.pengurusan,d.nama,c.nama_ta,d.alamat,c.alamat, b.id_pengurusan

FROM 
tbl_berkas_imta c
inner join db_dinsos d on c.id_perusahaan = d.id_perusahaan
,
tbl_info_berkas a
inner join tbl_pengurusan b on a.jenis_pengurusan = b.id_pengurusan
WHERE c.no_resi=a.no_resi AND a.isValid='0' AND a.isDisposisi='0'");						
?>
<table border='1' class='tblisi' style='width:95%; margin-bottom:10px;'>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;NO</td>
						<td>NO RESI</td>
						<td>TANGGAL MASUK</td>
						<td>JENIS PENGURUSAN</td>
						<td>PERUSAHAAN</td>
						<td>PEMOHON</td>
						<td>AKTIVITAS</td>
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
						$rs = 'colspan="6"';
						$onc = "toggle('".$set[0]."')";
						$onc2 = "toggle('C".$set[0]."')";
						$kode = $set[7];
						if($kode == "01"){
							$berkas=array("FOTOCOPY AKTE NOTARIS","FOTOCOPY SIUP YANG BERLAKU",
									"FOTOCOPY TDP YANG BERLAKU","FOTO COPY JAMSOSTEK YANG BERLAKU","FORM WAJIB LAPOR YANG TELAH DIISI");
						}else if ($kode == "02"){
							$berkas=array("SURAT PERMOHONAN","COPY IMTA YANG MASIH BERLAKU",
										"BUKTI PEMBAYARAN DPKK","COPY POLIS ASURANSI",
										"COPY PELAKSANA ALIH TEKNOLOGI","COPY RPTKA YANG MASIH BERLAKU",
										"PAS PHOTO 3x4 = 3 LEMBAR","FORMULIR PERPANJANGAN IMTA",
										"COPY KITAS/KITAP","COPY STMD","COPY KTP TKI PENDAMPING",
										"COPY PASSPORT","COPY VISA",
										"COPY WAJIB LAPOR KETENAGAKERJAAN","COPY LAPOR KEBERADAAN TKA");
						}else if($kode == "03"){
							$berkas=array("KTP PENGADU","SURAT PENGADUAN");
						}
						$n=count($berkas);
						
						echo "
						<tr>
							<td> $i </td>
							<td> $set[0]</td>
							<td> $set[1]</td>
							<td> $set[2]</td>
							<td> $set[3]</td>
							<td> $set[4]</td>
							<td> <input type='button' value='PROSES' onClick=$onc></td>
						</tr>
						<tr>
							<td colspan='7'>
								<div id='$set[0]' style='display: none' >
								<br>
										<span>NO RESI : <input disabled type=text' size='40' value='".$set[0]."'></span></br>
										<span>TANGGAL MASUK : <input disabled type=text' size='40' value='".$set[1]."'></span></br>
										<span>JENIS PENGURUSAN : <input disabled type=text' size='40' value='".$set[2]."'></span></br>	
										<span>NAMA PERUSAHAAN : <input disabled type=text' size='40' value='".$set[3]."'></span></br>
										<span>NAMA PEMOHON: <input disabled type=text' size='40' value='".$set[4]."'></span></br>
										<span>ALAMAT PERUSAHAAN: <input disabled type=text' size='40' value='".$set[5]."'></span></br>
										<span>ALAMAT PEMOHON : <input disabled type=text' size='40' value='".$set[6]."'></span></br>
										<span>SUMBER : <input disabled type=text' size='40' value='".$set[6]."'></span></br>
										<span>CATATAN : <textarea disabled >".$set[6]."</textarea></span></br>
										<input type='button' value='CHECKLIST BERKAS' onClick=$onc2>
										<hr>";
						echo "<div id='C".$set[0]."' style='display: none' >
						<br><h2> KELENGKAPAN BERKAS YANG AKAN DI SERAHKAN </h2><br>";
						for($i=0; $i<$n; $i++) {
							echo "<label><input type='checkbox' name='berkas".$set[0]."'>$berkas[$i]</label><br>";
						}
						?>
						
						<input type="button" onClick="CekAll('<?php echo $set[0]; ?>')" value="CENTANG SEMUA"> <input type="button" id="btn<?php echo $set[0]; ?>" value="PROSES" onClick="gomod('<?php echo $set[0]; ?>')" disabled>
						<?php
						echo"</div>
								</div>
							</td>
						</tr>
						";
						$i++;
						}
					
					?>
					
				</table> 
	</fieldset>
</td>
	</tr>

 <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>
<?php
		if($_GET["opts"]==''){
		}
		else if($_GET["opts"] == 'validasi')
			include('./modules/loket/berkas_lengkapi/validasi.php');
		else
			die ("restricted access");
?>