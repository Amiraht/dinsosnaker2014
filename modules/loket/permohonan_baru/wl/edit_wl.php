<script type="text/javascript" src="./libraries/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./libraries/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./libraries/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script language="javascript"> 
	function CekAll() {
		document.getElementById("btn").disabled=false;
		checkboxes = document.getElementsByName('berkas');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = true;
		}
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
	function kirim_kendali()
	{
		var no_resi ='<?php echo $_GET["no_resi"]; ?>';
		var id_user ='<?php echo $_SESSION["id_user"]; ?>';
		var s;
		s='./index.php?mod=loket&opt=lembar_disposisi';
		if(no_resi != '')
		s=s+'&link='+no_resi;
		if(id_user != '')
		s=s+'&id_user='+id_user;
		
		document.location.href=s;
	} 
	function kirim_edit()
	{
		var no_resi ='<?php echo $_GET["no_resi"]; ?>';
	
		var s;
		s='./index.php?mod=loket&opt=proses_permohonan&opts=edit_pengaduan';
		if(no_resi != '')
		s=s+'&no_resi='+no_resi;
		document.location.href=s;
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
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat; '> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#"><b>PERMOHONAN BARU - WAJIB LAPOR</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
				  <img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a>
				  <img src="./image/panah.gif"  /><span id="linkutama"> PROSES PENGURUSAN WAJIB LAPOR</span>
                 </td>
                
            </tr>
        </table> 
    </div>
    </td>
</tr>
<tr>
<td style="float:right;">
					<img width="90" height="29" 
						onclick="document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=perbaikan'" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>

</tr>
<tr>
	<td>
    <br/>
		<h2> &nbsp; PROSES PENGURUSAN WAJIB LAPOR - VERIFIKASI DATA</h2><br/>
		<fieldset>
		<legend>DATA KHUSUS WAJIB LAPOR</legend>
<?php 
$no_resi = $_GET["no_resi"];
$query=mysql_query("SELECT * FROM tbl_berkas_wl WHERE no_resi='$no_resi'");
$result=mysql_fetch_array($query);

if($result)
{
//$id_negara = $result["kewarganegaraan"];
//$negara = mysql_query("select * from t_negara");
//<form method="post" action="./index.php?mod=loket&opt=proses_permohonan&opts=resi&id='.$no_resi.'">
echo'	<form method="post" action="./index.php?mod=loket&opt=proses_permohonan&opts=validate_wl&mode=2">
		<table name="biodata" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>TANGGAL PERPINDAHAN PERUSAHAAN</td>
						<td width="20">:</td>
						<td><input name="tgl_pindah" type="date" size="40" id="date1" value="'.$result["tgl_pindah"].'">
                        	<input type="hidden" value="'.$result["id_perusahaan"].'" name="id_per">
                            <input type="hidden" value="'.$result["pemohon"].'" name="pemohon">
                            <input type="hidden" value="'.$result["alamatpemohon"].'" name="alamatpemohon">
							<input type="hidden" value="'.$result["no_resi"].'" name="no_resi">
                            </td>
					  </tr>
					  <tr>
						<td>ALAMAT LAMA</td>
						<td width="20">:</td>
						<td><input name="alamatlama" id="alamatlama" type="text" size="40" value="'.$result["alamatlama"].'" onkeyup="javascript:this.value=this.value.toUpperCase()"></td>
					  </tr>
					  <tr>
						<td>JLH TENAGA KERJA LAKI-LAKI WNI</td>
						<td width="20">:</td>
						<td><input name="wnipria" id="wnipria" type="text" size="40" value="'.$result["wnipria"].'"onkeypress="return isNumberKey(event)"></td>
					  </tr>
					  <tr>
						<td>JLH TENAGA KERJA WANITA WNI</td>
						<td width="20">:</td>
						<td><input name="wniwanita" id="wniwanita" type="text" size="40" value="'.$result["wniwanita"].'" onkeypress="return isNumberKey(event)"></td>
					  </tr>
					  <tr>
						<td>JLH TENAGA KERJA LAKI-LAKI WNA</td>
						<td width="20">:</td>
						<td><input name="wnapria" id="wnapria" type="text" size="40" value="'.$result["wnapria"].'"  onkeypress="return isNumberKey(event)"></td>
					  </tr>
					  <tr>
						<td>JLH TENAGA KERJA WANITA WNA</td>
						<td width="20">:</td>
						<td><input name="wnawanita" id="wnawanita" type="text" size="40" value="'.$result["wnawanita"].'"  onkeypress="return isNumberKey(event)"></td>
					  </tr> 
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td>PERINCIAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/tenagakerja/?mode=1&id_per='.$result["id_perusahaan"].'" id="various1"><b>RINCIAN</b></a></td>
					  </tr>
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>  					                      
					  <tr>
						<td valign="top">WAKTU KERJA</td>
						<td valign="top" width="20">:</td>';
						if($result["jam1"]==1)
							{echo'<td><label><input type="checkbox" name="jam1" checked value="1" >7 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" name="jam1"  value="1" >7 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						if($result["jam2"]==1)
                        	{echo'<label><input type="checkbox" name="jam2" checked value="1" >8 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam2" value="1" >8 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						if($result["jam3"]==1)					
                        	{echo'<label><input type="checkbox" name="jam3" checked value="1" >12 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam3" value="1" >12 JAM/HARI dan 40 JAM/MINGGU</label><br/>';}
						if($result["jam4"]==1)	
                        	{echo'<label><input type="checkbox" name="jam4" checked value="1" >12 JAM/HARI SELAMA 10 HARI TERUS MENERUS</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam4" value="1" >12 JAM/HARI SELAMA 10 HARI TERUS MENERUS</label><br/>';}
						if($result["jam5"]==1)
							{echo'<label><input type="checkbox" checked name="jam5" value="1" >12 JAM/HARI SELAMA 14 HARI TERUS MENERUS</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam5" value="1" >12 JAM/HARI SELAMA 14 HARI TERUS MENERUS</label><br/>';}
                        if($result["jam6"]==1)
							{echo'<label><input type="checkbox" name="jam6" checked value="1" >LEBIH LAMA DARI 7 ATAU 8 JAM/HARI DAN 40 JAM/MINGGU KURANG DARI 12 JAM/HARI SELAMA 10 HARI TERUS MENERUS</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam6" value="1" >LEBIH LAMA DARI 7 ATAU 8 JAM/HARI DAN 40 JAM/MINGGU KURANG DARI 12 JAM/HARI SELAMA 10 HARI TERUS MENERUS</label><br/>';}
						if($result["jam7"]==1)
                        	{echo'<label><input type="checkbox" checked name="jam7" value="1" >KURANG ATAU SAMA DENGAN 15 JAM/MINGGU</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam7" value="1" >KURANG ATAU SAMA DENGAN 15 JAM/MINGGU</label><br/>';}
						if($result["jam8"]==1)
                        	{echo'<label><input type="checkbox" checked name="jam8" value="1" >KURANG ATAU SAMA DENGAN 20 JAM/MINGGU</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="jam8" value="1" >KURANG ATAU SAMA DENGAN 20 JAM/MINGGU</label><br/>';}
						echo
                        '</td>
					  </tr>
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">PENGGUNAAN ALAT DAN BAHAN</td>
						<td valign="top" width="20">:</td>';
						if($result["alat1"]==1)
							{echo'<td><label><input type="checkbox" checked name="alat1" value="1" >PESAWAT UAP</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" name="alat1" value="1" >PESAWAT UAP</label><br/>';}
						if($result["alat2"]==1)
							{echo'<label><input type="checkbox" checked name="alat2" value="1" >PESAWAT ANGKAT</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat2" value="1" >PESAWAT ANGKAT</label><br/>';}
						if($result["alat3"]==1)
							{echo'<label><input type="checkbox" checked name="alat3" value="1" >PESAWAT ANGKUT</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat3" value="1" >PESAWAT ANGKUT</label><br/>';}
						if($result["alat4"]==1)
							{echo'<label><input type="checkbox" checked name="alat4" value="1" >PESAWAT LAINNYA</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat4" value="1" >PESAWAT LAINNYA</label><br/>';}
						if($result["alat5"]==1)
							{echo'<label><input type="checkbox" checked name="alat5" value="1" >ALAT-ALAT BERAT</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat5" value="1" >ALAT-ALAT BERAT</label><br/>';}
						if($result["alat6"]==1)
							{echo'<label><input type="checkbox" checked name="alat6" value="1" >MOTOR</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat6" value="1" >MOTOR</label><br/>';}
						if($result["alat7"]==1)
							{echo'<label><input type="checkbox" checked name="alat7" value="1" >INSTALASI LISTRIK</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat7" value="1" >INSTALASI LISTRIK</label><br/>';}
						if($result["alat8"]==1)
							{echo'<label><input type="checkbox" checked name="alat8" value="1" >INSTALASI PEMADAM KEBAKARAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat8" value="1" >INSTALASI PEMADAM KEBAKARAN</label><br/>';}
						if($result["alat9"]==1)
							{echo'<label><input type="checkbox" checked name="alat9" value="1" >PENYALUR PETIR</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat9" value="1" >PENYALUR PETIR</label><br/>';}
						if($result["alat10"]==1)
							{echo'<label><input type="checkbox" checked name="alat10" value="1" >PEMBANGKIT LISTRIK</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat10" value="1" >PEMBANGKIT LISTRIK</label><br/>';}
						if($result["alat11"]==1)
							{echo'<label><input type="checkbox" checked name="alat11" value="1" >LIFT</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat11" value="1" >LIFT</label><br/>';}
						if($result["alat12"]==1)
							{echo'<label><input type="checkbox" checked name="alat12" value="1" >BEJANA TEKAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat12" value="1" >BEJANA TEKAN</label><br/>';}
						if($result["alat13"]==1)
							{echo'<label><input type="checkbox" checked name="alat13" value="1" >BAHAN BERACUN DAN BERBAHAYA</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat13" value="1" >BAHAN BERACUN DAN BERBAHAYA</label><br/>';}
						if($result["alat14"]==1)
							{echo'<label><input type="checkbox" checked name="alat14" value="1" >TURBIN</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat14" value="1" >TURBIN</label><br/>';}
						if($result["alat15"]==1)
							{echo'<label><input type="checkbox" checked name="alat15" value="1" >BOTOL BAJA</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat15" value="1" >BOTOL BAJA</label><br/>';}
						if($result["alat16"]==1)
							{echo'<label><input type="checkbox" checked name="alat16" value="1" >PERANCAH</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat16" value="1" >PERANCAH</label><br/>';}
						if($result["alat17"]==1)
							{echo'<label><input type="checkbox" checked name="alat17" value="1" >BAHAN RADIO AKTIF</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="alat17" value="1" >BAHAN RADIO AKTIF</label><br/>';}
						echo'
                        </td>
					  </tr>
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td valign="top">LIMBAH PRODUKSI</td>
						<td valign="top" width="20">:</td>';
						if($result["limbah1"]==1)
							{echo'<td><label><input type="checkbox" checked  name="limbah1" value="1" >PADAT</label><br/>';}
						else
							{echo'<td><label><input type="checkbox"  name="limbah1" value="1" >PADAT</label><br/>';}
						if($result["limbah2"]==1)
							{echo'<label><input type="checkbox" checked  name="limbah2" value="1" >CAIR</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="limbah2" value="1" >CAIR</label><br/>';}
						if($result["limbah3"]==1)
							{echo'<label><input type="checkbox" checked  name="limbah3" value="1" >GAS</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="limbah3" value="1" >GAS</label><br/>';}
						echo'
                        </td>
					  </tr>    
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>      
					  <tr>
						<td>INSTALASI PENGOLAH LIMBAH</td>
						<td width="20">:</td>
						<td><select name="olah_limbah" id="olah_limbah">';
							if($result["olah_limbah"]==0)
								{echo'<option selected value="0">TIDAK ADA</option>';}
							else
								{echo'<option value="0">TIDAK ADA</option>';}
							if($result["olah_limbah"]==1)
                            	{echo'<option selected value="1">ADA</option>';}
							else
								{echo'<option value="1">ADA</option>';}
							echo'
                            </select>
                        </td>
					  </tr>
					  <tr>
						<td>AMDAL</td>
						<td width="20">:</td>
						<td><select name="amdal" id="amdal">';
							if($result["amdal"]==0)
								{echo'<option selected value="0">TIDAK PERNAH</option>';}
							else
								{echo'<option value="0">TIDAK PERNAH</option>';}
							if($result["amdal"]==1)
                            	{echo'<option selected value="1"> ADA</option>';}
							else
								{echo'<option value="1">PERNAH ADA</option>';}
							echo'					
                            </select>
                        </td>
					  </tr>
					  <tr>
						<td>SERTIFIKAT</td>
						<td width="20">:</td>
						<td><input name="sertifikat" type="text" size="40" value="'.$result["sertifikat"].'"onkeyup="javascript:this.value=this.value.toUpperCase()"></td>
					  </tr>
					  <tr>
						<td>TANGGAL SERTIFIKAT</td>
						<td width="20">:</td>
						<td><input name="tgl_sertifikat" type="date" value="'.$result["tgl_sertifikat"].'" size="40" id="date2" ></td>
					  </tr>              
					  <tr>
						<td>JUMLAH UPAH SELURUH PEKERJA YANG DIBAYARKAN</td>
						<td width="20">:</td>
						<td><input name="upah" type="text" size="40" value="'.$result["jlh_upah"].'"></td>
					  </tr>                      
 					  <tr>
						<td>TINGKAT UPAH TERTINGGI</td>
						<td width="20">:</td>
						<td><input name="upahtinggi" type="text" size="40" value="'.$result["upah_tinggi"].'"></td>
					  </tr>                     
 					  <tr>
						<td>TINGKAT UPAH TERENDAH</td>
						<td width="20">:</td>
						<td><input name="upahrendah" type="text" size="40" value="'.$result["upah_rendah"].'"></td>
					  </tr>	
 					  <tr>
						<td>JUMLAH PEKERJA PENERIMA UMK/UMR</td>
						<td width="20">:</td>
						<td><input name="upahumr" type="text" size="40" value="'.$result["jlh_umr"].'"></td>
					  </tr> 
					  <tr>
						<td>TUNJANGAN HARI RAYA KEAGAMAAN</td>
						<td width="20">:</td>
						<td><select name="thr" id="thr">';
							if($result["thr"]==0)
								{echo'<option selected value="0">1 BULAN UPAH</option>';}
							else
								{echo'<option value="0">1 BULAN UPAH</option>';}
							if($result["thr"]==1)
                            	{echo'<option selected value="1">> 1 BULAN UPAH</option>';}
							else
								{echo'<option value="1">> 1 BULAN UPAH</option>';}
							echo'							
                            </select>
                        </td>
					  </tr>
					  <tr>
						<td>BONUS/GRATIFIKASI</td>
						<td width="20">:</td>
						<td><select name="bonus" id="bonus">';
							if($result["bonus"]==0)
								{echo'<option selected value="0">1 BULAN GAJI</option>';}
							else
								{echo'<option value="0">1 BULAN GAJI</option>';}
							if($result["bonus"]==1)
                            	{echo'<option selected value="1">> 1 BULAN GAJI</option>';}
							else
								{echo'<option value="1">> 1 BULAN GAJI</option>';}
							if($result["bonus"]==2)
                            	{echo'<option selected value="1">< 1 BULAN GAJI</option>';}
							else
								{echo'<option value="1">< 1 BULAN GAJI</option>';}								
							echo'							
                            </select>
                        </td>
					  </tr>	
					  <tr><td>&nbsp;</td></tr>
					  <tr>
						<td valign="top">FASILITAS KESELAMATAN & KESEHATAN KERJA</td>
						<td valign="top" width="20">:</td>';
						if($result["sehat1"]==1)
							{echo'<td><label><input type="checkbox" checked  name="sehat1" value="1" >P3KP</label><br/>';}
						else
							{echo'<td><label><input type="checkbox"  name="sehat1" value="1" >P3K</label><br/>';}
						if($result["sehat2"]==1)
							{echo'<label><input type="checkbox" checked  name="sehat2" value="1" >POLIKLINIK</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="sehat2" value="1" >POLIKLINIK</label><br/>';}
						if($result["sehat3"]==1)
							{echo'<label><input type="checkbox" checked  name="sehat3" value="1" >DOKTER PEMERIKSA</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="sehat3" value="1" >DOKTER PEMERIKSA</label><br/>';}
						if($result["sehat4"]==1)
							{echo'<label><input type="checkbox" checked  name="sehat4" value="1" >AHLI / PETUGAS K3</label><br/>';}
						else
							{echo'<label><input type="checkbox"  name="sehat4" value="1" >AHLI / PETUGAS K3</label><br/>';}
						if($result["sehat5"]==1)
							{echo'<label><input type="checkbox" checked  name="sehat5" value="1" >PARAMEDIS</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="sehat5" value="1" >PARAMEDIS</label><br/>';}
						if($result["sehat6"]==1)
							{echo'<label><input type="checkbox" checked  name="sehat6" value="1" >REGU PEMADAM KEBAKARAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="sehat6" value="1" >REGU PEMADAM KEBAKARAN</label><br/>';}							
						echo'						
                        </td>
					  </tr> 
					  <tr><td>&nbsp;</td></tr>
					  <tr>
						<td valign="top">FASILITAS KESEJAHTERAAN</td>
						<td valign="top" width="20">:</td>';
						if($result["sejahtera1"]==1)
							{echo'<td><label><input type="checkbox" checked  name="sejahtera1" value="1" >KOPERASI KARYAWAN</label><br/>';}
						else
							{echo'<td><label><input type="checkbox"  name="sejahtera1" value="1" >KOPERASI KARYAWAN</label><br/>';}
						if($result["sejahtera2"]==1)
							{echo'<label><input type="checkbox" checked  name="sejahtera2" value="1" >UNIT KB PERUSAHAAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="sejahtera2" value="1" >UNIT KB PERUSAHAAN</label><br/>';}
						if($result["sejahtera3"]==1)
							{echo'<label><input type="checkbox" checked  name="sejahtera3" value="1" >SARANA IBADAH</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="sejahtera3" value="1" >SARANA IBADAH</label><br/>';}
						if($result["sejahtera4"]==1)
							{echo'<label><input type="checkbox" checked  name="sejahtera4" value="1" >PERUMAHAN KARYAWAN</label><br/>';}
						else
							{echo'<label><input type="checkbox"  name="sejahtera4" value="1" >PERUMAHAN KARYAWAN</label><br/>';}
						if($result["sejahtera5"]==1)
							{echo'<label><input type="checkbox" checked  name="sejahtera5" value="1" >OLAHRAGA DAN KESENIAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="sejahtera5" value="1" >OLAHRAGA DAN KESENIAN</label><br/>';}
						if($result["sejahtera6"]==1)
							{echo'<label><input type="checkbox" checked  name="sejahtera6" value="1" >KANTIN</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="sejahtera6" value="1" >KANTIN</label><br/>';}		
						if($result["sejahtera7"]==1)
							{echo'<label><input type="checkbox" checked  name="sejahtera7" value="1" >TPA</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="sejahtera7" value="1" >TPA</label><br/>';}														
						echo'						
                        </td>
					  </tr>
					  <tr><td>&nbsp;</td></tr>	
					  <tr>
						<td><b><u>JAMINAN SOSIAL TENAGA KERJA</u></b></td>
                      </tr>  
					  <tr><td>&nbsp;</td></tr>                                                                                                                                    
					  <tr>
						<td>TANGGAL MENJADI PESERTA</td>
						<td width="20">:</td>
						<td><input name="tgl_jamsostek" type="date" size="40" id="date7" value="'.$result["tgl_jamsostek"].'"></td>
					  </tr>
					  <tr>
						<td>NOMOR PENDAFTARAN</td>
						<td width="20">:</td>
						<td><input name="no_pendaftaran" type="text" size="40" value="'.$result["no_pendaftaran"].'"></td>
					  </tr>
					  <tr>
						<td>JUMLAH PESERTA TENAGA KERJA</td>
						<td width="20">:</td>
						<td><input name="peserta_tk" type="text" size="40" value="'.$result["peserta_tk"].'"></td>
					  </tr>
					  <tr>
						<td>JUMLAH PESERTA KELUARGA</td>
						<td width="20">:</td>
						<td><input name="peserta_keluarga" type="text" size="40" value="'.$result["peserta_keluarga"].'"></td>
					  </tr>  
					  <tr>
						<td valign="top">JAMINAN</td>
						<td valign="top" width="20">:</td>';
						if($result["jaminan1"]==0)
							{echo'<td><label><input type="checkbox" name="jaminan1" value="1" >JAMINAN KECELAKAAN KERJA</label> <select name="jamin1" id="jamin1">';}
						else
							{echo'<td><label><input type="checkbox" checked name="jaminan1" value="1" >JAMINAN KECELAKAAN KERJA</label> <select name="jamin1" id="jamin1">';}
							if($result["jamin1"]==0)
								{echo'<option selected value="0"></option>';}
							else
								{echo'<option value="0"></option>';}
							if($result["jamin1"]=='A')
								{echo'<option selected value="A">A</option>';}
							else
								{echo'<option value="A">A</option>';}
							if($result["jamin1"]=='B')
                            	{echo'<option selected value="B">B</option>';}
							else
								{echo'<option value="B">B</option>';}
							if($result["jamin1"]=='C')
                            	{echo'<option selected value="C">C</option>';}
							else
								{echo'<option value="C">C</option>';}								
							echo'							
                            </select><br/>';
						if($result["jaminan2"]==0)
							{echo'<label><input type="checkbox" name="jaminan2" value="1" >JAMINAN KEMATIAN</label> <select name="jamin2" id="jamin2">';}
						else
							{echo'<label><input type="checkbox" checked name="jaminan2" value="1" >JAMINAN KEMATIAN</label> <select name="jamin2" id="jamin2">';}							
							if($result["jamin1"]==0)
								{echo'<option selected value="0"></option>';}
							else
								{echo'<option value="0"></option>';}							
							if($result["jamin2"]=='A')
								{echo'<option selected value="A">A</option>';}
							else
								{echo'<option value="A">A</option>';}
							if($result["jamin2"]=='B')
                            	{echo'<option selected value="B">B</option>';}
							else
								{echo'<option value="B">B</option>';}
							if($result["jamin2"]=='C')
                            	{echo'<option selected value="C">C</option>';}
							else
								{echo'<option value="C">C</option>';}								
							echo'	                        
                            </select><br/>';
						if($result["jaminan3"]==0)
							{echo'<label><input type="checkbox" name="jaminan3" value="1" >JAMINAN HARI TUA</label> <select name="jamin3" id="jamin3">';}
						else
							{echo'<label><input type="checkbox" checked name="jaminan3" value="1" >JAMINAN HARI TUA</label> <select name="jamin3" id="jamin3">';}							
							if($result["jamin1"]==0)
								{echo'<option selected value="0"></option>';}
							else
								{echo'<option value="0"></option>';}							
							if($result["jamin3"]=='A')
								{echo'<option selected value="A">A</option>';}
							else
								{echo'<option value="0">A</option>';}
							if($result["jamin3"]=='B')
                            	{echo'<option selected value="B">B</option>';}
							else
								{echo'<option value="B">B</option>';}
							if($result["jamin3"]=='C')
                            	{echo'<option selected value="C">C</option>';}
							else
								{echo'<option value="C">C</option>';}								
							echo'	                        
                            </select><br/>';
						if($result["jaminan4"]==0)
							{echo'<label><input type="checkbox" name="jaminan4" value="1" >JAMINAN PEMELIHARAAN KESEHATAN</label> <select name="jamin4" id="jamin4">';}
						else
							{echo'<label><input type="checkbox" checked name="jaminan4" value="1" >JAMINAN PEMELIHARAAN KESEHATAN</label> <select name="jamin4" id="jamin4">';}								
							if($result["jamin1"]==0)
								{echo'<option selected value="0"></option>';}
							else
								{echo'<option value="0"></option>';}							
							if($result["jamin4"]=='A')
								{echo'<option selected value="A">A</option>';}
							else
								{echo'<option value="A">A</option>';}
							if($result["jamin4"]=='B')
                            	{echo'<option selected value="B">B</option>';}
							else
								{echo'<option value="B">B</option>';}
							if($result["jamin4"]=='C')
                            	{echo'<option selected value="C">C</option>';}
							else
								{echo'<option value="C">C</option>';}								
							echo'                        
                            </select><br/>
                        </td>
					  </tr> 
					  <tr><td>&nbsp;</td></tr>
					  <tr>
						<td valign="top">PROGRAM PENSIUN</td>
						<td valign="top" width="20">:</td>';
						if($result["pensiun1"]==0)
							{echo'<td><label><input type="checkbox" name="pensiun1" value="1" >DILAKSANAKAN OLEH DANA PENSIUN PEMBERI KERJA</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" checked name="pensiun1" value="1" >DILAKSANAKAN OLEH DANA PENSIUN PEMBERI KERJA</label><br/>';}
						if($result["pensiun2"]==0)
							{echo'<label><input type="checkbox" name="pensiun2" value="1" >DILAKSANAKAN OLEH DANA PENSIUN LEMBAGA KEUANGAN</label><br/>';}
						else
							{echo'<label><input type="checkbox" checked name="pensiun2" value="1" >DILAKSANAKAN OLEH DANA PENSIUN LEMBAGA KEUANGAN</label><br/>';}
						echo'
                        </td>
					  </tr>
					  <tr><td>&nbsp;</td></tr>   
					  <tr>
						<td valign="top">PERANGKAT HUBUNGAN KERJA</td>
						<td valign="top" width="20">:</td>';
						if($result["hub1"]==0)
							{echo'<td><label><input type="checkbox" name="hub1" value="1" >PK (PERJANJIAN KERJA)</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" checked name="hub1" value="1" >PK (PERJANJIAN KERJA)</label><br/>';}
						if($result["hub2"]==0)
							{echo'<label><input type="checkbox" name="hub2" value="1" >PP (PERATURAN PERUSAHAAN)</label><br/>';}
						else
							{echo'<label><input type="checkbox" name="hub2" value="1" >PP (PERATURAN PERUSAHAAN)</label><br/>';}
						if($result["hub3"]==0)
							{echo'<label><input type="checkbox" name="hub3" value="1" >KKB (KESEPAKATAN KERJA BERSAMA)</label><br/>';}
						else
							{echo'<label><input type="checkbox" checked name="hub3" value="1" >KKB (KESEPAKATAN KERJA BERSAMA)</label><br/>';}																			
                        echo'
                        </td>
					  </tr>	
					  <tr><td>&nbsp;</td></tr>
					  <tr>
						<td valign="top">PERANGKAT ORGANISASI KETENAGAKERJAAN</td>
						<td valign="top" width="20">:</td>';
						if($result["org1"]==0)
							{echo'<td><label><input type="checkbox" name="org1" value="1" >SPTP (SERIKAT PEKERJA TINGKAT PERUSAHAAN)</label><br/>';}
						else
							{echo'<td><label><input type="checkbox" checked name="org1" value="1" >SPTP (SERIKAT PEKERJA TINGKAT PERUSAHAAN)</label><br/>';}
						if($result["org2"]==0)
							{echo'<label><input type="checkbox" name="org2" value="1" >UK SPSI (UNIT KERJA SERIKAT PEKERJA SELURUH INDONESIA)</label><br/>';}
						else
							{echo'<label><input type="checkbox" checked name="org2" value="1" >UK SPSI (UNIT KERJA SERIKAT PEKERJA SELURUH INDONESIA)</label><br/>';}
						if($result["org3"]==0)
							{echo'<label><input type="checkbox" name="org3" value="1" >P2K3</label><br/>';}
						else
							{echo'<label><input type="checkbox" checked name="org3" value="1" >P2K3</label><br/>';}	
						if($result["org4"]==0)
							{echo'<label><input type="checkbox" name="org4" value="1" >Apindo (ASOSIASI PERUSAHAAN INDONESIA)</label><br/>';}
						else
							{echo'<label><input type="checkbox" checked name="org4" value="1" >Apindo (ASOSIASI PERUSAHAAN INDONESIA)</label><br/>';}																			
                        echo'
                        </td>
					  </tr>   
					  <tr><td>&nbsp;</td></tr>                                                                                                
					  <tr>
						<td>RENCANA PEKERJA YANG DIBUTUHKAN DALAM 12 BULAN YANG AKAN DATANG, JUMLAH</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_nanti" type="text" size="40" value="'.$result["jlh_tk_nanti"].'"></td>
					  </tr>
					  <tr>
						<td>LAKI_LAKI</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_nanti_p" type="text" size="40" value="'.$result["jlh_tk_nanti_p"].'"></td>
					  </tr>
					  <tr>
						<td>PEREMPUAN</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_nanti_w" type="text" size="40" value="'.$result["jlh_tk_nanti_w"].'"></td>
					  </tr> 
					  <tr><td>&nbsp;</td></tr>
					  <tr>
						<td>PERINCIAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/rencana/?mode=1&id_per='.$result["id_perusahaan"].'" id="various2"><b>RINCIAN</b></a></td>
					  </tr>  
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr><td colspan="3"><b><u> PEKERJA 12 BULAN TERAKHIR</u></b> </td></tr>
					  <tr><td colspan="3"> &nbsp;&nbsp; </td></tr>
					  <tr>
						<td>JUMLAH</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_skrg" type="text" size="40" value="'.$result["jlh_tk_skrg"].'"></td>
					  </tr>
					  <tr>
						<td>LAKI_LAKI</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_skrg_p" type="text" size="40" value="'.$result["jlh_tk_skrg_p"].'"></td>
					  </tr>
					  <tr>
						<td>PEREMPUAN</td>
						<td width="20">:</td>
						<td><input name="jlh_tk_skrg_w" type="text" size="40" value="'.$result["jlh_tk_skrg_w"].'"></td>
					  </tr> 
					  <tr><td>&nbsp;</td></tr>
					  <tr>
						<td>PERINCIAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/tk_akhir/?mode=1&id_per='.$result["id_perusahaan"].'" id="various3"><b>RINCIAN</b></a></td>
					  </tr>
					  <tr><td>&nbsp;</td></tr>
					  <tr>
						<td>JUMLAH PENERIMAAN PEKERJA SELAMA 12 BULAN TERAKHIR</td>
						<td width="20">:</td>
						<td><input name="jlh_terima" type="text" size="40" value="'.$result["jlh_terima"].'"></td>
					  </tr> 
					  <tr>
						<td>JUMLAH PEKERJA YANG BERHENTI SELAMA 12 BULAN TERAKHIR</td>
						<td width="20">:</td>
						<td><input name="jlh_berhenti" type="text" size="40" value="'.$result["jlh_berhenti"].'"></td>
					  </tr>
					  <tr>
						<td>PROGRAM PELATIHAN BAGI PEKERJA</td>
						<td width="20">:</td>
						<td><select name="pelatihan" id="pelatihan">';
							if($result["pelatihan"]==0)
								{echo'<option selected value="0">TIDAK ADA</option>';}
							else
								{echo'<option value="0">TIDAK ADA</option>';}
							if($result["pelatihan"]==1)
                            	{echo'<option selected value="1">ADA</option>';}
							else
								{echo'<option value="1">ADA</option>';}
							echo'						
                            </select>
                        </td>
					  </tr>  
					  <tr>
						<td>PROGRAM PEMAGANGAN</td>
						<td width="20">:</td>
						<td><select name="pemagangan" id="pemagangan">';
							if($result["pemagangan"]==0)
								{echo'<option selected value="0">TIDAK ADA</option>';}
							else
								{echo'<option value="0">TIDAK ADA</option>';}
							if($result["pemagangan"]==1)
                            	{echo'<option selected value="1">ADA</option>';}
							else
								{echo'<option value="1">ADA</option>';}
							echo'							
                            </select>
                        </td>
					  </tr> 
					  <tr>
						<td>FASILITAS PELATIHAN</td>
						<td width="20">:</td>
						<td><select name="fasilitas" id="fasilitas">';
							if($result["fasilitas"]==0)
								{echo'<option selected value="0">TIDAK ADA</option>';}
							else
								{echo'<option value="0">TIDAK ADA</option>';}
							if($result["fasilitas"]==1)
                            	{echo'<option selected value="1">ADA</option>';}
							else
								{echo'<option value="1">ADA</option>';}
							echo'	
                            </select>
                        </td>
					  </tr>
					  <tr>
						<td>PROGRAM PENGINDONESIAAN</td>
						<td width="20">:</td>
						<td><select name="pengindonesiaan" id="pengindonesiaan">';
							if($result["pengindonesiaan"]==0)
								{echo'<option selected value="0">TIDAK ADA</option>';}
							else
								{echo'<option value="0">TIDAK ADA</option>';}
							if($result["pengindonesiaan"]==1)
                            	{echo'<option selected value="1">ADA</option>';}
							else
								{echo'<option value="1">ADA</option>';}
							echo'
                            </select>
                        </td>
						</tr>
						<tr><td>&nbsp;</td></tr>
					  <tr>
						<td>PERENCANAAN KEBUTUHAN LATIHAN BAGI PEKERJA</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/latihan/?mode=1&id_per='.$result["id_perusahaan"].'" id="various4"><b>RINCIAN</b></a></td>
					  </tr>	
					  <tr><td>&nbsp;</td></tr>
					  </table>';
}
else{
	echo "<script type='text/javascript'>
				alert('DATA TIDAK DITEMUKAN');
				document.location.href='index.php?mod=loket&opt=proses_permohonan&opts=baru';
		</script>";		
}?>
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
			  </p><center><input type="button" onClick="CekAll()" value="CENTANG SEMUA"> <input type="submit" onClick="return CekCentang()" value="PROSES" id="btn" >
        	  </center>
        </fieldset>

  <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>
