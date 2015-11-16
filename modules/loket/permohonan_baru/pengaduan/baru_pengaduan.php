<script type="text/javascript" src="./libraries/jquery.validate.js"></script>
<style type="text/css">
	label.error {
	color: red; padding-left: .5em;
	}
</style>
<script>
	$(document).ready(function(){
	$("#form1").validate();
	});
</script>
<script type="text/javascript">
	function CekAll() {
		checkboxes = document.getElementsByName('berkas');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = true;
		}
	}
	function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
</script>
<script type="text/javascript">
		$(document).ready(function(){
        $("#datepick").datepicker({
					dateFormat  : "yy-mm-dd",        
          changeMonth : true,
          changeYear  : true					
        });
		});
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat; '> 
      <table border="0" id="atasan">
        	<tr>
		         <td colspan="2" style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b> PROSES PERMOHONAN DAN PRINT RESI
				 PROSES PENGURUSAN PENGADUAN KETENAGAKERJAAN</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				 <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
				 <img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a> 
                 <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan&opts=baru" id="linkutama"> PROSES BARU </a><br/>
				 <img src="./image/panah.gif"  /><span id="linkutama"> PROSES PENGURUSAN PENGADUAN KETENAGAKERJAAN</span>
                 </td>
                
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
<td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=baru'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
</tr>
<tr>
	<td>
		<fieldset>
		<legend>DATA AWAL</legend>
<?php
$perusahaan = mysql_query("select a.id_perusahaan, a.nama, a.alamat, a.telpon, a.kode_pos, g.jenis,
a.nama_pemilik, a.alamat_pemilik, a.nama_pengurus,
a.alamat_pengurus, a.tgl_pendirian, a.nomor_akte,
b.status, c.status, d.modal, e.kecamatan, f.kelurahan 
from db_dinsos a 
inner join t_status b on a.id_status_perusahaan=b.id_status 
inner join t_status_milik c on a.id_status_pemilik=c.id_status 
inner join t_status_modal d on a.id_status_permodalan=d.id_status 
inner join t_kecamatan e on a.kec = e.id_kecamatan 
inner join t_kelurahan f on a.kel = f.id_kelurahan 
inner join t_jenis_usaha g on a.jenis_usaha=g.id_jenis_usaha where id_perusahaan='".$_GET["id"]."'");


$tenagakerja = mysql_query("select b.nama, a.wnilk, a.wnipr, a.wnalk, a.wnapr from tbl_tenagakerja_dinsos a inner join db_dinsos b on a.id_perusahaan=b.id_perusahaan where a.id_perusahaan='".$_GET['id']."'");
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
			<td>$set[16]</td>	
		</tr>
			<td>KECAMATAN</td>
			<td>:</td>
			<td>$set[17]</td>
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
	echo "<h3> &nbsp; *BELUM MELAKUKAN PENGISIAN JUMLAH TENAGA KERJA</h3>";
else {
echo '
<br>
	<fieldset>
		<legend>DETAIL DATA JUMLAH TENAGA KERJA</legend>
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
			<form name="form1" method="post" action="./index.php?mod=loket&opt=proses_permohonan&opts=validate_pengaduan&mode=1" id="form1">
				<table name="biodata" border="0" cellspacing="0" cellpadding="0" >
					  <tr>
						<td>NAMA</td>
						<td>:&nbsp;</td>
						<td><input name="nama" type="text" size="40" class="required" >
						<input type="hidden" value="<?php echo $_GET['id']; ?>" name="id_per"></td>
					  </tr>
					  <tr>
						<td>NO KTP</td>
						<td>:</td>
						<td><input name="no_ktp" type="text" size="40" class="required"></td>
					  </tr>
					  <tr>
						<td>ALAMAT</td>
						<td>:</td>
						<td><input name="alamat" type="text" size="40" class="required"></td>
					  </tr>
					  <tr>
						<td>NO HP</td>
						<td>:</td>
						<td><input name="no_hp" type="text" size="40" class="required"></td>
					  </tr>
					  <tr>
						<td>NO TELEPON</td>
						<td>:</td>
						<td><input name="no_telp" type="text" size="40" class="required"></td>
					  </tr>
					  <tr>
						<td>MULAI BEKERJA</td>
						<td>:</td>
						<td><input name="mulai_bekerja" type="text" size="40" class="required date" id="datepick"></td>
					  </tr>
					  <tr>
						<td>JABATAN</td>
						<td>:</td>
						<td><input name="jabatan" type="text" size="40" class="required"></td>
					  </tr>
					  <tr>
						<td>UPAH POKOK</td>
						<td>:</td>
						<td><input name="upah" type="text" size="40" class="required number" ></td>
					  </tr>                      
					  <tr>
						<td>DASAR PERMASALAHAN</td>
						<td>:</td>
						<td><input name="dasar_permasalahan" type="text" size="40" class="required" ></td>
					  </tr>
					  <tr>
						<td>MASA KERJA</td>
						<td>:</td>
						<td><input name="masa_kerja" type="text" size="40" class="required" ></td>
					  </tr>
					  <tr>
						<td>KRONOLOGIS PERMASALAHAN</td>
						<td>:</td>
						<td><input name="kronologis" type="text" size="40" class="required"></td>
					  </tr>
					  <tr>
						<td>JANJI YANG PERNAH DIBERIKAN</td>
						<td>:</td>
						<td><textarea name="janji" cols="40" rows="7" style="font-family:verdana;font-size:12px" ></textarea></td>
					  </tr>                       
				</table>
		</fieldset>
<fieldset>
		<legend>CHECKLIST PERSYARATAN DAN KELENGKAPAN BERKAS</legend>
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
				<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> <input type="submit" value="PROSES">
				</center>
			  </form>
</fieldset>
</td>
	</tr>
  <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>