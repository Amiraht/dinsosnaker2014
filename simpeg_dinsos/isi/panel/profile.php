<?php
	$sql = "SELECT 
				a.*, b.status_kepegawaian, c.jenis_kepegawaian, d.kedudukan_kepegawaian,
				e.skpd, f.pangkat, f.gol_ruang, g.jabatan, h.tipe_jabatan, i.golongan_darah,
				j.jenis_kelamin
			FROM
				 tbl_pegawai a
				 LEFT JOIN ref_status_kepegawaian b ON a.id_status_kepegawaian = b.id_status_kepegawaian
				 LEFT JOIN ref_jenis_kepegawaian c ON a.id_jenis_kepegawaian = c.id_jenis_kepegawaian
				 LEFT JOIN ref_kedudukan_kepegawaian d ON a.id_kedudukan_kepegawaian = d.id_kedudukan_kepegawaian
				 LEFT JOIN ref_skpd e ON a.id_satuan_organisasi = e.id_skpd
				 LEFT JOIN ref_pangkat f ON a.id_pangkat = f.id_pangkat
				 LEFT JOIN ref_jabatan g ON a.id_jabatan = g.id_jabatan
				 LEFT JOIN ref_tipe_jabatan h ON a.id_tipe_jabatan = h.id_tipe_jabatan
				 LEFT JOIN ref_golongan_darah i ON a.id_golongan_darah = i.id_golongan_darah
				 LEFT JOIN ref_jenis_kelamin j ON a.id_jenis_kelamin = j.id_jenis_kelamin
			WHERE 
				a.id_pegawai = '". $_SESSION["simpeg_id_pegawai"] ."'
	";
	$exc = mysql_query($sql) or die(mysql_error());
    $ds = mysql_fetch_array($exc);
?>

<table width="1024" border="0" cellspacing="2" cellpadding="5">
  <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">PROFIL PEGAWAI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>PROFIL PEGAWAI</span></td>
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
			<div class="panelcontainer panelform" style="width: 80%;">
					<h3 style="text-align: left;">PROFIL PEGAWAI </h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='6' width='100%'>
							<tr>
								<td>NIP PEGAWAI</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
									  <span><b><?=$ds["nip"]; ?></b></span>
								</td>
							</tr>
							<tr>
								<td>NAMA LENGKAP PEGAWAI</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
								<?php
									$dp = ($ds["gelar_depan"] == "") ? "" : $ds["gelar_depan"] .".";
									$gb = ($ds["gelar_belakang"] == "") ? "" : $ds["gelar_belakang"] ."";
									$fullname = $dp . " " . $ds["nama_pegawai"] . " " . $gb;
								?>
									<span><b><?=$fullname; ?></b></span>
								</td>
							</tr>
							<tr>
								<td>STATUS KEPEGAWAIAN</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
									  <span><b><?=$ds["status_kepegawaian"]; ?></b></span>
								</td>
							</tr>
							<tr>
								<td>JENIS KEPEGAWAIAN</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
									  <span><b><?=$ds["jenis_kepegawaian"]; ?></b></span>
								</td>
							</tr>
							<tr>
								<td>KEDUDUKAN KEPEGAWAIAN</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
									  <span><b><?=($ds["kedudukan_kepegawaian"] == "") ? "-" : $ds["kedudukan_kepegawaian"]; ?></b></span>
								</td>
							</tr>
							<tr>
								<td>SKPD / UNIT KERJA</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
									  <span><b><?=($ds["skpd"] == "") ? "-" : $ds["skpd"]; ?></b></span>
								</td>
							</tr>
							<tr>
								<td>PANGKAT</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
									  <span><b><?=$ds["pangkat"]." ( ".$ds["gol_ruang"]." )"; ?></b></span>
								</td>
							</tr>
							<tr>
								<td>JABATAN</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
									  <span><b><?=($ds["jabatan"] == "") ? "-" : $ds["jabatan"]; ?></b></span>
								</td>
							</tr>
							<tr>
								<td>TIPE JABATAN</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
									  <span><b><?=($ds["tipe_jabatan"] == "") ? "-" : $ds["tipe_jabatan"]; ?></b></span>
								</td>
							</tr>
							<tr>
								<td>GOLONGAN DARAH</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
									  <span><b><?=($ds["golongan_darah"] == "") ? "-" : $ds["golongan_darah"] ; ?></b></span>
								</td>
							</tr>
							<tr>
								<td>JENIS KELAMIN</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
									  <span><b><?=($ds["jenis_kelamin"] == "") ? "-" : $ds["jenis_kelamin"]; ?></b></span>
								</td>
							</tr>
							<tr>
								<td>TEMPAT / TANGGAL LAHIR</td>
								<td>&nbsp;&nbsp; : &nbsp;&nbsp; </td>
								<td>
									  <span><b><?=$ds["tempat_lahir"] . ", ". tglindonesia($ds["tanggal_lahir"]); ?></b></span>
								</td>
							</tr><br/>
							<tr>
								<td colspan="3"><center><span>|<a href="?mod=ganti_password"> GANTI PASSWORD AKUN </a>|</span></center></td>
							</tr>
						</table>
					 </div>
				</div>

	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 
