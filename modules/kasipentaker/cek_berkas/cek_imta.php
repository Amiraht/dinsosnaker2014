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
	
	
	function terima(uid){
	var x = '<?php echo "$no_resi"; ?>';
	s='../../../index.php?mod=kasipentaker&opt=cek_berkas&opts=terima&value='+x+'&id_user='+uid;
		document.location.href=s;
	}

	function tolak(uid){
	var x = '<?php echo "$no_resi"; ?>';
	s='../../../index.php?mod=kasipentaker&opt=lembar_disposisi&opts=tolak&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}
	
</script>
<fieldset>
		<legend>DATA AWAL</legend>
<?php
include "../../../libraries/dinsos.php";
$userid=$_GET["id_user"];
$data_khusus = mysql_query("select * from tbl_berkas_imta where no_resi='".$no_resi."'");
$da = mysql_fetch_array($data_khusus);
$perusahaan = mysql_query("select * from db_dinsos where id_perusahaan='".$da[3]."'");
$tenagakerja = mysql_query("select b.nama, a.wnilk, a.wnipr, a.wnalk, a.wnapr from tbl_tenagakerja_dinsos a inner join db_dinsos b on a.id_perusahaan=b.id_perusahaan where a.id_perusahaan='".$da[3]."'");
	while($set = mysql_fetch_array($perusahaan))
	{
	        $nmpri=mysql_query("select kecamatan from t_kecamatan where id='".$set["kec"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $kec=$rnmpri["kecamatan"];
			
	        $nmpri=mysql_query("select negara from t_negara where id_negara='".$da["kewarganegaraan"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $neg=$rnmpri["negara"];
			
	        $nmpri=mysql_query("select jenis from t_jenis_usaha where id_jenis_usaha='".$set["jenis_usaha"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $jenusaha=$rnmpri["jenis"];		
			
			$nmpri=mysql_query("select status from t_status where id_status ='".$set["id_status_perusahaan"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $status=$rnmpri["status"];		

			$nmpri=mysql_query("select status from t_status_milik where id_status ='".$set["id_status_milik"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $milik=$rnmpri["status"];	
			
			$nmpri=mysql_query("select modal from t_status_modal where id_status ='".$set["id_status_permodalan"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $modal=$rnmpri["modal"];							
						
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
			<td>$kec</td>
		</tr>
		<tr>
			<td>TELPON</td>
			<td>:</td>
			<td>$set[5]</td>
        </tr>
		<tr>
			<td>KODE POS</td>
			<td>:</td>
			<td>$set[6]</td>
		</tr>
		<tr>	
            <td>JENIS USAHA</td>
			<td>:</td>
			<td>$jenusaha</td>
		</tr>
		<tr>	
            <td>NAMA PEMILIK</td>
			<td>:</td>
			<td>$set[12]</td>
		</tr>
		<tr>	
            <td>ALAMAT PEMILIK</td>
			<td>:</td>
			<td>$set[13]</td>
		</tr>
		<tr>	
            <td>NAMA PENGURUS</td>
			<td>:</td>
			<td>$set[14]</td>
		</tr>
		<tr>	
            <td>ALAMAT PENGURUS</td>
			<td>:</td>
			<td>$set[15]</td>
		</tr>
		<tr>	
            <td>TANGGAL PENDIRIAN</td>
			<td>:</td>
			<td>$set[8]</td>
		</tr>
		<tr>	
            <td>NOMOR AKTE</td>
			<td>:</td>
			<td>$set[7]</td>
		</tr>
		<tr>				
            <td>STATUS PERUSAHAAN</td>
			<td>:</td>
			<td>$status</td>
		</tr>
		<tr>				
            <td>STATUS PEMILIK</td>
			<td>:</td>
			<td>$milik</td>
		</tr>
		<tr>	
            <td>STATUS PERMODALAN</td>
			<td>:</td>
			<td>$modal</td>
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
		<td><?php echo"$da[4]"?></td>
	  </tr>
	  <tr>
		<td>UMUR</td>
		<td width="20">:</td>
		<td><?php echo"$da[5]"?></td>
	  </tr>
	  <tr>
		<td>TANGGAL LAHIR</td>
		<td width="20">:</td>
		<td><?php echo"$da[6]"?></td>
	  </tr>
	  <tr>
		<td>KEWARGANEGARAAN</td>
		<td width="20">:</td>
		<td><?php echo"$neg"?></td>
	  </tr>
	  <tr>
		<td>ALAMAT TEMPAT TINGGAL</td>
		<td width="20">:</td>
		<td><?php echo"$da[8]"?></td>
	  </tr>
	  <tr>
		<td>NO PASSPORT</td>
		<td width="20">:</td>
		<td><?php echo"$da[9]"?></td>
	  </tr>
	  <tr>
		<td>JABATAN</td>
		<td width="20">:</td>
		<td><?php echo"$da[10]"?></td>
	  </tr>
	  <tr>
		<td>BERLAKU DARI</td>
		<td width="20">:</td>
		<td><?php echo"$da[11]"?></td>
	  </tr>
	  <tr>
		<td>BERLAKU SAMPAI</td>
		<td width="20">:</td>
		<td><?php echo"$da[12]"?></td>
	  </tr>
	  <tr>
		<td>NOMOR SURAT PERMOHONAN</td>
		<td width="20">:</td>
		<td><?php echo"$da[13]"?></td>
	  </tr>
	  <tr>
		<td>IMTA ATAS NAMA</td>
		<td width="20">:</td>
		<td><?php echo"$da[14]"?></td>
	  </tr>
	  <tr>
		<td>NOMOR IMTA</td>
		<td width="20">:</td>
		<td><?php echo"$da[15]"?></td>
	  </tr>
	  <tr>
		<td>TANGGAL</td>
		<td width="20">:</td>
		<td><?php echo"$da[16]"?></td>
	  </tr>
	  <tr>
		<td>TANGGAL BERAKHIR</td>
		<td width="20">:</td>
		<td><?php echo"$da[17]"?></td>
	  </tr>
	  <tr>
		<td>NOMOR RPTKA</td>
		<td width="20">:</td>
		<td><?php echo"$da[18]"?></td>
	  </tr>
	  <tr>
		<td>TANGGAL RPTKA</td>
		<td width="20">:</td>
		<td><?php echo"$da[19]"?></td>
	  </tr>
	  <tr>
		<td>TANGGAL SETORAN DPKK</td>
		<td width="20">:</td>
		<td><?php echo"$da[20]"?></td>
	  </tr>
	  <tr>
		<td>JUMLAH SETORAN DPKK</td>
		<td width="20">:</td>
		<td><?php echo"$da[21]"?></td>
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
        <?php
			//$onc="tampil('".$no_resi."')";
			$onc="terima('".$userid."')";
			$onc1="tolak('".$userid."')";
		?>		
		<input type="button" onClick="CekAll()" value="CENTANG SEMUA"><br/><br/>
        <span> BERDASARKAN HASIL PEMERIKSAAN BERKAS, MAKA PENGURUSAN PERPANJANGAN IMTA INI :</span><br/><br/>
		<input type="button" onClick="<?php echo $onc1?>" value="DI TOLAK">
		<input type="button" onClick="<?php echo $onc?>" value="DI TERIMA" disabled id="btn">
	</center>
<div id='div_cek'></div>
	</fieldset>
<fieldset>
<legend>CATATAN DISPOSISI</legend>
    <table class="tblisi" border="1" cellpadding="0" cellspacing="0" align="center">
        <tr align="center"  height="18px">
            <td>TANGGAL</td>
            <td>DARI</td>
            <td>LEVEL</td>
            <td>KEPADA</td>
            <td>LEVEL</td>
            <td>PESAN</td>
        </tr>
    <?php
	$q = mysql_query("select * from tbl_info_disposisi where no_resi ='".$no_resi."'");	
    while($qz = mysql_fetch_array($q))
    {
            $nmpri=mysql_query("select nama from user where id_user='".$qz["dari"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $dari=$rnmpri["nama"];
            
            $nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$qz["dari_level"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $dari_level=$rnmpri["nama_level"];
            
            $nmpri=mysql_query("select nama from user where id_user='".$qz["tujuan"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $tujuan=$rnmpri["nama"];
            
            $nmpri=mysql_query("select nama_level from tbl_ket_level where id_level='".$qz["tujuan_level"]."'");
            $rnmpri = mysql_fetch_array($nmpri);
            $tujuan_level=$rnmpri["nama_level"];
    
    
    ?>
        <tr>
            <td><?php echo tgl_indo($qz["tgl"]); ?></td>
            <td><?php echo $dari; ?></td>
            <td><?php echo $dari_level; ?></td>
            <td><?php echo $tujuan; ?></td>
            <td><?php echo $tujuan_level; ?></td>
            <td><?php echo $qz["pesan"]; ?></td>
        </tr>
    <?php
    }
    ?>
    </table> 
</fieldset>    


<?php

function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			}
?>         