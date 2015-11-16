<?php
$query=mysql_query("SELECT no_resi FROM tbl_berkas_imta ORDER BY no_resi DESC");
			$result=mysql_fetch_row($query);
			$data=explode("-",$result[0]);
			
			$data[1]+=1;
			if($data[1]>99)
				$no_resi="02-".$data[1];
			else if($data[1]>9)
				$no_resi="02-0".$data[1];
			else if($data[1]<=9)
				$no_resi="02-00".$data[1];

?>
<script language="javascript"> 
function CekAll() {
		checkboxes = document.getElementsByName('berkas');
		for(var i=0, n=checkboxes.length;i<n;i++) 
		{
			if(checkboxes[i].checked == true)
				{checkboxes[i].checked == false;}
			else {checkboxes[i].checked == true;}
		}
}
function goedit() {
		document.getElementById('nama_ta').disabled = false;
		document.getElementById('tgl_lahir').disabled = false;
		document.getElementById('alamat').disabled = false;
		document.getElementById('no_pasport').disabled = false;
		document.getElementById('jabatan').disabled = false;
		document.getElementById('berlaku_dari').disabled = false;
		document.getElementById('berlaku_sampai').disabled = false;
		document.getElementById('no_surat_permohonan').disabled = false;
		document.getElementById('nama_imta').disabled = false;
		document.getElementById('no_imta').disabled = false;
		document.getElementById('tgl_imta').disabled = false;
		document.getElementById('tgl_berakhir').disabled = false;
		document.getElementById('no_rptka').disabled = false;
		document.getElementById('tgl_rptka').disabled = false;
		document.getElementById('tgl_setoran_dpkk').disabled = false;
		document.getElementById('jlh_setoran_dpkk').disabled = false;
		document.getElementById('umur').disabled = false;
		document.getElementById('kewarganegaraan').disabled = false;
}
	function calcAge(dateString) {
		var birthday = +new Date(dateString);
		var x;
		 x = ~~((Date.now() - birthday) / (31557600000));
		document.getElementById('umur').value = x;
	}
	
	function simpan(){
	document.location.href = './index.php?mod=loket&opt=proses_permohonan&opts=resi&id=<?php echo $no_resi; ?>';	
	}
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat; border-bottom:5px outset #0F0;'> 
      <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#">PERMOHONAN BARU - IMTA</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
				  <img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a>
				  <img src="./image/panah.gif"  /><span id="linkutama"> PROSES PENGURUSAN IMTA</span>
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
		<h4> PROSES PENGURUSAN IMTA - VERIFIKASI DATA</h4>
		<fieldset>
		<legend>DATA KHUSUS IMTA</legend>
