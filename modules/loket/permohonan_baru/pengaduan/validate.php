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
function CekAll() {
		checkboxes = document.getElementsByName('berkas');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = true;
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
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00; href="#">PROSES PERMOHONAN DAN PRINT RESI<br>
				 PROSES PENGURUSAN PENGADUAN KETENAGAKERJAAN</a></td>
            </tr>
                        <tr>
                            <td colspan="2"><div style="margin-left:50px;"> <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> <img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a> <img src="./image/panah.gif"  /> <span id="linkutama">PROSES BARU</span></div></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./index.php?mod=home&opt=main'" 
                                onmouseout="this.src='./image/button/KEMBALI.gif'" onmouseover="this.src='./image/button/KEMBALI2.gif'" src="./image/button/KEMBALI.gif"></img>
                                </td>
                        </tr>
                    </table>            
                    </div>
            <br>
        </td>
  </tr>
    <tr>
  	<td>
    <div id='content' style='
        padding-top:10px;'
        >
<fieldset style='width:90%; margin-left:40px; padding-left:20px;min-height:40px; margin-bottom:10px;padding-right:20px;'>
			<legend>INFORMASI PENGADUAN</legend>
<?php 
if($_POST["nama"] != ""){
$query = mysql_query("SELECT no_resi FROM tbl_berkas_pengaduan ORDER BY no_resi DESC");
			$result=mysql_fetch_row($query);
			$data=explode("-",$result[0]);
			$jenis_urus = $data[0];
			$data[1]+=1;
			if($data[1]>99)
				$no_resi="03-".$data[1];
			else if($data[1]>9)
				$no_resi="03-0".$data[1];
			else if($data[1]<=9)
				$no_resi="03-00".$data[1];

$say = "INSERT INTO tbl_berkas_pengaduan
	(no_resi,tgl_masuk_berkas,id_perusahaan, nama,no_ktp,alamat,no_hp,no_telp,mulai_bekerja,jabatan,dasar_permasalahan,masa_kerja,kronologis,janji) 
	VALUES 
	('".$no_resi."',curdate(), ".$_POST["id_per"].", '".$_POST["nama"]."', '".$_POST["no_ktp"]."','".$_POST["alamat"]."', 
	'".$_POST["no_hp"]."','".$_POST["no_telp"]."','".$_POST["mulai_bekerja"]."',
	'".$_POST["jabatan"]."','".$_POST["dasar_permasalahan"]."','".$_POST["masa_kerja"]."','".$_POST["kronologis"]."','".$_POST["janji"]."')";
	
	$az = "insert into tbl_info_berkas(no_resi,jenis_pengurusan,id_proses_skrg,id_proses_sblm,isValid,isDisposisi)
				values
			('$no_resi','$jenis_urus','1','0','1','3')";
$bz = mysql_query($az);
$sql = mysql_query($say);
}
if($sql)
{
echo '	<form method="post" action="./index.php?mod=loket&opt=print_resi&opts=cetak&id='.$no_resi.'">
		<table name="biodata" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>NAMA</td>
						<td>:</td>
						<td><input name="nama" type="text" disabled  size="40" value=" '.$_POST["nama"].' ">
					  </tr>
					  <tr>
						<td>NO KTP</td>
						<td>:</td>
						<td><input name="no_ktp" type="text" disabled  size="40"value=" '.$_POST["no_ktp"].' "></td>
					  </tr>
					  <tr>
						<td>ALAMAT</td>
						<td>:</td>
						<td><input name="alamat" type="text" disabled  size="40" value=" '.$_POST["alamat"].' "></td>
					  </tr>
					  <tr>
						<td>NO HP</td>
						<td>:</td>
						<td><input name="no_hp" type="text" disabled  size="40" value=" '.$_POST["no_hp"].' "></td>
					  </tr>
					  <tr>
						<td>NO TELEPON</td>
						<td>:</td>
						<td><input name="no_telp" type="text" disabled  size="40" value=" '.$_POST["no_telp"].' "></td>
					  </tr>
					  <tr>
						<td>MULAI BEKERJA</td>
						<td>:</td>
						<td><input name="mulai_bekerja" type="text" disabled  size="40" value=" '.$_POST["mulai_bekerja"].' "></td>
					  </tr>
					  <tr>
						<td>JABATAN</td>
						<td>:</td>
						<td><input name="jabatan" type="text" disabled  size="40" value=" '.$_POST["jabatan"].' "></td>
					  </tr>
					  <tr>
						<td>DASAR PERMASALAHAN</td>
						<td>:</td>
						<td><input name="dasar_permasalahan" type="text" disabled  size="40" value=" '.$_POST["dasar_permasalahan"].' "></td>
					  </tr>
					  <tr>
						<td>MASA KERJA</td>
						<td>:</td>
						<td><input name="upah_pokok" type="text" disabled  size="40" value=" '.$_POST["masa_kerja"].' "></td>
					  </tr>
					  <tr>
						<td>KRONOLOGIS PERMASALAHAN</td>
						<td>:</td>
						<td><input name="kronologis" type="text" disabled  size="40" value=" '.$_POST["kronologis"].' "></td>
					  </tr>
					  <tr>
						<td>JANJI YANG PERNAH DIBERIKAN</td>
						<td>:</td>
						<td><input name="janji" type="text" disabled  size="40" value=" '.$_POST["janji"].' "></td>
					  </tr>
</table>
			</fieldset>		<br><CENTER><input type="button" id="displayText" value="CHECK LIST BERKAS" onClick="javascript:toggle();">	</CENTER>						
<table>						
					 
					 <tr>
						<td colspan="3">
						<div id="toggleText" style="display: none">
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
							</div>
						</fieldset>
						</td>
				</table>';
}
else{
	echo "<script type='text/javascript'>
				alert('DATA BERKAS GAGAL DITAMBAHKAN');
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