<link rel='stylesheet' href='../../../css/tabel.css' type='text/css' />
<style type="text/css">
fieldset{
	margin-top:20px;
	padding-top:20px;
}
</style>
<script type="text/javascript">
	function CekAll() {
		document.getElementById("btn").disabled=false;
		checkboxes = document.getElementsByName('berkas');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = true;
		}
	}
	
	function terima(){
	var x = '<?php echo "$no_resi"; ?>';
	s='../../../index.php?mod=kasubag_umum&opt=cek_berkas&opts=terima&value='+x;
		document.location.href=s;
	}
	
	function tolak(){
	var d = '<?php echo "$no_resi"; ?>';
	e='../../../index.php?mod=kasubag_umum&opt=cek_berkas&opts=tolak&value='+d;
		document.location.href=e;
	}
</script>
<fieldset>
		<legend>DATA AWAL</legend>
<?php
include "../../../libraries/dinsos.php";
$data_khusus = mysql_query("select * from tbl_berkas_imta where no_resi='".$no_resi."'");
$da = mysql_fetch_array($data_khusus);
$perusahaan = mysql_query("select * from db_dinsos where id_perusahaan='".$da[3]."'");
$tenagakerja = mysql_query("select b.nama, a.wnilk, a.wnipr, a.wnalk, a.wnapr from tbl_tenagakerja_dinsos a inner join db_dinsos b on a.id_perusahaan=b.id_perusahaan where a.id_perusahaan='".$da[3]."'");
	while($set = mysql_fetch_array($perusahaan))
	{
echo"
	<table id='data_awal' name='data_awal' style='text-transform:uppercase'>
		<tr>
    		<td>NAMA PERUSAHAAN</td>
			<td>$set[1]</td>
		</tr>	
		<tr>        
			<td>ALAMAT</td>
			<td>$set[2]</td>
		</tr>
		<tr>
			<td>KOTA/KABUPATEN</td>	
			<td>$set[15]</td>	
		</tr>
			<td>KECAMATAN</td>
			<td>$set[16]</td>
		</tr>
		<tr>
			<td>TELPON</td>
			<td>$set[3]</td>
        </tr>
		<tr>
			<td>KODE POS</td>
			<td>$set[4]</td>
		</tr>
		<tr>	
            <td>JENIS USAHA</td>
			<td>$set[5]</td>
		</tr>
		<tr>	
            <td>NAMA PEMILIK</td>
			<td>$set[6]</td>
		</tr>
		<tr>	
            <td>ALAMAT PEMILIK</td>
			<td>$set[7]</td>
		</tr>
		<tr>	
            <td>NAMA PENGURUS</td>
			<td>$set[8]</td>
		</tr>
		<tr>	
            <td>ALAMAT PENGURUS</td>
			<td>$set[9]</td>
		</tr>
		<tr>	
            <td>TANGGAL PENDIRIAN</td>
			<td>$set[10]</td>
		</tr>
		<tr>	
            <td>NOMOR AKTE</td>
			<td>$set[11]</td>
		</tr>
		<tr>				
            <td>STATUS PERUSAHAAN</td>
			<td>$set[12]</td>
		</tr>
		<tr>				
            <td>STATUS PEMILIK</td>
			<td>$set[13]</td>
		</tr>
		<tr>	
            <td>STATUS PERMODALAN</td>
			<td>$set[14]</td>
		</tr>
	</table>
	</fieldset>";
}
if(mysql_num_rows($tenagakerja)==0)
	echo "<h5>*BELUM MELAKUKAN PENGISIAN JUMLAH TENAGA KERJA</h5>";
