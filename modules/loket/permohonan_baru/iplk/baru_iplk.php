<script type="text/javascript" src="./libraries/jquery.validate.js"></script>
<script type="text/javascript" src="./libraries/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./libraries/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./libraries/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	function CekAll() {
		checkboxes = document.getElementsByName('berkas');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = true;
		}
	}
 $('#loading').css('visibility','visible');

 
function tambahNegara(name) {
$.ajax({
  type: "post",
  url: "./fetching.php",
  data: 'nama='+name,
  datatype: "html",
  success: function(msg){
	   if(parseInt(msg)!=5)
	   {
		alert('success');//testing purposes
	   }
	   else
	   {
		alert('fail');//testing purposes
	   }
	}
  });
  document.getElementById("nama_negara").value='';
  $.getJSON('./fetching.php',{action:'getNegara'},function(json)
		{
			$('#kwn').html('<option value=0>PILIH NEGARA</option>');
			$.each(json, function(index,row){
			$('#kwn').append('<option value="'+row.id_negara+'">'+row.nama_negara+'</option>');
				});
		}
	);
}
	function calcAge(dateString) {
		var birthday = +new Date(dateString);
		var x;
		 x = ~~((Date.now() - birthday) / (31557600000));
		document.getElementById('umur').value = x;
	}

	function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
	
	function CekCentang() {
		checkboxes = document.getElementsByName('berkas');
		var flag=0;
		for(var i=0, n=checkboxes.length;i<n;i++) {
			if(checkboxes[i].checked != true)
			{
				alert("Data Berkas Tidak Lengkap");
				flag = 1;
						return false;
			}
		}
		if (flag == 0){
			return true;}
	}
	
$(document).ready(function() {
    $("#date1").datepicker({ dateFormat: "yy-mm-dd", changeMonth : true,changeYear  : true });
	});
$(document).ready(function() {
    $("#date2").datepicker({ dateFormat: "yy-mm-dd", changeMonth : true,changeYear  : true });
	});
$(document).ready(function() {
    $("#date3").datepicker({ dateFormat: "yy-mm-dd", changeMonth : true,changeYear  : true });
	});
$(document).ready(function() {
    $("#date4").datepicker({ dateFormat: "yy-mm-dd", changeMonth : true,changeYear  : true});
	});
$(document).ready(function() {
    $("#date5").datepicker({ dateFormat: "yy-mm-dd", changeMonth : true,changeYear  : true });
	});	
$(document).ready(function() {
    $("#date6").datepicker({ dateFormat: "yy-mm-dd", changeMonth : true,changeYear  : true });
	});
$(document).ready(function() {
    $("#date7").datepicker({ dateFormat: "yy-mm-dd", changeMonth : true,changeYear  : true });
	});
</script>
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
		$(document).ready(function() {
			$("#various1").fancybox({
				'width'				: '90%',
				'height'			: '105%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'overlayShow'	: false,
				'type'				: 'iframe'
			});
			
			$("#various2").fancybox({
				'width'				: '90%',
				'height'			: '105%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'overlayShow'	: false,
				'type'				: 'iframe'
			});	
			
			$("#various3").fancybox({
				'width'				: '90%',
				'height'			: '105%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'overlayShow'	: false,
				'type'				: 'iframe'
			});	
			$("#various4").fancybox({
				'width'				: '90%',
				'height'			: '105%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'overlayShow'	: false,
				'type'				: 'iframe'
			});	
			$("#various5").fancybox({
				'width'				: '90%',
				'height'			: '105%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'overlayShow'	: false,
				'type'				: 'iframe'
			});	
			$("#various6").fancybox({
				'width'				: '90%',
				'height'			: '105%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'overlayShow'	: false,
				'type'				: 'iframe'
			});															
		});
</script>
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat; '> 
      <table border="0" id="atasan">
        	<tr>
		         <td colspan="2" style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>PERMOHONAN BARU - PERMOHONAN IPLK</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
				  <img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a>
                  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan&opts=baru" id="linkutama"> PROSES BARU </a>
				  <img src="./image/panah.gif"  /><span id="linkutama"> PROSES PERMOHONAN IPLK</span>
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
	<h2> &nbsp; PROSES PENGURUSAN IZIN PENYELENGGARAAN PELATIHAN KERJA</h2>
		<fieldset>
		<legend>DATA AWAL</legend>
<?php
$id_per = mysql_real_escape_string($_GET['id']);
$perusahaan = mysql_query("SELECT
								a.id_perusahaan, a.nama, a.alamat,
								a_k.kecamatan, a_kel.kelurahan,
								a.telpon, a.kode_pos,
								a.nomor_akte,a.tgl_pendirian, 
								a_j.jenis, a_s.status,
								a.nama_pemilik, a.nama_pengurus,
								a.alamat_pemilik, a.alamat_pengurus,
								a_m.status,a_mod.modal,
								b.wnilk, b.wnipr, b.wnalk, b.wnapr, a.klui
							FROM
								db_dinsos a
								LEFT JOIN t_jenis_usaha a_j ON a.jenis_usaha = a_j.id_jenis_usaha
								LEFT JOIN t_status_milik a_m ON a.id_status_pemilik = a_m.id_status
								LEFT JOIN t_status_modal a_mod ON a.id_status_permodalan = a_mod.id_status
								LEFT JOIN t_status a_s ON a.id_status_perusahaan = a_s.id_status
								LEFT JOIN t_kecamatan a_k ON a.kec = a_k.id_kecamatan
								LEFT JOIN t_kelurahan a_kel ON a.kel = a_kel.id_kelurahan
								LEFT JOIN tbl_tenagakerja_dinsos b ON b.id_perusahaan = a.id_perusahaan
where a.id_perusahaan = '".$id_per."'
");
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
			<td>KECAMATAN</td>
			<td>:</td>	
			<td>$set[3]</td>	
		</tr>
			<td>KELURAHAN</td>
			<td>:</td>	
			<td>$set[4]</td>
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
			<td>$set[9]</td>
		</tr>
		<tr>	
            <td>NAMA PEMILIK</td>
			<td>:</td>
			<td>$set[11]</td>
		</tr>
		<tr>	
            <td>ALAMAT PEMILIK</td>
			<td>:</td>
			<td>$set[13]</td>
		</tr>
		<tr>	
            <td>NAMA PENGURUS</td>
			<td>:</td>
			<td>$set[12]</td>
		</tr>
		<tr>	
            <td>ALAMAT PENGURUS</td>
			<td>:</td>
			<td>$set[14]</td>
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
			<td>$set[10]</td>
		</tr>
		<tr>				
            <td>STATUS PEMILIK</td>
			<td>:</td>
			<td>$set[15]</td>
		</tr>
		<tr>	
            <td>STATUS PERMODALAN</td>
			<td>:</td>
			<td>$set[16]</td>
		</tr>
	</table>
	</fieldset>";
}
if(mysql_num_rows($tenagakerja)==0)
	echo "<h3>&nbsp; *BELUM MELAKUKAN PENGISIAN JUMLAH TENAGA KERJA</h3>";
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

