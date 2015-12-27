<?php
	$get = mysql_real_escape_string($_GET["no_resi"]);

	// pecah encoding base64_encode yang berlapis..
	$no_resi = base64_decode(base64_decode(base64_decode(base64_decode($get))));

?>

<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
  	}
	else {
		ele.style.display = "block";
	}
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
function CekAll() {
		checkboxes = document.getElementsByName('berkas');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = true;
		}
}

function comeBack(){
	var num_resi = '<?=$get;?>';
	var x = confirm("Apakah anda yakin ingin membatalkan proses pengaduan?\n Jika Ya, anda akan kehilangan data yang baru anda inputkan !!..");
	if(x){
		document.location.href='./index.php?mod=loket&opt=proses_permohonan&opts=baru&dt=react&num='+num_resi;
	}else{
		// do nothing
	}
}
</script>

	<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
        <td >
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'">
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:15px;"><a style="color:#AA9F00; href="#"><b>PROSES PERMOHONAN DAN PRINT RESI<br>
				 PROSES PENGURUSAN PENGADUAN KETENAGAKERJAAN</b></a></td>
            </tr>
                        <tr>
                          <td colspan="2"><div style="margin-left:40px;"> 
                          <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
                          <img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a> 
                          <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan&opts=baru" id="linkutama"> PROSES BARU </a><br/>
                          <img src="./image/panah.gif"  /> <span id="linkutama">PROSES PENGURUSAN PENGADUAN KETENAGAKERJAAN</span></div></td>
                           </td>
                        </tr>
                    </table>            
                    </div>
           
        </td>
  </tr>
  <tr>
<td style="float:right;">
					<img width="90" height="29" 
						onClick="comeBack()" 
						onmouseout="this.src='./image/button/KEMBALI.gif'" 
						onmouseover="this.src='./image/button/KEMBALI2.gif'" 
						src="./image/button/KEMBALI.gif">
					</img>
    			</td>
</tr>
<tr><td>&nbsp;</td></tr>
    <tr> 
  	<td> 
    <div id='content' style='
        padding-top:10px;' 
        >
<fieldset style='width:96%; margin-left:20px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;' >  
			<legend>INFORMASI PENGADUAN</legend> 
<?php 

$query = mysql_query("SELECT * FROM tbl_berkas_pengaduan WHERE no_resi='".$no_resi."'");

$result = mysql_fetch_array($query);

if($result)
{
echo '	<form method="post" action="./index.php?mod=loket&opt=print_resi&opts=cetak&id='.$no_resi.'" target="_blank" style="text-transform:uppercase;">
		<table name="biodata" border="0" cellspacing="0" cellpadding="0" style="text-transform:uppercase;">
					  <tr>
						<td>NAMA</td>
						<td>:</td>
						<td><input name="nama" type="text" disabled  size="40" value="'.$result["nama"].'"><input type="hidden" value="'.$result["id_perusahaan"].'" name="id_per"></td>
					  </tr>
					  <tr>
						<td>NO KTP</td>
						<td>:</td>
						<td><input name="no_ktp" type="text" disabled  size="40"value="'.$result["no_ktp"].'"></td>
					  </tr>
					  <tr>
						<td>ALAMAT</td>
						<td>:</td>
						<td><input name="alamat" type="text" disabled  size="40" value="'.$result["alamat"].'"></td>
					  </tr>
					  <tr>
						<td>NO HP</td>
						<td>:</td>
						<td><input name="no_hp" type="text" disabled  size="40" value="'.$result["no_hp"].'"></td>
					  </tr>
					  <tr>
						<td>NO TELEPON</td>
						<td>:</td>
						<td><input name="no_telp" type="text" disabled  size="40" value="'.$result["no_telp"].'"></td>
					  </tr>
					  <tr>
						<td>MULAI BEKERJA</td>
						<td>:</td>
						<td><input name="mulai_bekerja" type="text" disabled  size="40" value="'.$result["mulai_bekerja"].'"></td>
					  </tr>
					  <tr>
						<td>JABATAN</td>
						<td>:</td>
						<td><input name="jabatan" type="text" disabled  size="40" value="'.$result["jabatan"].'"></td>
					  </tr>
					  <tr>
						<td>UPAH POKOK</td>
						<td>:</td>
						<td><input name="upah" type="text" disabled  size="40" value="'.$result["upah"].'"></td>
					  </tr>					  
					  <tr>
						<td>DASAR PERMASALAHAN</td>
						<td>:</td>
						<td><input name="dasar_permasalahan" type="text" disabled  size="40" value="'.$result["dasar_permasalahan"].'"></td>
					  </tr>
					  <tr>
						<td>MASA KERJA</td>
						<td>:</td>
						<td><input name="masa_kerja" type="text" disabled  size="40" value="'.$result["masa_kerja"].'"></td>
					  </tr>
					  <tr>
						<td>KRONOLOGIS PERMASALAHAN</td>
						<td>:</td>
						<td><input name="kronologis" type="text" disabled  size="40" value="'.$result["kronologis"].'"></td>
					  </tr>
					  <tr>
						<td>JANJI YANG PERNAH DIBERIKAN</td>
						<td>:</td>
						<td><input name="janji" type="text" disabled  size="40" value="'.$result["janji"].'"></td>
					  </tr>
</table>
				<br><CENTER><input type="button" onclick="kirim_edit()" value="EDIT"> <input type="submit" value="CETAK"> <input type="button" onclick="kirim_kendali()" value="PROSES"></CENTER>	
</form>					
</fieldset>	
</table>';
}
else{
	echo "<script type='text/javascript'>
				alert('DATA TIDAK DITEMUKAN');
				document.location.href='index.php?mod=loket&opt=proses_permohonan&opts=baru';
		</script>";		
}?>
			</div> 
		</div>
        </td> 
	</tr> 
	
	<tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>