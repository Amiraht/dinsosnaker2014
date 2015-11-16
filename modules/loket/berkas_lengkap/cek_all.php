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
	s='../../../index.php?mod=loket&opt=berkas_lengkap&opts=terima2&value='+x;
		document.location.href=s;
	}
	function tolak(){
	var w = '<?php echo "$no_resi"; ?>';
	g='../../../index.php?mod=loket&opt=berkas_lengkap&opts=tolak&value='+w;
		document.location.href=g;
	}
</script>
<?php
include "../../../libraries/dinsos.php";
$no_resi = $_GET["link"];
$data=explode("-",$no_resi);
$kode = $data[0];
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

$data_khusus = mysql_query("select * from vw_info_berkas where no_resi='".$no_resi."'");
$da = mysql_fetch_array($data_khusus);

?>
<fieldset>
	<legend>INFORMASI BERKAS</legend>
    <form method="post" action="../../../index.php?mod=loket&opt=print_catatan&id=<?php echo $no_resi;?>" target="_blank">
<table name="biodata" border="0" cellspacing="0" cellpadding="0">
  <tr height="28px">
	<td>NO RESI</td>
	<td>:&nbsp;</td>
	<td><input name="nama" type="text" disabled value="<?php echo"$da[no_resi]"?>"   size="40" >
  </tr>
  <tr height="28px">
	<td>TANGGAL MASUK</td>
	<td>:</td>
	<td><input name="no_ktp" type="text" disabled value="<?php echo"$da[tgl_masuk]"?>"   size="40"></td>
  </tr>
  <tr height="28px">
	<td>JENIS PENGURUSAN</td>
	<td>:</td>
	<td><input name="alamat" type="text" disabled value="<?php echo"$da[pengurusan]"?>"   size="40"></td>
  </tr>
  <tr height="28px">
	<td>NAMA PERUSAHAAN</td>
	<td>:</td>
	<td><input name="no_hp" type="text" disabled value="<?php echo"$da[nama]"?>"   size="40"></td>
  </tr>
  <tr height="28px">
	<td>NAMA PEMOHON</td>
	<td>:</td>
	<td><input name="no_telp" type="text" disabled value="<?php echo"$da[pemohon]"?>"   size="40"></td>
  </tr>
  <tr height="28px">
	<td>ALAMAT PERUSAHAAN</td>
	<td>:</td>
	<td><input name="mulai_bekerja" type="text" disabled value="<?php echo"$da[alamat]"?>"   size="40"></td>
  </tr>
  <tr height="28px">
	<td>ALAMAT PEMOHON</td>
	<td>:</td>
	<td><input name="jabatan" type="text" disabled value="<?php echo"$da[alamat_pemohon]"?>"   size="40"></td>
  </tr>
  <tr height="28px">
	<td>SUMBER</td>
	<td>:</td>
	<td><input name="dasar_permasalahan" type="text" disabled value="<?php echo"$da[sumber]"?>"   size="40"></td>
  </tr>
  <tr height="28px">
	<td>CATATAN</td>
	<td>:</td>
	<td><input name="upah_pokok" type="text" disabled value="<?php echo"$da[catatan]"?>"   size="40"></td>
  </tr>
</table>
</fieldset>
<fieldset>
	<legend>KELENGKAPAN BERKAS YANG AKAN DISERAHKAN</legend>
	   <p>
        <?php
			for($i=0; $i<$n; $i++) {
				echo "<label><input type='checkbox' name='berkas".$set[0]."'>$berkas[$i]</label><br>";
			}       
		?>
		<label>
		  <input type="checkbox" name="berkas" value="1" id="berkas_0">
		  LEMBAR CATATATAN TENTANG ALASAN BERKAS DIKEMBALIKAN</label>
		<br>
		<label>
		  <input type="checkbox" name="berkas" value="2" id="berkas_1">
		  PEMOHON TELAH MENGISI DAN MENANDATANGI BUKU TANDA BUKTI PENYERAHAN BERKAS PERBAIKAN ATAU DITOLAK</label>
		<br>
	  </p>
	<center>
    	<input type="submit" value="CETAK CATATAN">		
		<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> 
		<input type="button" onClick="terima()" value="LANJUTKAN" disabled id="btn">
        </form>	
	</center>
	</fieldset>