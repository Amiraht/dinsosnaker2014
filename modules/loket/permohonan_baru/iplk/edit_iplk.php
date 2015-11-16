<script type="text/javascript" src="./libraries/jquery.validate.js"></script>
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

</script>
<script type="text/javascript">
		$(document).ready(function(){
        $("#tgl_surat").datepicker({
					dateFormat  : "yy-mm-dd",changeMonth : true,changeYear  : true					
        });
		});
		$(document).ready(function(){
        $("#tgl_pp").datepicker({
					dateFormat  : "yy-mm-dd",changeMonth : true,changeYear  : true					
        });
		});
		$(document).ready(function(){
        $("#berlaku_sampai").datepicker({
					dateFormat  : "yy-mm-dd",changeMonth : true,changeYear  : true					
        });
		});
		$(document).ready(function(){
        $("#tgl_imta").datepicker({
					dateFormat  : "yy-mm-dd",changeMonth : true,changeYear  : true					
        });
		});
		$(document).ready(function(){
        $("#tgl_berakhir").datepicker({
					dateFormat  : "yy-mm-dd",changeMonth : true,changeYear  : true					
        });
		});
		$(document).ready(function(){
        $("#tgl_rptka").datepicker({
					dateFormat  : "yy-mm-dd",changeMonth : true,changeYear  : true					
        });
		});
		$(document).ready(function(){
        $("#tgl_setoran_dpkk").datepicker({
					dateFormat  : "yy-mm-dd",changeMonth : true,changeYear  : true					
        });
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
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#">PERMOHONAN BARU - IPLK</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
				  <img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a>
                  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan&opts=baru" id="linkutama"> PROSES BARU </a>
				  <img src="./image/panah.gif"  /><span id="linkutama"> PROSES PENGURUSAN IPLK</span>
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
		<h3> &nbsp; PROSES PENGURUSAN IPLK - VERIFIKASI DATA</h3>
		<fieldset>
		<legend>DATA KHUSUS IPLK</legend>
<?php 
$no_resi = $_GET["no_resi"];
$query=mysql_query("SELECT * FROM tbl_berkas_iplk WHERE no_resi='$no_resi'");
$result=mysql_fetch_array($query);
$id_per=$_GET['id'];
if($result)
{

echo'	<form method="post" action="./index.php?mod=loket&opt=proses_permohonan&opts=validate_iplk&mode=2">
		<table name="biodata" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>NAMA PEMOHON</td>
						<td width="20">:</td>
						<td><input name="nama_pemohon" type="text" value="'.$result["nama_pemohon"].'">
						</td>
					  </tr>		
					  <tr>
						<td>ALAMAT PEMOHON</td>
						<td width="20">:</td>
						<td><input name="alamat_pemohon" type="text" value="'.$result["alamat_pemohon"].'">
						</td>
					  </tr>	
					  <tr>
						<td>NO HP</td>
						<td width="20">:</td>
						<td><input name="no_hp" type="text" value="'.$result["no_hp"].'">
						</td>
					  </tr>			
					  <tr>
						<td>NAMA LEMBAGA</td>
						<td width="20">:</td>
						<td><input name="nama_lembaga" type="text" size="40"  value="'.$result["nama_lembaga"].'">
						<input type="hidden" value="'.$result["id_perusahaan"].'" name="id_per"><input type="hidden" value="'.$result["no_resi"].'" name="no_resi">
					  </tr>
					  <tr>
						<td>NO AKTE</td>
						<td width="20">:</td>
						<td><input name="no_akte" type="text" value="'.$result["no_akte"].'">
						</td>
					  </tr>			
					  <tr>
						<td>ANAMA PENANGGUNG JAWAB</td>
						<td width="20">:</td>
						<td><input name="nama_penanggung_jawab" type="text" value="'.$result["nama_penanggung_jawab"].'">
						</td>
					  </tr>	
					  <tr>
						<td>BENTUK USAHA</td>
						<td width="20">:</td>
						<td><input name="bentuk_usaha" type="text" value="'.$result["bentuk_usaha"].'">
						</td>
					  </tr>		
					  <tr height="30">
						<td>JENIS PROGRAM PELATIHAN YANG DISELENGGARAKAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/program/?mode=1&id_per='.$result["id_perusahaan"].'" id="various1"><b>ISI DATA</b></a><br/></td>
					  </tr>

					  <tr height="30">
						<td>TABEL LAMA LATIHAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/lama_lat/?mode=1&id_per='.$result["id_perusahaan"].'" id="various2"><b>ISI DATA</b></a><br/></td>
					  </tr>

					  <tr height="30">
						<td>METODE LATIHAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/metode/?mode=1&id_per='.$result["id_perusahaan"].'" id="various3"><b>ISI DATA</b></a><br/></td>
					  </tr>

					  <tr height="30">
						<td>FASILITAS LATIHAN</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/alat/?mode=1&id_per='.$result["id_perusahaan"].'" id="various4"><b>ISI DATA</b></a><br/></td>
					  </tr>
                      
					  <tr height="30">
						<td>DATA INSTRUKTUR</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/pelatih/?mode=1&id_per='.$result["id_perusahaan"].'" id="various5"><b>ISI DATA</b></a><br/></td>
					  </tr>  

					  <tr height="30">
						<td>NAMA INSTRUKTUR</td>
						<td width="20">:</td>
						<td><a href="./modules/rincian/instruktur/?mode=1&id_per='.$result["id_perusahaan"].'" id="various6"><b>ISI DATA</b></a><br/></td>
					  </tr>  					  
					  <tr>
						<td>SUMBER SISWA</td>
						<td width="20">:</td>
						<td><input name="sumber_siswa" type="text" value="'.$result["sumber_siswa"].'">
						</td>
					  </tr>	
					  <tr>
						<td>SUMBER BIAYA</td>
						<td width="20">:</td>
						<td><input name="sumber_biaya" type="text" value="'.$result["sumber_biaya"].'">
						</td>
					  </tr>		
					  <tr>
						<td>SIFAT PERMOHONAN</td>
						<td width="20">:</td>
						<td><input name="sifat" type="text" value="'.$result["sifat"].'">
						</td>
					  </tr>						  				  					  				  
					  					  			  
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
				<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> <input type="submit" onClick="return CekCentang()" value="PROSES" disabled id="btn">
				</center>
			  </form>
		</fieldset>

  <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>
