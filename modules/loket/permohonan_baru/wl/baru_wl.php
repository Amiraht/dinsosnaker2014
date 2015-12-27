<script type="text/javascript" src="./libraries/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./libraries/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./libraries/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
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
		});
</script>
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
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat; '> 
      <table border="0" id="atasan">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>PERMOHONAN BARU - WAJIB LAPOR</b></a></td>
            </tr>
            <tr>
            	 <td colspan='2' style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
				  <img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a>
                  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan&opts=baru" id="linkutama"> PROSES BARU </a>
				  <img src="./image/panah.gif"  /><span id="linkutama"> PROSES PENGURUSAN WAJIB LAPOR</span>
                 </td>
                <!--<td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=main'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>-->
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
<td colspan="2" style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=baru'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td></tr>
<tr> 
	<td>
	<h2> &nbsp; PROSES PENGURUSAN WAJIB LAPOR</h2>
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
	$pemohon=$set[11];
	$alamatpemohon=$set[13];
echo"
	<table id='data_awal' name='data_awal' cellpadding='3'  cellspacing='6'	 style='text-transform:uppercase'>
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
	echo "<h2>  &nbsp; *BELUM MELAKUKAN PENGISIAN JUMLAH TENAGA KERJA</h2>";
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
		<legend>DATA  KHUSUS WAJIB LAPOR</legend>
		<form name="form1" method="post" action="./index.php?mod=loket&opt=proses_permohonan&opts=validate_wl&mode=1">
				<table name="biodata" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>TANGGAL PERPINDAHAN PERUSAHAAN</td>
						<td width="20">:</td>
						<td><input name="tgl_pindah" type="date" size="40" id="date1" >
                        	<input type="hidden" value="<?php echo $id_per; ?>" name="id_per">
                            <input type="hidden" value="<?php echo $pemohon; ?>" name="pemohon">
                            <input type="hidden" value="<?php echo $alamatpemohon; ?>" name="alamatpemohon">
                            </td>
					  </tr>
					  <tr>
						<td>ALAMAT LAMA</td>
						<td width="20">:</td>
						<td><input name="alamatlama" id="alamatlama" type="text" size="40" onkeyup="javascript:this.value=this.value.toUpperCase()"></td>
					  </tr>
					  <tr>
						<td>JLH TENAGA KERJA LAKI-LAKI WNI</td>
						<td width="20">:</td>
						<td><input name="wnipria" id="wnipria" type="text" size="40" onkeypress="return isNumberKey(event)"></td>
					  </tr>
					  <tr>
						<td>JLH TENAGA KERJA WANITA WNI</td>
						<td width="20">:</td>
						<td><input name="wniwanita" id="wniwanita" type="text" size="40" onkeypress="return isNumberKey(event)"></td>
					  </tr>
					  <tr>
						<td>JLH TENAGA KERJA LAKI-LAKI WNA</td>
						<td width="20">:</td>
						<td><input name="wnapria" id="wnapria" type="text" size="40" onkeypress="return isNumberKey(event)"></td>
					  </tr>
					  <tr>
						<td>JLH TENAGA KERJA WANITA WNA</td>
						<td width="20">:</td>
						<td><input name="wnawanita" id="wnawanita" type="text" size="40" onkeypress="return isNumberKey(event)"><br/></td>
					  </tr> 
                      
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>   
                      
					  <tr>
						<td>PERINCIAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/tenagakerja/?mode=1&id_per=<?php echo $id_per;?>" id="various1"><b>RINCIAN</b></a><br/></td>
					  </tr> 
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>                                          
					  <tr>
						<td valign="top">WAKTU KERJA</td>
						<td valign="top" width="20">:</td>
						<td><label><input type="checkbox" name="jam1" value="1" >7 JAM/HARI dan 40 JAM/MINGGU</label><br/>
                        <label><input type="checkbox" name="jam2" value="1" >8 JAM/HARI dan 40 JAM/MINGGU</label><br/>
                        <label><input type="checkbox" name="jam3" value="1" >12 JAM/HARI dan 40 JAM/MINGGU</label><br/>
                        <label><input type="checkbox" name="jam4" value="1" >12 JAM/HARI SELAMA 10 HARI TERUS MENERUS</label><br/>
                        <label><input type="checkbox" name="jam5" value="1" >12 JAM/HARI SELAMA 14 HARI TERUS MENERUS</label><br/>
                        <label><input type="checkbox" name="jam6" value="1" >LEBIH LAMA DARI 7 ATAU 8 JAM/HARI DAN 40 JAM/MINGGU KURANG DARI 12 JAM/HARI SELAMA 10 HARI TERUS MENERUS</label><br/>
                        <label><input type="checkbox" name="jam7" value="1" >KURANG ATAU SAMA DENGAN 15 JAM/MINGGU</label><br/>
                        <label><input type="checkbox" name="jam8" value="1" >KURANG ATAU SAMA DENGAN 20 JAM/MINGGU</label><br/>
                        </td>
					  </tr>
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">PENGGUNAAN ALAT DAN BAHAN</td>
						<td valign="top" width="20">:</td>
						<td><label><input type="checkbox" name="alat1" value="1" >PESAWAT UAP</label><br/>
                        <label><input type="checkbox" name="alat2" value="1" >PESAWAT ANGKAT</label><br/>
                        <label><input type="checkbox" name="alat3" value="1" >PESAWAT ANGKUT</label><br/>
                        <label><input type="checkbox" name="alat4" value="1" >PESAWAT LAINNYA</label><br/>
                        <label><input type="checkbox" name="alat5" value="1" >ALAT-ALAT BERAT</label><br/>
                        <label><input type="checkbox" name="alat6" value="1" >MOTOR</label><br/>
                        <label><input type="checkbox" name="alat7" value="1" >INSTALASI LISTRIK</label><br/>
                        <label><input type="checkbox" name="alat8" value="1" >INSTALASI PEMADAM KEBAKARAN</label><br/>
                        <label><input type="checkbox" name="alat9" value="1" >PENYALUR PETIR</label><br/>
                        <label><input type="checkbox" name="alat10" value="1" >PEMBANGKIT LISTRIK</label><br/>
                        <label><input type="checkbox" name="alat11" value="1" >LIFT</label><br/>
                        <label><input type="checkbox" name="alat12" value="1" >BEJANA TEKAN</label><br/>
                        <label><input type="checkbox" name="alat13" value="1" >BAHAN BERACUN DAN BERBAHAYA</label><br/>
                        <label><input type="checkbox" name="alat14" value="1" >TURBIN</label><br/>
                        <label><input type="checkbox" name="alat15" value="1" >BOTOL BAJA</label><br/>
                        <label><input type="checkbox" name="alat16" value="1" >PERANCAH</label><br/>
                        <label><input type="checkbox" name="alat17" value="1" >BAHAN RADIO AKTIF</label><br/>
                        </td>
					  </tr>
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">LIMBAH PRODUKSI</td>
						<td valign="top" width="20">:</td>
						<td><label><input type="checkbox" name="limbah1" value="1" >PADAT</label><br/>
                        <label><input type="checkbox" name="limbah2" value="1" >CAIR</label><br/>
                        <label><input type="checkbox" name="limbah3" value="1" >GAS</label><br/>
                        </td>
					  </tr>  
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>        
					  <tr>
						<td>INSTALASI PENGOLAH LIMBAH</td>
						<td width="20">:</td>
						<td><select name="olah_limbah" id="olah_limbah">
							<option value="0">TIDAK ADA</option>
                            <option value="1">ADA</option>
                            </select>
                        </td>
					  </tr>
					  <tr>
						<td>AMDAL</td>
						<td width="20">:</td>
						<td><select name="amdal" id="amdal">
							<option value="0">TIDAK PERNAH</option>
                            <option value="1">PERNAH ADA</option>
                            </select>
                        </td>
					  </tr>
					  <tr>
						<td>SERTIFIKAT</td>
						<td width="20">:</td>
						<td><input name="sertifikat" type="text" size="40" onkeyup="javascript:this.value=this.value.toUpperCase()"></td>
					  </tr>
					  <tr>
						<td>TANGGAL SERTIFIKAT</td>
						<td width="20">:</td>
						<td><input name="tgl_sertifikat" type="date" size="40" id="date2" ></td>
					  </tr>              
					  <tr>
						<td>JUMLAH UPAH SELURUH PEKERJA YANG DIBAYARKAN</td>
						<td width="20">:</td>
						<td><input name="upah" type="text" size="40" ></td>
					  </tr>                      
 					  <tr>
						<td>TINGKAT UPAH TERTINGGI</td>
						<td width="20">:</td>
						<td><input name="upahtinggi" type="text" size="40" ></td>
					  </tr>                     
 					  <tr>
						<td>TINGKAT UPAH TERENDAH</td>
						<td width="20">:</td>
						<td><input name="upahrendah" type="text" size="40" ></td>
					  </tr>
 					  <tr>
						<td>JUMLAH PEKERJA PENERIMA UMK/UMR</td>
						<td width="20">:</td>
						<td><input name="upahumr" type="text" size="40" ></td>
					  </tr> 
                      
					  <tr>
						<td>TUNJANGAN HARI RAYA KEAGAMAAN</td>
						<td width="20">:</td>
						<td><select name="thr" id="thr">
							<option value="0">1 BULAN UPAH</option>
                            <option value="1">> 1 BULAN UPAH</option>
                            </select>
                        </td>
					  </tr>
					  <tr>
						<td>BONUS/GRATIFIKASI</td>
						<td width="20">:</td>
						<td><select name="bonus" id="bonus">
							<option value="0">1 BULAN GAJI</option>
                            <option value="1">> 1 BULAN GAJI</option>
                            <option value="2">< 1 BULAN GAJI</option>
                            </select>
                        </td>
					  </tr>
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">FASILITAS KESELAMATAN & KESEHATAN KERJA</td>
						<td valign="top" width="20">:</td>
						<td><label><input type="checkbox" name="sehat1" value="1" >P3K</label><br/>
                        <label><input type="checkbox" name="sehat2" value="1" >POLIKLINIK</label><br/>
                        <label><input type="checkbox" name="sehat3" value="1" >DOKTER PEMERIKSA</label><br/>
                        <label><input type="checkbox" name="sehat4" value="1" >AHLI / PETUGAS K3</label><br/>
                        <label><input type="checkbox" name="sehat5" value="1" >PARAMEDIS</label><br/>
                        <label><input type="checkbox" name="sehat6" value="1" >REGU PEMADAM KEBAKARAN</label><br/>
                        </td>
					  </tr> 
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">FASILITAS KESEJAHTERAAN</td>
						<td valign="top" width="20">:</td>
						<td><label><input type="checkbox" name="sejahtera1" value="1" >KOPERASI KARYAWAN</label><br/>
                        <label><input type="checkbox" name="sejahtera2" value="1" >UNIT KB PERUSAHAAN</label><br/>
                        <label><input type="checkbox" name="sejahtera3" value="1" >SARANA IBADAH</label><br/>
                        <label><input type="checkbox" name="sejahtera4" value="1" >PERUMAHAN KARYAWAN</label><br/>
                        <label><input type="checkbox" name="sejahtera5" value="1" >OLAHRAGA DAN KESENIAN</label><br/>
                        <label><input type="checkbox" name="sejahtera6" value="1" >KANTIN</label><br/>
                        <label><input type="checkbox" name="sejahtera7" value="1" >TPA</label><br/>
                        </td>
					  </tr>
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td colspan="3"><b><u>JAMINAN SOSIAL TENAGA KERJA</u></b></td>
                      </tr> 
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>                                                                                                                                     
					  <tr>
						<td>TANGGAL MENJADI PESERTA</td>
						<td width="20">:</td>
						<td><input name="tgl_jamsostek" type="date" size="40" id="date7"></td>
					  </tr>
					  <tr>
						<td>NOMOR PENDAFTARAN</td>
						<td width="20">:</td>
						<td><input name="no_pendaftaran" type="text" size="40"></td>
					  </tr>
					  <tr>
						<td>JUMLAH PESERTA TENAGA KERJA</td>
						<td width="20">:</td>
						<td><input name="peserta_tk" type="text" size="40"></td>
					  </tr>
					  <tr>
						<td>JUMLAH PESERTA KELUARGA</td>
						<td width="20">:</td>
						<td><input name="peserta_keluarga" type="text" size="40"></td>
					  </tr>  
					  <tr>
						<td valign="top">JAMINAN</td>
						<td valign="top" width="20">:</td>
						<td><label><input type="checkbox" name="jaminan1" value="1"  >JAMINAN KECELAKAAN KERJA</label> <select name="jamin1" id="jamin1" >
							<option value="0"></option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            </select><br/>
                        <label><input type="checkbox" name="jaminan2" value="1" >JAMINAN KEMATIAN</label> <select name="jamin2" id="jamin2">
							<option value="0"></option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            </select><br/>
                        <label><input type="checkbox" name="jaminan3" value="1" >JAMINAN HARI TUA</label> <select name="jamin3" id="jamin3">
							<option value="0"></option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            </select><br/>
                        <label><input type="checkbox" name="jaminan4" value="1" >JAMINAN PEMELIHARAAN KESEHATAN</label> <select name="jamin4" id="jamin4">
							<option value="0"></option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            </select><br/>
                        </td>
					  </tr> 
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">PROGRAM PENSIUN</td>
						<td valign="top" width="20">:</td>
						<td><label><input type="checkbox" name="pensiun1" value="1" >DILAKSANAKAN OLEH DANA PENSIUN PEMBERI KERJA</label><br/>
                        <label><input type="checkbox" name="pensiun2" value="1" >DILAKSANAKAN OLEH DANA PENSIUN LEMBAGA KEUANGAN</label><br/>
                        </td>
					  </tr>
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>   
					  <tr>
						<td valign="top">PERANGKAT HUBUNGAN KERJA</td>
						<td valign="top" width="20">:</td>
						<td><label><input type="checkbox" name="hub1" value="1" >PK (PERJANJIAN KERJA)</label><br/>
                        <label><input type="checkbox" name="hub2" value="1" >PP (PERATURAN PERUSAHAAN)</label><br/>
                        <label><input type="checkbox" name="hub3" value="1" >KKB (KESEPAKATAN KERJA BERSAMA)</label><br/>
                        </td>
					  </tr>
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">PERANGKAT ORGANISASI KETENAGAKERJAAN</td>
						<td valign="top" width="20">:</td>
						<td><label><input type="checkbox" name="org1" value="1" >SPTP (SERIKAT PEKERJA TINGKAT PERUSAHAAN)</label><br/>
                        <label><input type="checkbox" name="org2" value="1" >UK SPSI (UNIT KERJA SERIKAT PEKERJA SELURUH INDONESIA)</label><br/>
                        <label><input type="checkbox" name="org3" value="1" >P2K3</label><br/>
                        <label><input type="checkbox" name="org4" value="1" >Apindo (ASOSIASI PERUSAHAAN INDONESIA)</label><br/>
                        </td>
					  </tr>  
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
                      <tr><td colspan="3"><u><b> RENCANA PEKERJA YANG DIBUTUHKAN DALAM 12 BULAN YANG AKAN DATANG </b></u></td></tr>
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>                                                                                                 
					  <tr>
						<td>JUMLAH</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_nanti" type="text" size="40"></td>
					  </tr>
					  <tr>
						<td>LAKI-LAKI</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_nanti_p" type="text" size="40" ></td>
					  </tr>
					  <tr>
						<td>PEREMPUAN</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_nanti_w" type="text" size="40" ></td>
					  </tr> 
                       <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td>PERINCIAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/rencana/?mode=1&id_per=<?php echo $id_per;?>" id="various2"><b>RINCIAN</b></a></td>
					  </tr> 
                      <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
                       <tr><td colspan="3"> &nbsp;&nbsp; </td></tr> 
                       <tr><td colspan="3"><b><u> PEKERJA 12 BULAN TERAKHIR</u></b> </td></tr> 
                       <tr><td colspan="3"> &nbsp;&nbsp; </td></tr> 
					  <tr>
						<td>JUMLAH</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_skrg" type="text" size="40"></td>
					  </tr>
					  <tr>
						<td>LAKI-LAKI</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_skrg_p" type="text" size="40" ></td>
					  </tr>
					  <tr>
						<td>PEREMPUAN</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_skrg_w" type="text" size="40" ></td>
					  </tr> 
                       <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td>PERINCIAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/tk_akhir/?mode=1&id_per=<?php echo $id_per;?>" id="various3"><b>RINCIAN</b></a></td>
					  </tr>
                       <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td>JUMLAH PENERIMAAN PEKERJA SELAMA 12 BULAN TERAKHIR</td>
						<td width="20">:</td>
						<td><input name="jlh_terima" type="text" size="40" ></td>
					  </tr> 
					  <tr>
						<td>JUMLAH PEKERJA YANG BERHENTI SELAMA 12 BULAN TERAKHIR</td>
						<td width="20">:</td>
						<td><input name="jlh_berhenti" type="text" size="40" ></td>
					  </tr>
					  <tr>
						<td>PROGRAM PELATIHAN BAGI PEKERJA</td>
						<td width="20">:</td>
						<td><select name="pelatihan" id="pelatihan">
							<option value="0">TIDAK ADA</option>
                            <option value="1">ADA</option>
                            </select>
                        </td>
					  </tr>  
					  <tr>
						<td>PROGRAM PEMAGANGAN</td>
						<td width="20">:</td>
						<td><select name="pemagangan" id="pemagangan">
							<option value="0">TIDAK ADA</option>
                            <option value="1">ADA</option>
                            </select>
                        </td>
					  </tr> 
					  <tr>
						<td>FASILITAS PELATIHAN</td>
						<td width="20">:</td>
						<td><select name="fasilitas" id="fasilitas">
							<option value="0">TIDAK ADA</option>
                            <option value="1">ADA</option>
                            </select>
                        </td>
					  </tr> 					  <tr>
						<td>PROGRAM PENGINDONESIAAN</td>
						<td width="20">:</td>
						<td><select name="pengindonesiaan" id="pengindonesiaan">
							<option value="0">TIDAK ADA</option>
                            <option value="1">ADA</option>
                            </select>
                        </td>
                         <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td>PERENCANAAN KEBUTUHAN LATIHAN BAGI PEKERJA</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/latihan/?mode=1&id_per=<?php echo $id_per;?>" id="various4"><b>RINCIAN</b></a></td>
					  </tr>	
                       <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>			
				</table>
			</fieldset>
	<fieldset>
		<legend>CHECKLIST PERSYARATAN DAN KELENGKAPAN BERKAS</legend>
		
			  <p>
				<label>
				  <input type="checkbox" name="berkas" value="1" id="berkas_0">
				  FOTOCOPY AKTE NOTARIS</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="2" id="berkas_1">
				 FOTOCOPY SIUP YANG BERLAKU</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="3" id="berkas_2">
				  FOTOCOPY TDP YANG BERLAKU</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="4" id="berkas_3">
				  FOTOCOPY JAMSOSTEK YANG BERLAKU</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="5" id="berkas_4">
				  FORM WAJIB LAPOR YANG TELAH DIISI</label>
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