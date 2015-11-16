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
	s='../../../index.php?mod=kabidlatih&opt=lembar_disposisi&opts=terima&link='+x+'&id_user='+uid;
		parent.document.location.href=s;
	}
	function tolak(uid){
	var w = '<?php echo "$no_resi"; ?>';
	g='../../../index.php?mod=kabidlatih&opt=lembar_disposisi&opts=tolak&link='+w+'&id_user='+uid;
		parent.document.location.href=g;
	}
	
</script>
<fieldset>
		<legend>DATA AWAL</legend>
<?php
$userid=$_GET["id_user"];
include "../../../libraries/dinsos.php";
$data_khusus = mysql_query("select * from tbl_berkas_iplk where no_resi='".$no_resi."'");
$da = mysql_fetch_array($data_khusus);
$perusahaan = mysql_query("select * from db_dinsos where id_perusahaan='".$da[5]."'");
$tenagakerja = mysql_query("select b.nama, a.wnilk, a.wnipr, a.wnalk, a.wnapr from tbl_tenagakerja_dinsos a inner join db_dinsos b on a.id_perusahaan=b.id_perusahaan where a.id_perusahaan='".$da[5]."'");

$qry="select * from tbl_iplk_program where id_perusahaan  = '".$da[5]."'";
$cz = mysql_query($qry);

$qry="select * from tbl_iplk_durasi where id_perusahaan  = '".$da[5]."'";
$cz2 = mysql_query($qry);

$qry="select * from tbl_iplk_metode where id_perusahaan  = '".$da[5]."'";
$cz3 = mysql_query($qry);

$qry="select * from tbl_iplk_fasilitas where id_perusahaan  = '".$da[5]."'";
$cz4 = mysql_query($qry);

$qry="select * from tbl_iplk_pelatih where id_perusahaan  = '".$da[5]."'";
$cz5 = mysql_query($qry);