$ak = mysql_query("select * from t_negara");

?>
<fieldset>
		<legend>DATA  KHUSUS IZIN PENYELENGGARAAN PELATIHAN KERJA</legend>
		<form name="form1" method="post" action="./index.php?mod=loket&opt=proses_permohonan&opts=validate_iplk&mode=1" id="form1">
				<table name="biodata" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>NAMA PEMOHON</td>
						<td width="20">:</td>
						<td><input name="nama_pemohon" type="text" size="40"  class="required"></td>
					  </tr>   
					  <tr>
						<td>ALAMAT PEMOHON</td>
						<td width="20">:</td>
						<td><input name="alamat_pemohon" type="text" size="40"  class="required"></td>
					  </tr> 
					  <tr>
						<td>NO HP</td>
						<td width="20">:</td>
						<td><input name="no_hp" type="text" size="40"  class="required"></td>
					  </tr> 	
					  <tr>
						<td>NAMA LEMBAGA</td>
						<td width="20">:</td>
						<td><input name="nama_lembaga" type="text" size="40" class="required" onkeyup="javascript:this.value=this.value.toUpperCase();">
						<input type="hidden" value="<?php echo $_GET['id']; ?>" name="id_per"></td>
					  </tr>
					  <tr>
						<td>NOMOR AKTE PENDIRIAN</td>
						<td width="20">:</td>
						<td><input name="no_akte" type="text" size="40" class="required"></td>
					  </tr>
					  <tr>
						<td>NAMA PENANGGUNG JAWAB</td>
						<td width="20">:</td>
						<td><input name="nama_penanggung_jawab" type="text" size="40" class="required"></td>
					  </tr>                      
					  <tr>
						<td>BENTUK USAHA</td>
						<td width="20">:</td>
						<td><input name="bentuk_usaha" type="text" size="40" class="required" onkeyup="javascript:this.value=this.value.toUpperCase();">
						<input type="hidden" value="<?php echo $_GET['id']; ?>" name="id_per"></td>
					  </tr>                   
					  <tr height="30">
						<td>JENIS PROGRAM PELATIHAN YANG DISELENGGARAKAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/program/?mode=1&id_per=<?php echo $id_per;?>" id="various1"><b>ISI DATA</b></a><br/></td>
					  </tr>

					  <tr height="30">
						<td>TABEL LAMA LATIHAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/lama_lat/?mode=1&id_per=<?php echo $id_per;?>" id="various2"><b>ISI DATA</b></a><br/></td>
					  </tr>

					  <tr height="30">
						<td>METODE LATIHAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/metode/?mode=1&id_per=<?php echo $id_per;?>" id="various3"><b>ISI DATA</b></a><br/></td>
					  </tr>

					  <tr height="30">
						<td>FASILITAS LATIHAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/alat/?mode=1&id_per=<?php echo $id_per;?>" id="various4"><b>ISI DATA</b></a><br/></td>
					  </tr>
                      
					  <tr height="30">
						<td>DATA INSTRUKTUR</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/pelatih/?mode=1&id_per=<?php echo $id_per;?>" id="various5"><b>ISI DATA</b></a><br/></td>
					  </tr>  

					  <tr height="30">
						<td>NAMA INSTRUKTUR</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/instruktur/?mode=1&id_per=<?php echo $id_per;?>" id="various6"><b>ISI DATA</b></a><br/></td>
					  </tr>  
                                                                                                                            
					  <tr>
						<td>SUMBER SISWA</td>
						<td width="20">:</td>
						<td><input name="sumber_siswa" type="text" class="required" size="40" onkeyup="javascript:this.value=this.value.toUpperCase()">
						</td>
					  </tr>
					  <tr>
						<td>SUMBER BIAYA</td>
						<td width="20">:</td>
						<td><input name="sumber_biaya" type="text" size="40" class="required" onkeyup="javascript:this.value=this.value.toUpperCase()"></td>
					  </tr>
					  <tr>
						<td>SIFAT PERMOHONAN</td>
						<td width="20">:</td>
						<td><input name="sifat" type="text" class="required" size="40"></td>
					  </tr>
				</table>
			</fieldset>
	<fieldset>
		<legend>CHECKLIST PERSYARATAN DAN KELENGKAPAN BERKAS</legend>
		
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
				<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> <input type="submit" onClick="return CekCentang()" value="PROSES">
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