<script type="text/javascript">
$(document).ready(function(){
   ambil_tanggal("tanggal_lahir");
   
   $("#frm").submit(function(){
        if(frm.nip.value == "" || frm.nama_pegawai.value == ""){
            jAlert("Maaf, NIP dan NAMA harus diisi.", "PERHATIAN");
            return false;
        }
        
   }); 
});
</script>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">TAMBAH DATA PEGAWAI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /><a href="./?mod=tambah_pegawai"><span>TAMBAH DATA PEGAWAI</span></a></td>
                            <td><img  align="right" width="90" height="29" onclick="document.location.href='./'" 
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
    <div id='content' style='padding-top:10px;'>	<br>
		
		<form name="frm" id="frm" action="php/tambah_pegawai.php" method="POST">
		<div class="panelcontainer panelform" style="width: 100%;">
			<h3 style="text-align: left;">TAMBAH DATA PEGAWAI</h3>
			<div class="bodypanel bodyfilter" id="bodyfilter">
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td>
							<input type="text" name="nip" placeholder=":: NIP Pegawai ::" title="NIP Pegawai" value="" />
						</td>
					</tr>
				</table>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td width='150px'>
							<input type="text" name="gelar_depan" placeholder=":: Gelar Depan ::" title="Gelar Depan" value="" />
						</td>
						<td>
							<input type="text" name="nama_pegawai" placeholder=":: Nama Pegawai ::" title="Nama Pegawai" value="" />
						</td>
						<td width='150px'>
							<input type="text" name="gelar_belakang" placeholder=":: Gelar Belakang ::" title="Gelar Belakang" value="" />
						</td>
					</tr>
				</table>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td>
							<select name="id_status_kepegawaian">
								<option value="0">:: Status Kepegawaian ::</option>
								<option value="4">PNS</option>
								<option value="1">CPNS</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<select name="id_jenis_kepegawaian">
								<option value="0">:: Jenis Kepegawaian ::</option>
								<?php
									$res_cb = mysql_query("SELECT * FROM ref_jenis_kepegawaian");
									while($ds_cb = mysql_fetch_array($res_cb)){
								?>
									<option value="<?php echo($ds_cb["id_jenis_kepegawaian"]); ?>"><?php echo($ds_cb["jenis_kepegawaian"]); ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<select name="id_kedudukan_kepegawaian">
								<option value="0">:: Kedudukan Kepegawaian ::</option>
								<?php
									$res_cb = mysql_query("SELECT * FROM ref_kedudukan_kepegawaian");
									while($ds_cb = mysql_fetch_array($res_cb)){
								?>
									<option value="<?php echo($ds_cb["id_kedudukan_kepegawaian"]); ?>"><?php echo($ds_cb["kedudukan_kepegawaian"]); ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<select name="id_golongan_darah">
								<option value="0">:: Golongan Darah ::</option>
								<?php
									$res_cb = mysql_query("SELECT * FROM ref_golongan_darah");
									while($ds_cb = mysql_fetch_array($res_cb)){
								?>
									<option value="<?php echo($ds_cb["id_golongan_darah"]); ?>"><?php echo($ds_cb["golongan_darah"]); ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<select name="id_jenis_kelamin">
								<option value="0">:: Jenis Kelamin ::</option>
								<?php
									$res_cb = mysql_query("SELECT * FROM ref_jenis_kelamin");
									while($ds_cb = mysql_fetch_array($res_cb)){
								?>
									<option value="<?php echo($ds_cb["id_jenis_kelamin"]); ?>"><?php echo($ds_cb["jenis_kelamin"]); ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
				</table>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td>
							<input type="text" name="tempat_lahir" placeholder=":: Tempat Lahir ::" title="Tempat Lahir" value="" />
						</td>
						<td width='250px'>
							<input type="text" name="tanggal_lahir" id="tanggal_lahir" placeholder=":: Tanggal Lahir ::" title="Tanggal Lahir" value="" />
						</td>
					</tr>
				</table>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td>
							<input type="text" name="alamat" placeholder=":: Alamat ::" title="Alamat" value="" />
						</td>
						<td width='200px'>
							<input type="text" name="rt" placeholder=":: RT ::" title="RT" value="" />
						</td>
						<td width='200px'>
							<input type="text" name="rw" placeholder=":: RW ::" title="RW" value="" />
						</td>
						<td width='200px'>
							<input type="text" name="kode_pos" placeholder=":: Kode Pos ::" title="Kode Pos" value="" />
						</td>
					</tr>
				</table>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td>
							<input type="text" name="marga" placeholder=":: Marga ::" title="Marga" value="" />
						</td>
						<td width='300px'>
							<select name="id_suku">
								<option value="0">:: Suku ::</option>
								<?php
									$res_cb = mysql_query("SELECT * FROM ref_suku ORDER BY suku ASC");
									while($ds_cb = mysql_fetch_array($res_cb)){
								?>
									<option value="<?php echo($ds_cb["id_suku"]); ?>"><?php echo($ds_cb["suku"]); ?></option>
								<?php
									}
								?>
							</select>
						</td>
						<td width='300px'>
							<select name="id_agama">
								<option value="0">:: Agama ::</option>
								<?php
									$res_cb = mysql_query("SELECT * FROM ref_agama");
									while($ds_cb = mysql_fetch_array($res_cb)){
								?>
									<option value="<?php echo($ds_cb["id_agama"]); ?>"><?php echo($ds_cb["agama"]); ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
				</table>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td width='25%'>
							<select name="id_provinsi" onchange="get_kabupaten(this.value);">
								<option value="0">:: Provinsi ::</option>
								<?php
									$res_cb = mysql_query("SELECT * FROM ref_provinsi ORDER BY provinsi ASC");
									while($ds_cb = mysql_fetch_array($res_cb)){
								?>
									<option value="<?php echo($ds_cb["id_provinsi"]); ?>"><?php echo($ds_cb["provinsi"]); ?></option>
								<?php
									}
								?>
							</select>
						</td>
						<td width='25%'>
							<select name="id_kabupaten" id="id_kabupaten" onchange="get_kecamatan(this.value);">
								<option value="0">:: Kabupaten ::</option>
							</select>
						</td>
						<td width='25%'>
							<select name="id_kecamatan" id="id_kecamatan" onchange="get_kelurahan(this.value);">
								<option value="0">:: Kecamatan ::</option>
							</select>
						</td>
						<td width='25%'>
							<select name="id_kelurahan" id="id_kelurahan">
								<option value="0">:: Kelurahan ::</option>
							</select>
						</td>
					</tr>
				</table>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td width='50%'>
							<input type="text" name="no_telp" placeholder=":: Nomor Telepon ::" title="Nomor Telepon" value="" />
						</td>
						<td width='50%'>
							<input type="text" name="no_hp" placeholder=":: Nomor HP ::" title="Nomor HP" value="" />
						</td>
					</tr>
				</table>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td width='20%'>
							<input type="text" name="tinggi" placeholder=":: Tinggi ::" title="Tinggi" value="" />
						</td>
						<td width='20%'>
							<input type="text" name="berat" placeholder=":: Berat ::" title="Berat" value="" />
						</td>
						<td width='20%'>
							<select name="id_rambut">
								<option value="0">:: Bentuk Rambut ::</option>
								<?php
									$res_cb = mysql_query("SELECT * FROM ref_rambut ORDER BY rambut ASC");
									while($ds_cb = mysql_fetch_array($res_cb)){
								?>
									<option value="<?php echo($ds_cb["id_rambut"]); ?>"><?php echo($ds_cb["rambut"]); ?></option>
								<?php
									}
								?>
							</select>
						</td>
						<td width='20%'>
							<select name="id_bentuk_muka">
								<option value="0">:: Bentuk Muka ::</option>
								<?php
									$res_cb = mysql_query("SELECT * FROM ref_bentuk_muka ORDER BY bentuk_muka ASC");
									while($ds_cb = mysql_fetch_array($res_cb)){
								?>
									<option value="<?php echo($ds_cb["id_bentuk_muka"]); ?>"><?php echo($ds_cb["bentuk_muka"]); ?></option>
								<?php
									}
								?>
							</select>
						</td>
						<td width='20%'>
							<select name="id_warna_kulit">
								<option value="0">:: Warna Kulit ::</option>
								<?php
									$res_cb = mysql_query("SELECT * FROM ref_warna_kulit ORDER BY warna_kulit ASC");
									while($ds_cb = mysql_fetch_array($res_cb)){
								?>
									<option value="<?php echo($ds_cb["id_warna_kulit"]); ?>"><?php echo($ds_cb["warna_kulit"]); ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
				</table>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td width='34%'>
							<input type="text" name="ciri_khas" placeholder=":: Ciri Khas ::" title="Ciri Khas" value="" />
						</td>
						<td width='33%'>
							<input type="text" name="cacat_tubuh" placeholder=":: Cacat Tubuh ::" title="Cacat Tubuh" value="" />
						</td>
						<td width='33%'>
							<input type="text" name="hobi" placeholder=":: Hobi ::" title="Hobi" value="" />
						</td>
					</tr>
				</table>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
					<tr>
						<td style="text-align: left;">
							<input type="submit" value="SIMPAN" style="width: 150px; height: 40px;" />
							<input type="reset" value="RESET" style="width: 150px; height: 40px;" />
						</td>
					</tr>
				</table>
			</div>
		</div>
		</form>
	</div>
</td>
</tr>
<tr>
    <td align="center" valign="middle">
    <div id='menu' style='border:0px solid black;'>
                    <nav>
                            <ul>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./'>BERANDA UTAMA</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=latar_belakang'>LATAR BELAKANG</a></li>
                                    <li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=berita_dan_informasi'>BERITA DAN INFORMASI</a></li>
									<li><img src='./image/list.png'>&nbsp;&nbsp;<a href='./?mod=fdownload'>FILE DOWNLOAD</a></li>
                                </ul>
                    </nav>
    </div>
    </td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 