$qry="select * from tbl_iplk_instruktur where id_perusahaan  = '".$da[5]."'";
$cz6 = mysql_query($qry);

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
	<table id='data_awal' name='data_awal' style='text-transform:uppercase;'>
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
	<legend>DATA KHUSUS PENDAFTARAN IPLK</legend>
	<table name="biodata" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>NAMA PEMOHON</td>
        <td width="20">:</td>
        <td><?php echo"$da[1]"?></td>
        </td>
      </tr>	
      <tr>
        <td>ALAMAT PEMOHON</td>
        <td width="20">:</td>
        <td><?php echo"$da[2]"?></td>
        </td>
      </tr>						  	
      <tr>
        <td>NAMA LEMBAGA</td>
        <td width="20">:</td>
        <td><?php echo"$da[6]"?></td>
      </tr>
      <tr>
        <td>NO. AKTE</td>
        <td width="20">:</td>
        <td><?php echo"$da[7]"?></td>
      </tr>
      <tr>
        <td>NAMA PENANGGUNG JAWAB</td>
        <td width="20">:</td>
        <td><?php echo"$da[8]"?></td>
      </tr>     
      <tr>
        <td>BENTUK USAHA</td>
        <td width="20">:</td>
        <td><?php echo"$da[9]"?></td>
      </tr>       
      <tr>
        <td>JENIS PROGRAM PELATIHAN YANG DISELENGGARAKAN</td>
        <td width="20">:</td>
        <td><br/><?php echo'
        	<table class="tblisi" border="1">
							<tr>
								<td>NO</td>
								<td>NAMA PROGRAM</td>
							</tr>';
							$no=1;
							while($data=mysql_fetch_array($cz))
							{	
								echo'
									<tr>
										<td>'.$no.'</td>
										<td>'.$data[2].'</td>
									</tr>';
									$no++;	
							}
							echo '</table>	';?>
      </td>
      </tr>
      <tr>
        <td>DURASI DAN PESERTA PELATIHAN</td>
        <td width="20">:</td>
        <td><br/><?php echo'
        	<table class="tblisi" border="1">
							<tr>
								<td>NO</td>
								<td>NAMA PROGRAM</td>
								<td>LAMA LATIHAN TEORI</td>
								<td>LAMA LATIHAN PRAKTEK</td>
								<td>TOTAL LAMA LATIHAN</td>
								<td>MAKSIMUM SISWA PER ANGKATAN</td>
								<td>JLH ANGKATAN PER TAHUN</td>
								<td>JLH SISWA PER TAHUN</td>
								<td>BIAYA PER ORANG PER PROGRAM</td>
							</tr>';
							$no=1;
							while($data=mysql_fetch_array($cz2))
							{	
								echo'
									<tr>
										<td>'.$no.'</td>
										<td>'.$data[2].'</td>
										<td>'.$data[3].'</td>
										<td>'.$data[4].'</td>
										<td>'.$data[5].'</td>
										<td>'.$data[6].'</td>
										<td>'.$data[7].'</td>
										<td>'.$data[8].'</td>
									</tr>';
									$no++;	
							}
							echo '</table>	';?>
      </td>
      </tr>   
      <tr>
        <td>METODE</td>
        <td width="20">:</td>
        <td><br/><?php echo'
        	<table class="tblisi" border="1">
							<tr>
								<td>NO</td>
								<td>NAMA PROGRAM</td>
							</tr>';
							$no=1;
							while($data=mysql_fetch_array($cz3))
							{	
								echo'
									<tr>
										<td>'.$no.'</td>
										<td>'.$data[2].'</td>
									</tr>';
									$no++;	
							}
							echo '</table>	';?>
      </td>
      </tr> 
      <tr>
        <td>FASILITAS</td>
        <td width="20">:</td>
        <td><br/><?php echo'
        	<table class="tblisi" border="1">
							<tr>
								<td>NO</td>
								<td>NAMA FASILITAS/MESIN</td>
								<td>JLH KEADAAN BAIK</td>
								<td>JLH KEADAAN RUSAK RINGAN</td>
								<td>JLH KEADAAN RUSAK BERAT</td>
								<td>JLH TOTAL</td>
								<td>LUAS</td>
								<td>KETERANGAN</td>
							</tr>';
							$no=1;
							while($data=mysql_fetch_array($cz4))
							{	
								echo'
									<tr>
										<td>'.$no.'</td>
										<td>'.$data[2].'</td>
										<td>'.$data[3].'</td>
										<td>'.$data[4].'</td>
										<td>'.$data[5].'</td>
										<td>'.$data[6].'</td>
										<td>'.$data[7].'</td>
									</tr>';
									$no++;	
							}
							echo '</table>	';?>
      </td>
      </tr>  
      <tr>
        <td>KUALIFIKASI INSTRUKTUR</td>
        <td width="20">:</td>
        <td><br/><?php echo'
        	<table class="tblisi" border="1">
							<tr>
								<td>NO</td>
								<td>JENIS LATIHAN</td>
								<td>JLH KUALIFIKASI BAIK</td>
								<td>JLH KUALIFIKASI CUKUP</td>
								<td>JLH KUALIFIKASI KURANG</td>
								<td>JLH INSTRUKTUR TETAP</td>
								<td>JLH INSTRUKTUR TIDAK TETAP</td>
								<td>JLH INSTRUKTUR PRIA</td>
								<td>JLH INSTRUKTUR WANITA</td>
								<td>JLH TOTAL</td>
								<td>KETERANGAN</td>
							</tr>';
							$no=1;
							while($data=mysql_fetch_array($cz5))
							{	
								echo'
									<tr>
										<td>'.$no.'</td>
										<td>'.$data[2].'</td>
										<td>'.$data[3].'</td>
										<td>'.$data[4].'</td>
										<td>'.$data[5].'</td>
										<td>'.$data[7].'</td>
										<td>'.$data[8].'</td>
										<td>'.$data[9].'</td>
										<td>'.$data[10].'</td>
										<td>'.$data[6].'</td>
										<td>'.$data[11].'</td>
									</tr>';
									$no++;	
							}
							echo '</table>	';?>
      </td>
      </tr>           
      <tr>
        <td>NAMA INSTRUKTUR</td>
        <td width="20">:</td>
        <td><br/><?php echo'
        	<table class="tblisi" border="1">
							<tr>
								<td>NO</td>
								<td>NAMA</td>
								<td>UMUR</td>
								<td>PENDIDIKAN</td>
								<td>LATIHAN TEKNIS</td>
								<td>PENGALAMAN TEKNIS</td>
								<td>KETERANGAN</td>
							</tr>';
							$no=1;
							while($data=mysql_fetch_array($cz6))
							{	
								echo'
									<tr>
										<td>'.$no.'</td>
										<td>'.$data[2].'</td>
										<td>'.$data[3].'</td>
										<td>'.$data[4].'</td>
										<td>'.$data[5].'</td>
										<td>'.$data[6].'</td>
									</tr>';
									$no++;	
							}
							echo '</table>	';?>
      </td>
      </tr>                            
      <tr>
        <td>SUMBER SISWA</td>
        <td width="20">:</td>
        <td><?php echo"$da[10]"?>
        </td>
      </tr>
      <tr>
        <td>SUMBER BIAYA</td>
        <td width="20">:</td>
        <td><?php echo"$da[11]"?></td>
      </tr>
      <tr>
        <td>SIFAT PERMOHONAN</td>
        <td width="20">:</td>
        <td><?php echo"$da[12]"?></td>
      </tr>      
	</table>
</fieldset>
<fieldset>
	<legend>CHECKLIST PERSYARATAN DAN KELENGKAPAN SURAT</legend>
			  <p>
				<label>
				  <input type="checkbox" name="berkas" value="1" id="berkas_0">
				  SURAT PERMOHONAN</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="2" id="berkas_1">
				  AKTE PENDIRIAN</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="3" id="berkas_2">
				  KURIKULUM / SILABUS</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="4" id="berkas_3">
				  PAS PHOTO 3 X 4 (2 LEMBAR)</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="5" id="berkas_4">
				  FOTOCOPY KTP PIMPINAN</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="6" id="berkas_5">
				  STATUS TEMPAT TINGGAL (DOMISILI)</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="7" id="berkas_6">
				  DENAH LOKASI</label>
				<br>      
				<label>
				  <input type="checkbox" name="berkas" value="8" id="berkas_7">
				  FOTOCOPY IJAZAH PIMPINAN</label>
				<br>  
				<label>
				  <input type="checkbox" name="berkas" value="9" id="berkas_8">
				  FOTOCOPY IJIN LAMA DAN SK IJIN LAMA JIKA PERPANJANG IJIN</label>
				<br>                                                       
			  </p>
	<center>
    	<?php
			$onc="tolak('".$userid."')";
			$onc1="terima('".$userid."')";
		?>		
		<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> 
		<input type="button" onClick="<?php echo $onc; ?>" value="DI TOLAK">
		<input type="button" onClick="<?php echo $onc1; ?>" value="PROSES LEBIH LANJUT" disabled id="btn">
	</center>
	</fieldset>
<fieldset>
<legend>CATATAN DISPOSISI</legend>
    <table class="tblisi" border="1" cellpadding="0" cellspacing="0" align="center">
        <tr align="center" height="18px">
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