<?php 
$id_negara = $_POST["kewarganegaraan"];
$negara = mysql_query("select negara from t_negara where id_negara = $id_negara");
$r_negara = mysql_fetch_row($negara);
echo'	<form method="post" action="./index.php?mod=loket&opt=proses_permohonan&opts=resi&id='.$no_resi.'">
		<table name="biodata" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>NAMA TENAGA ASING</td>
						<td width="20px">:</td>
						<td><input name="nama_ta" id="nama_ta" disabled type="text" size="40" value="'.$_POST["nama_ta"].'">
						<input type="hidden" value="'.$_POST["id_per"].'" name="id_per">
						
						</td>
					  </tr>
					  <tr>
						<td>TANGGAL LAHIR</td>
						<td>:</td>
						<td><input name="tgl_lahir" id="tgl_lahir" disabled type="date" size="40" value="'.$_POST["tgl_lahir"].'" onchange="calcAge(this.value);"></td>
					  </tr>
					  <tr>
						<td>UMUR</td>
						<td>:</td>
						<td><input name="umur" id="umur" disabled type="text" size="40" value="'.$_POST["umur"].'"></td>
					  </tr>
					  <tr>
						<td>KEWARGANEGARAAN</td>
						<td>:</td>
						<td><input name="kewarganegaraan" id="kewarganegaraan" disabled type="text" size="40" value="'.$r_negara[0].'"></td>
					  </tr>
					  <tr>
						<td>ALAMAT TEMPAT TINGGAL</td>
						<td>:</td>
						<td><input name="alamat" id="alamat" disabled type="text" size="40" value="'.$_POST["alamat"].'"></td>
					  </tr>
					  <tr>
						<td>NO PASSPORT</td>
						<td>:</td>
						<td><input name="no_pasport" id="no_pasport" disabled type="text" size="40" value="'.$_POST["no_pasport"].'"></td>
					  </tr>
					  <tr>
						<td>JABATAN</td>
						<td>:</td>
						<td><input name="jabatan" id="jabatan" disabled type="text" size="40" value="'.$_POST["jabatan"].'"></td>
					  </tr>
					  <tr>
						<td>BERLAKU DARI</td>
						<td>:</td>
						<td><input name="berlaku_dari" id="berlaku_dari" disabled type="date" size="40" value="'.$_POST["berlaku_dari"].'"></td>
					  </tr>
					  <tr>
						<td>BERLAKU SAMPAI</td>
						<td>:</td>
						<td><input name="berlaku_sampai" id="berlaku_sampai" disabled type="date" size="40" value="'.$_POST["berlaku_sampai"].'"></td>
					  </tr>
					  <tr>
						<td>NOMOR SURAT PERMOHONAN&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>:</td>
						<td><input name="no_surat_permohonan" id="no_surat_permohonan" disabled type="text" size="40" value="'.$_POST["no_surat_permohonan"].'"></td>
					  </tr>
					  <tr>
						<td>IMTA ATAS NAMA</td>
						<td>:</td>
						<td><input name="nama_imta" id="nama_imta" type="text" disabled size="40" value="'.$_POST["nama_imta"].'"></td>
					  </tr>
					  <tr>
						<td>NOMOR IMTA</td>
						<td>:</td>
						<td><input name="no_imta" id="no_imta" type="text" disabled size="40" value="'.$_POST["no_imta"].'"></td>
					  </tr>
					  <tr>
						<td>TANGGAL</td>
						<td>:</td>
						<td><input name="tgl_imta" id="tgl_imta" type="date" disabled size="40" value="'.$_POST["tgl_imta"].'"></td>
					  </tr>
					  <tr>
						<td>TANGGAL BERAKHIR</td>
						<td>:</td>
						<td><input name="tgl_berakhir" id="tgl_berakhir" type="date" disabled size="40" value="'.$_POST["tgl_berakhir"].'"></td>
					  </tr>
					  <tr>
						<td>NOMOR RPTKA</td>
						<td>:</td>
						<td><input name="no_rptka" id="no_rptka" type="text" disabled size="40" value="'.$_POST["no_rptka"].'"></td>
					  </tr>
					  <tr>
						<td>TANGGAL RPTKA</td>
						<td>:</td>
						<td><input name="tgl_rptka" id="tgl_rptka" type="date" disabled size="40" value="'.$_POST["tgl_rptka"].'"></td>
					  </tr>
					  <tr>
						<td>TANGGAL SETORAN DPKK</td>
						<td>:</td>
						<td><input name="tgl_setoran_dpkk" id="tgl_setoran_dpkk" type="date" disabled size="40" value="'.$_POST["tgl_setoran_dpkk"].'"></td>
					  </tr>
					  <tr>
						<td>JUMLAH SETORAN DPKK</td>
						<td>:</td>
						<td><input name="jlh_setoran_dpkk" id="jlh_setoran_dpkk" type="text" disabled size="40" value="'.$_POST["jlh_setoran_dpkk"].'"></td>
					  </tr>
					</table>';
					?>
					<center> <input type="button" onClick="goedit()" value="EDIT"> <input type="button" name="kirim" value="SIMPAN"> <!-- onClick="simpan();" --> </center>
					</fieldset>
					<?php
//-----------------------------------------------------------------------------------------------------
echo'				<fieldset>
							<legend>CHECKLIST PERSYARATAN DAN KELENGKAPAN BERKAS</legend>
							  <p>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="1" id="berkas_0">
								  SURAT PEMOHON</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="2" id="berkas_1">
								  COPY IMTA YANG MASIH BERLAKU</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="3" id="berkas_2">
								  BUKTI PEMBAYARAN DPKK</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="4" id="berkas_3">
								  COPY POLIS ASURANSI</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="5" id="berkas_4">
								  COPY PELAKSANA ALIH TEKNOLOGI</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="6" id="berkas_5">
								  COPY RPTKA YANG MASIH BERLAKU</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="7" id="berkas_6">
								  PASFOTO 3X4 = 3 LBR</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="8" id="berkas_7">
								  FORMULIR PERPANJANGAN IMTA</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="9" id="berkas_8">
								  COPY KITAS/KITAP</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="10" id="berkas_9">
								  COPY STMD</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="11" id="berkas_10">
								  COPY KTP TKI PENDAMPING</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="12" id="berkas_11">
								  COPY PASPORT</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="13" id="berkas_12">
								  COPY VISA</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="14" id="berkas_13">
								  COPY WAJIB LAPOR KETENAGAKERJAAN</label>
								<br>
								<label>
								  <input type="checkbox" name="berkas" checked="true" value="15" id="berkas_14">
								  COPY LAPOR KEBERADAAN TKA</label>
								<br>
							  </p>
								<center>		
								<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> <input type="submit" name="kirim" value="PROSES">
								</center>
							  </form>
							  </fieldset>
					';
		
?>

  <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>
