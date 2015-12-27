<link rel='stylesheet' href='../../../css/tabel.css' type='text/css' />
<link rel='stylesheet' href='../../../css/button.css' type='text/css' />
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
	s='../../../index.php?mod=kabidhubsaker&opt=tolak&opts=terima&value='+x;
		document.location.href=s;
	}
	
	function tolak(){
	var w = '<?php echo "$no_resi"; ?>';
	s='../../../index.php?mod=kabidhubsaker&opt=tolak&opts=terima&value='+w;
		document.location.href=s;
	}

</script>
<fieldset>
		<legend>DATA AWAL</legend>
<?php
include "../../../libraries/dinsos.php";
$data_khusus = mysql_query("select * from tbl_berkas_pengaduan where no_resi='".$no_resi."'");
$da = mysql_fetch_array($data_khusus);
$perusahaan = mysql_query("select * from db_dinsos where id_perusahaan='".$da[3]."'");
$tenagakerja = mysql_query("select b.nama, a.wnilk, a.wnipr, a.wnalk, a.wnapr from tbl_tenagakerja_dinsos a inner join db_dinsos b on a.id_perusahaan=b.id_perusahaan where a.id_perusahaan='".$da[3]."'");
	while($set = mysql_fetch_array($perusahaan))
	{
echo"
	<table id='data_awal' name='data_awal' style='text-transform:uppercase'>
		<tr>
    		<td>NAMA PERUSAHAAN</td>
			<td>:</td>
			<td>$set[1]</td>
		</tr>	
		<tr>        
			<td>ALAMAT</td>
			<td>:</td>
			<td>$set[2]</td>
		</tr>
		<tr>
			<td>KOTA/KABUPATEN</td>	
			<td>:</td>
			<td>$set[15]</td>	
		</tr>
			<td>KECAMATAN</td>
			<td>:</td>
			<td>$set[16]</td>
		</tr>
		<tr>
			<td>TELPON</td>
			<td>:</td>
			<td>$set[3]</td>
        </tr>
		<tr>
			<td>KODE POS</td>
			<td>:</td>
			<td>$set[4]</td>
		</tr>
		<tr>	
            <td>JENIS USAHA</td>
			<td>:</td>
			<td>$set[5]</td>
		</tr>
		<tr>	
            <td>NAMA PEMILIK</td>
			<td>:</td>
			<td>$set[6]</td>
		</tr>
		<tr>	
            <td>ALAMAT PEMILIK</td>
			<td>:</td>
			<td>$set[7]</td>
		</tr>
		<tr>	
            <td>NAMA PENGURUS</td>
			<td>:</td>
			<td>$set[8]</td>
		</tr>
		<tr>	
            <td>ALAMAT PENGURUS</td>
			<td>:</td>
			<td>$set[9]</td>
		</tr>
		<tr>	
            <td>TANGGAL PENDIRIAN</td>
			<td>:</td>
			<td>$set[10]</td>
		</tr>
		<tr>	
            <td>NOMOR AKTE</td>
			<td>:</td>
			<td>$set[11]</td>
		</tr>
		<tr>				
            <td>STATUS PERUSAHAAN</td>
			<td>:</td>
			<td>$set[12]</td>
		</tr>
		<tr>				
            <td>STATUS PEMILIK</td>
			<td>:</td>
			<td>$set[13]</td>
		</tr>
		<tr>	
            <td>STATUS PERMODALAN</td>
			<td>:</td>
			<td>$set[14]</td>
		</tr>
	</table>
	</fieldset>";
}
if(mysql_num_rows($tenagakerja)==0)
{
	echo "<h5>*BELUM MELAKUKAN PENGISIAN JUMLAH TENAGA KERJA</h5>";
}
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
	<legend>INFORMASI PENGADUAN</legend>
<table name="biodata" border="0" cellspacing="0" cellpadding="0" >
  <tr >
	<td>NAMA</td>
	<td>:&nbsp;</td>
	<td><?php echo"$da[4]"?></td>
  </tr>
  <tr >
	<td>NO KTP</td>
	<td>:</td>
	<td><?php echo"$da[5]"?></td>
  </tr>
  <tr >
	<td>ALAMAT</td>
	<td>:</td>
	<td><?php echo"$da[6]"?></td>
  </tr>
  <tr >
	<td>NO HP</td>
	<td>:</td>
	<td><?php echo"$da[7]"?></td>
  </tr>
  <tr >
	<td>NO TELEPON</td>
	<td>:</td>
	<td><?php echo"$da[8]"?></td>
  </tr>
  <tr >
	<td>MULAI BEKERJA</td>
	<td>:</td>
	<td><?php echo"$da[9]"?></td>
  </tr>
  <tr >
	<td>JABATAN</td>
	<td>:</td>
	<td><?php echo"$da[10]"?></td>
  </tr>
  <tr >
	<td>UPAH POKOK</td>
	<td>:</td>
	<td><?php echo"$da[upah]"?></td>
  </tr>   
  <tr >
	<td>DASAR PERMASALAHAN</td>
	<td>:</td>
	<td><?php echo"$da[11]"?></td>
  </tr>
  <tr >
	<td>MASA KERJA</td>
	<td>:</td>
	<td><?php echo"$da[12]"?></td>
  </tr>
  <tr >
	<td>KRONOLOGIS PERMASALAHAN</td>
	<td>:</td>
	<td><?php echo"$da[13]"?></td>
  </tr>
  <tr >
	<td>JANJI YANG PERNAH DIBERIKAN</td>
	<td>:</td>
	<td><?php echo"$da[14]"?></td>
  </tr>
</table>
</fieldset>
<fieldset>
	<legend>CHECKLIST PERSYARATAN DAN KELENGKAPAN SURAT</legend>
	   <p>
		<label>
		  <input type="checkbox" name="berkas" value="1" id="berkas_0">
		  KTP PENGADU</label>
		<br>
		<label>
		  <input type="checkbox" name="berkas" value="2" id="berkas_1">
		  SURAT PENGADUAN</label>
		<br>
	  </p>
	<center>		
		<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> 
		<input type="button" onClick="terima()" value="TIDAK SETUJUI">
		<input type="button" onClick="tolak()" value="SETUJUI PENOLAKAN" disabled id="btn">
	</center>
	</fieldset>