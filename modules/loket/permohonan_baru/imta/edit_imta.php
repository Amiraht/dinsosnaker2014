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

</script>
<script type="text/javascript">
		$(document).ready(function(){
        $("#tgl_lahir").datepicker({
					dateFormat  : "yy-mm-dd",changeMonth : true,changeYear  : true					
        });
		});
		$(document).ready(function(){
        $("#berlaku_dari").datepicker({
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
<table width="1024" border="0" cellspacing="2" cellpadding="5">
<tr >
    <td colspan="2"><div id='header' style='background:url(./image/coba/header2.png) no-repeat;'> 
      <table border="0" id='atasan'>
        	<tr>
		         <td colspan='2' style="text-align:right; padding-right:10px; padding-bottom:50px;"><a style="color:#AA9F00;" href="#">PERMOHONAN BARU - IMTA</a></td>
            </tr>
            <tr>
            	 <td style="text-align:left; padding-left:10px; border-left:0px solid black;">
				  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=main" id="linkutama"> BERANDA LOGIN LOKET</a> 
				  <img src="./image/panah.gif"  /> <a href="./index.php?mod=loket&opt=proses_permohonan" id="linkutama"> PROSES PERMOHONAN DAN PRINT RESI </a>
                  <img src="./image/panah.gif"  /><a href="./index.php?mod=loket&opt=proses_permohonan&opts=baru" id="linkutama"> PROSES BARU </a>
				  <img src="./image/panah.gif"  /><span id="linkutama"> PROSES PENGURUSAN IMTA</span>
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
		<h3> &nbsp; PROSES PENGURUSAN IMTA - VERIFIKASI DATA</h3>
		<fieldset>
		<legend>DATA KHUSUS IMTA</legend>
<?php 
$no_resi = mysql_real_escape_string($_GET["no_resi"]);
$query=mysql_query("SELECT * FROM tbl_berkas_imta WHERE no_resi='".$no_resi."'");
$result=mysql_fetch_array($query);

if($result)
{
$id_negara = $result["kewarganegaraan"];
$negara = mysql_query("select * from t_negara");
//<form method="post" action="./index.php?mod=loket&opt=proses_permohonan&opts=resi&id='.$no_resi.'">
echo'	<form method="post" action="./index.php?mod=loket&opt=proses_permohonan&opts=validate_imta&mode=2">
		<table name="biodata" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>NAMA TENAGA ASING</td>
						<td width="20px">:</td>
						<td><input name="nama_ta" id="nama_ta"  type="text" size="40" value="'.$result["nama_ta"].'">
						<input type="hidden" value="'.$result["id_perusahaan"].'" name="id_per"><input type="hidden" value="'.$result["no_resi"].'" name="no_resi">						
						</td>
					  </tr>
					  <tr>
						<td>TANGGAL LAHIR</td>
						<td>:</td>
						<td><input name="tgl_lahir" id="tgl_lahir"  type="date" size="40" value="'.$result["tgl_lahir"].'" onchange="calcAge(this.value);"></td>
					  </tr>
					  <tr>
						<td>UMUR</td>
						<td>:</td>
						<td><input name="umur" id="umur"  type="text" size="40" value="'.$result["umur"].'"></td>
					  </tr>
					  <tr>
						<td>KEWARGANEGARAAN</td>
						<td>:</td>
						<td><select name="kewarganegaraan" id="kwn">
							<option value="0">PILIH NEGARA</option>';
								while($neg = mysql_fetch_array($negara))
								{
									if($neg[0]==$id_negara)
									{
										echo "<option selected value='$neg[0]'>$neg[1]</option>";
									}
									else
										echo "<option value='$neg[0]'>$neg[1]</option>";
								}
							echo '</select>
							</td>
					  </tr>
					  <tr>
						<td>ALAMAT TEMPAT TINGGAL</td>
						<td>:</td>
						<td><input name="alamat" id="alamat"  type="text" size="40" value="'.$result["alamat"].'"></td>
					  </tr>
					  <tr>
						<td>NO HP / PHONE NUMBER</td>
						<td>:</td>
						<td><input name="no_hp" id="no_hp"  type="text" size="40" value="'.$result["no_hp"].'"></td>
					  </tr>
					  <tr>
						<td>NO PASSPORT</td>
						<td>:</td>
						<td><input name="no_pasport" id="no_pasport"  type="text" size="40" value="'.$result["no_passport"].'"></td>
					  </tr>
					  <tr>
						<td>JABATAN</td>
						<td>:</td>
						<td><input name="jabatan" id="jabatan"  type="text" size="40" value="'.$result["jabatan"].'"></td>
					  </tr>
					  <tr>
						<td>BERLAKU DARI</td>
						<td>:</td>
						<td><input name="berlaku_dari" id="berlaku_dari"  type="date" size="40" value="'.$result["berlaku_dari"].'"></td>
					  </tr>
					  <tr>
						<td>BERLAKU SAMPAI</td>
						<td>:</td>
						<td><input name="berlaku_sampai" id="berlaku_sampai"  type="date" size="40" value="'.$result["berlaku_sampai"].'"></td>
					  </tr>
					  <tr>
						<td>NOMOR SURAT PERMOHONAN&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>:</td>
						<td><input name="no_surat_permohonan" id="no_surat_permohonan"  type="text" size="40" value="'.$result["no_surat_permohonan"].'"></td>
					  </tr>
					  <tr>
						<td>IMTA ATAS NAMA</td>
						<td>:</td>
						<td><input name="nama_imta" id="nama_imta" type="text"  size="40" value="'.$result["nama_imta"].'"></td>
					  </tr>
					  <tr>
						<td>NOMOR IMTA</td>
						<td>:</td>
						<td><input name="no_imta" id="no_imta" type="text"  size="40" value="'.$result["no_imta"].'"></td>
					  </tr>
					  <tr>
						<td>TANGGAL</td>
						<td>:</td>
						<td><input name="tgl_imta" id="tgl_imta" type="date"  size="40" value="'.$result["tgl_imta"].'"></td>
					  </tr>
					  <tr>
						<td>TANGGAL BERAKHIR</td>
						<td>:</td>
						<td><input name="tgl_berakhir" id="tgl_berakhir" type="date"  size="40" value="'.$result["tgl_berakhir"].'"></td>
					  </tr>
					  <tr>
						<td>NOMOR RPTKA</td>
						<td>:</td>
						<td><input name="no_rptka" id="no_rptka" type="text"  size="40" value="'.$result["no_rptka"].'"></td>
					  </tr>
					  <tr>
						<td>TANGGAL RPTKA</td>
						<td>:</td>
						<td><input name="tgl_rptka" id="tgl_rptka" type="date"  size="40" value="'.$result["tgl_rptka"].'"></td>
					  </tr>
					  <tr>
						<td>TANGGAL SETORAN DPKK</td>
						<td>:</td>
						<td><input name="tgl_setoran_dpkk" id="tgl_setoran_dpkk" type="date"  size="40" value="'.$result["tgl_setoran_dpkk"].'"></td>
					  </tr>
					  <tr>
						<td>JUMLAH SETORAN DPKK</td>
						<td>:</td>
						<td><input name="jlh_setoran_dpkk" id="jlh_setoran_dpkk" type="text"  size="40" value="'.$result["jlh_setoran_dpkk"].'"></td>
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
				  SURAT PEMOHON</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="2" id="berkas_1">
				  COPY IMTA YANG MASIH BERLAKU</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="3" id="berkas_2">
				  BUKTI PEMBAYARAN DPKK</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="4" id="berkas_3">
				  COPY POLIS ASURANSI</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="5" id="berkas_4">
				  COPY PELAKSANA ALIH TEKNOLOGI</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="6" id="berkas_5">
				  COPY RPTKA YANG MASIH BERLAKU</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="7" id="berkas_6">
				  PASFOTO 3X4 = 3 LBR</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="8" id="berkas_7">
				  FORMULIR PERPANJANGAN IMTA</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="9" id="berkas_8">
				  COPY KITAS/KITAP</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="10" id="berkas_9">
				  COPY STMD</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="11" id="berkas_10">
				  COPY KTP TKI PENDAMPING</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="12" id="berkas_11">
				  COPY PASPORT</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="13" id="berkas_12">
				  COPY VISA</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="14" id="berkas_13">
				  COPY WAJIB LAPOR KETENAGAKERJAAN</label>
				<br>
				<label>
				  <input type="checkbox" name="berkas" value="15" id="berkas_14">
				  COPY LAPOR KEBERADAAN TKA</label>
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