else {
echo '
	<fieldset>
	<legend>DETAIL TENAGA KERJA</legend>
	<table class="tblisi" border="1">
		<tr>
			<td>NAMA PERUSAHAAN</td>
			<td>WNI LAKI-LAKI</td>
			<td>WNI PEREMPUAN</td>
			<td>WNA LAKI-LAKI</td>
			<td>WNA PEREMPUAN</td>
		</tr>';

	while($data=mysql_fetch_array($tenagakerja))
	{
		echo"
			<tr>
				<td>$data[0]</td>
				<td>$data[1]</td>
				<td>$data[2]</td>
				<td>$data[3]</td>
				<td>$data[4]</td>
			</tr>";	
	}
	echo "</table>
	</fieldset>";
}
?>
<fieldset>
	<legend>DATA KHUSUS IMTA</legend>
	<table name="biodata" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>NAMA TENAGA ASING</td>
		<td width="20">:</td>
		<td><input name="nama_ta" type="text" size="40" disabled  disabled value="<?php echo"$da[4]"?>"></td>
	  </tr>
	  <tr>
		<td>UMUR</td>
		<td width="20">:</td>
		<td><input name="umur" type="text" size="40" disabled  value="<?php echo"$da[5]"?>"></td>
	  </tr>
	  <tr>
		<td>TANGGAL LAHIR</td>
		<td width="20">:</td>
		<td><input name="tgl_lahir" type="text" size="40" disabled  value="<?php echo"$da[6]"?>"></td>
	  </tr>
	  <tr>
		<td>KEWARGANEGARAAN</td>
		<td width="20">:</td>
		<td><input name="kewarganegaraan" type="text" size="40" disabled  value="<?php echo"$da[7]"?>"></td>
	  </tr>
	  <tr>
		<td>ALAMAT TEMPAT TINGGAL</td>
		<td width="20">:</td>
		<td><input name="alamat" type="text" size="40" disabled  value="<?php echo"$da[8]"?>"></td>
	  </tr>
	  <tr>
		<td>NO PASSPORT</td>
		<td width="20">:</td>
		<td><input name="no_pasport" type="text" size="40" disabled  value="<?php echo"$da[9]"?>"></td>
	  </tr>
	  <tr>
		<td>JABATAN</td>
		<td width="20">:</td>
		<td><input name="jabatan" type="text" size="40" disabled  value="<?php echo"$da[10]"?>"></td>
	  </tr>
	  <tr>
		<td>BERLAKU DARI</td>
		<td width="20">:</td>
		<td><input name="berlaku_dari" type="text" size="40" disabled  value="<?php echo"$da[11]"?>"></td>
	  </tr>
	  <tr>
		<td>BERLAKU SAMPAI</td>
		<td width="20">:</td>
		<td><input name="berlaku_sampai" type="text" size="40" disabled  value="<?php echo"$da[12]"?>"></td>
	  </tr>
	  <tr>
		<td>NOMOR SURAT PERMOHONAN</td>
		<td width="20">:</td>
		<td><input name="no_surat_permohonan" type="text"size="40" disabled  value="<?php echo"$da[13]"?>"></td>
	  </tr>
	  <tr>
		<td>IMTA ATAS NAMA</td>
		<td width="20">:</td>
		<td><input name="nama_imta" type="text" size="40" disabled  value="<?php echo"$da[14]"?>"></td>
	  </tr>
	  <tr>
		<td>NOMOR IMTA</td>
		<td width="20">:</td>
		<td><input name="no_imta" type="text" size="40" disabled  value="<?php echo"$da[15]"?>"></td>
	  </tr>
	  <tr>
		<td>TANGGAL</td>
		<td width="20">:</td>
		<td><input name="tgl_imta" type="text" size="40" disabled  value="<?php echo"$da[16]"?>"></td>
	  </tr>
	  <tr>
		<td>TANGGAL BERAKHIR</td>
		<td width="20">:</td>
		<td><input name="tgl_berakhir" type="text" size="40" disabled  value="<?php echo"$da[17]"?>"></td>
	  </tr>
	  <tr>
		<td>NOMOR RPTKA</td>
		<td width="20">:</td>
		<td><input name="no_rptka" type="text" size="40" disabled  value="<?php echo"$da[18]"?>"></td>
	  </tr>
	  <tr>
		<td>TANGGAL RPTKA</td>
		<td width="20">:</td>
		<td><input name="tgl_rptka" type="text" size="40" disabled  value="<?php echo"$da[19]"?>"></td>
	  </tr>
	  <tr>
		<td>TANGGAL SETORAN DPKK</td>
		<td width="20">:</td>
		<td><input name="tgl_setoran_dpkk" type="text" size="40" disabled  value="<?php echo"$da[20]"?>"></td>
	  </tr>
	  <tr>
		<td>JUMLAH SETORAN DPKK</td>
		<td width="20">:</td>
		<td><input name="jlh_setoran_dpkk" type="text" size="40" disabled  value="<?php echo"$da[21]"?>"></td>
	  </tr>
	</table>
</fieldset>
<fieldset>
	<legend>CHECKLIST PERSYARATAN DAN KELENGKAPAN SURAT</legend>
	 <p>
				<label>
				  <input type="checkbox" name="berkas" value="1" id="berkas_0">
				  SURAT PEMOHON</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="2" id="berkas_1">
				  COPY IMTA YANG MASIH BERLAKU</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="3" id="berkas_2">
				  BUKTI PEMBAYARAN DPKK</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="4" id="berkas_3">
				  COPY POLIS ASURANSI</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="5" id="berkas_4">
				  COPY PELAKSANA ALIH TEKNOLOGI</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="6" id="berkas_5">
				  COPY RPTKA YANG MASIH BERLAKU</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="7" id="berkas_6">
				  PASFOTO 3X4 = 3 LBR</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="8" id="berkas_7">
				  FORMULIR PERPANJANGAN IMTA</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="9" id="berkas_8">
				  COPY KITAS/KITAP</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="10" id="berkas_9">
				  COPY STMD</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="11" id="berkas_10">
				  COPY KTP TKI PENDAMPING</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="12" id="berkas_11">
				  COPY PASPORT</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="13" id="berkas_12">
				  COPY VISA</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="14" id="berkas_13">
				  COPY WAJIB LAPOR KETENAGAKERJAAN</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="15" id="berkas_14">
				  COPY LAPOR KEBERADAAN TKA</label>
				<br>
			  </p>
	<center>		
		<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> 
		<input type="button" onClick="tolak()" value="DI TOLAK">
		<input type="button" onClick="terima()" value="DI TERIMA" disabled id="btn">
	</center>
	</fieldset>