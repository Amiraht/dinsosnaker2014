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
function CekAll() {
	    document.getElementById("btn").disabled=false;
		checkboxes = document.getElementsByName('berkas');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = true;
		}
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
      <tr> 
      <!-- Header -->
        <td >
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#">PROSES PERMOHONAN DAN PRINT RESI<br>
				 PROSES PENGURUSAN PENGADUAN KETENAGAKERJAAN</a></td>
            </tr>
                        <tr>
                            <td colspan="2"><div style="margin-left:50px;"> 
                            <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
                            <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a> 
                            <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan&opts=baru" id="linkutama"> PROSES BARU </a><br/>
                            <img src="./image/panah.gif"  /> <span id="linkutama">PROSES PENGURUSAN PENGADUAN KETENAGAKERJAAN</span></div></td>
                             </td>
                        </tr>
                    </table>            
                    </div>
            <br>
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
<tr><td>&nbsp;</td></tr>
    <tr> 
  	<td> 
    <div id='content' style='
        padding-top:10px;' 
        >
<fieldset style='width:96%; margin-left:20px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;' > 
			<legend>INFORMASI PENGADUAN</legend>
<?php 
$no_resi = $_GET["no_resi"];
$query=mysql_query("SELECT * FROM tbl_berkas_pengaduan WHERE no_resi='$no_resi'");
$result=mysql_fetch_array($query);

if($result)
{
echo '	<form method="post" action="./index.php?mod=loket&opt=proses_permohonan&opts=validate_pengaduan&mode=2">
		<table  name="biodata" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>NAMA</td>
						<td>:</td>
						<td><input name="nama" type="text"   size="40" value="'.$result["nama"].'" onkeyup="javascript:this.value=this.value.toUpperCase();"><input type="hidden" value="'.$result["id_perusahaan"].'" name="id_per"><input type="hidden" value="'.$result["no_resi"].'" name="no_resi"></td>
					  </tr>
					  <tr>
						<td>NO KTP</td>
						<td>:</td>
						<td><input name="no_ktp" type="text"   size="40"value="'.$result["no_ktp"].'" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
					  </tr>
					  <tr>
						<td>ALAMAT</td>
						<td>:</td>
						<td><input name="alamat" type="text"   size="40" value="'.$result["alamat"].'" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
					  </tr>
					  <tr>
						<td>NO HP</td>
						<td>:</td>
						<td><input name="no_hp" type="text"   size="40" value="'.$result["no_hp"].'" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
					  </tr>
					  <tr>
						<td>NO TELEPON</td>
						<td>:</td>
						<td><input name="no_telp" type="text"   size="40" value="'.$result["no_telp"].'" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
					  </tr>
					  <tr>
						<td>MULAI BEKERJA</td>
						<td>:</td>
						<td><input name="mulai_bekerja" type="text"   size="40" id="datepick" value="'.$result["mulai_bekerja"].'"></td>
					  </tr>
					  <tr>
						<td>JABATAN</td>
						<td>:</td>
						<td><input name="jabatan" type="text"   size="40" value="'.$result["jabatan"].'" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
					  </tr>
					  <tr>
						<td>UPAH POKOK</td>
						<td>:</td>
						<td><input name="upah" type="text"   size="40" value="'.$result["upah"].'" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
					  </tr>					  
					  <tr>
						<td>DASAR PERMASALAHAN</td>
						<td>:</td>
						<td><input name="dasar_permasalahan" type="text"   size="40" value="'.$result["dasar_permasalahan"].'" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
					  </tr>
					  <tr>
						<td>MASA KERJA</td>
						<td>:</td>
						<td><input name="masa_kerja" type="text"   size="40" value="'.$result["masa_kerja"].'" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
					  </tr>
					  <tr>
						<td>KRONOLOGIS PERMASALAHAN</td>
						<td>:</td>
						<td><input name="kronologis" type="text"   size="40" value="'.$result["kronologis"].'" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
					  </tr>
					  <tr>
						<td>JANJI YANG PERNAH DIBERIKAN</td>
						<td>:</td>
						<td><input name="janji" type="text"   size="40" value="'.$result["janji"].'" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
					  </tr>
</table>
			</fieldset>	
<fieldset style="width:96%; margin-left:20px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;"  >
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
				<input type="button" onClick="CekAll()" value="CENTANG SEMUA"> <input type="submit" onClick="return CekCentang()" value="PROSES" id="btn" disabled>
				</center>
			  </form>
</fieldset>				
</form>					

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
	</tr>
	<tr>
  	<td colspan="2"><div id='footer'  style='background:url(./image/coba/footer.png) no-repeat; height:80px; margin-left:8px;'></div>
    </td>
  </tr>
</table>