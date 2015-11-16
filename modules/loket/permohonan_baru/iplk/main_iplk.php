<script type="text/javascript" src="./libraries/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./libraries/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./libraries/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script language="javascript"> 
function CekAll() {
		checkboxes = document.getElementsByName('berkas');
		for(var i=0, n=checkboxes.length;i<n;i++) 
		{
			if(checkboxes[i].checked == true)
				{checkboxes[i].checked == false;}
			else {checkboxes[i].checked == true;}
		}
}
function goedit() {
		document.getElementById('nama_lembaga').disabled = false;
		document.getElementById('no_akte').disabled = false;
		document.getElementById('bentuk_usaha').disabled = false;
		document.getElementById('nama_penanggung_jawab').disabled = false;
		document.getElementById('sumber_siswa').disabled = false;
		document.getElementById('sumber_biaya').disabled = false;
		document.getElementById('sifat').disabled = false;
		document.getElementById('nama_pemohon').disabled = false;
		document.getElementById('alamat_pemohon').disabled = false;

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
		s='./index.php?mod=loket&opt=proses_permohonan&opts=edit_iplk';
		if(no_resi != '')
		s=s+'&no_resi='+no_resi;
		document.location.href=s;
	} 
	function kembali_validate(){
		var resi = '<?=base64_encode(base64_encode($_GET["no_resi"]));?>';
		var konfirmasi = confirm('Data Ini Akan hilang jika anda kembali. Anda Yakin ingin membatalkan data ini ??');
		if(konfirmasi){
			document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=cancel_validate&c_num=1&res='+resi;
		}else{
			// do nothing
		}
	}
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
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:20px;"><a style="color:#AA9F00;" href="#"><b>PERMOHONAN BARU - PENGURUSAN IPLK</b></a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
				  <img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a>
                  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan&opts=perbaikan" id="linkutama"> PROSES PERBAIKAN </a>
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
						onClick="kembali_validate();" 
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
$no_resi = mysql_real_escape_string($_GET["no_resi"]);
$query = mysql_query("SELECT * FROM tbl_berkas_iplk WHERE no_resi='".$no_resi."'");
$result = mysql_fetch_array($query);

if($result)
{
//$id_negara = $result["kewarganegaraan"];
//$negara = mysql_query("select negara from t_negara where id_negara = $id_negara");
//$r_negara = mysql_fetch_row($negara);
//<form method="post" action="./index.php?mod=loket&opt=proses_permohonan&opts=resi&id='.$no_resi.'">
echo'	<form method="post" action="./index.php?mod=loket&opt=print_resi&opts=cetak&id='.$no_resi.'" target="_blank">
		<table name="biodata" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>NAMA PEMOHON</td>
						<td width="20">:</td>
						<td><input name="nama_pemohon" type="text" disabled value="'.$result["nama_pemohon"].'">
						</td>
					  </tr>	
					  <tr>
						<td>ALAMAT PEMOHON</td>
						<td width="20">:</td>
						<td><input name="alamat_pemohon" type="text" disabled value="'.$result["alamat_pemohon"].'">
						</td>
					  </tr>	
					  <tr>
						<td>NO HP</td>
						<td width="20">:</td>
						<td><input name="alamat_pemohon" type="text" disabled value="'.$result["no_hp"].'">
						</td>
					  </tr>		
					  <tr>
						<td>NAMA LEMBAGA</td>
						<td width="20">:</td>
						<td><input name="nama_lembaga" type="text" size="40" disabled value="'.$result["nama_lembaga"].'">
						<input type="hidden" value="'.$result["id_perusahaan"].'" name="id_per">
					  </tr>
					  <tr>
						<td>NO AKTE</td>
						<td width="20">:</td>
						<td><input name="no_akte" type="text" disabled value="'.$result["no_akte"].'">
						</td>
					  </tr>			
					  <tr>
						<td>NAMA PENANGGUNG JAWAB</td>
						<td width="20">:</td>
						<td><input name="nama_penanggung_jawab" disabled type="text" value="'.$result["nama_penanggung_jawab"].'">
						</td>
					  </tr>	
					  <tr>
						<td>BENTUK USAHA</td>
						<td width="20">:</td>
						<td><input name="bentuk_usaha" type="text" disabled value="'.$result["bentuk_usaha"].'">
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
						<td><input name="sumber_siswa" type="text" disabled value="'.$result["sumber_siswa"].'">
						</td>
					  </tr>	
					  <tr>
						<td>SUMBER BIAYA</td>
						<td width="20">:</td>
						<td><input name="sumber_biaya" type="text" disabled value="'.$result["sumber_biaya"].'">
						</td>
					  </tr>		
					  <tr>
						<td>SIFAT PERMOHONAN</td>
						<td width="20">:</td>
						<td><input name="sifat" type="text" disabled value="'.$result["sifat"].'">
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
					<br/><CENTER><input type="button" onclick="kirim_edit()" value="EDIT"> <input type="submit" value="CETAK"> <input type="button" onclick="kirim_kendali()" value="PROSES"></CENTER>	
					<!-- <center> <input type="button" onClick="goedit()" value="EDIT"> <input type="button" name="kirim" value="SIMPAN"> onClick="simpan();" </center>--> 
					</fieldset>
  
  <tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>
