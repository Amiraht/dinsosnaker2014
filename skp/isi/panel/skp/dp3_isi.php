

<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">DATA PERIODE PENILAIAN PERILAKU</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DATA PERIODE PENILAIAN PERILAKU</span></td>
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
		
				<fieldset>
					<h3 style="text-align: left;">DATA PERIODE PENILAIAN PERILAKU 
					<?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nama_pegawai"))); ?> 
					(NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nip"))); ?>)</h3><br/>
						<?php
							$ds = mysql_fetch_array(mysql_query("SELECT
													a.*, b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
													c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai,
													d.pangkat AS pangkat_penilai, d.gol_ruang AS gol_ruang_penilai,
													e.pangkat AS pangkat_atasan_penilai, e.gol_ruang AS gol_ruang_atasan_penilai,
													f.skpd AS skpd_penilai, g.skpd AS skpd_atasan_penilai,
													h.jabatan AS jabatan_penilai, i.jabatan AS jabatan_atasan_penilai
												FROM
													tbl_skp_perilaku a
													LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
													LEFT JOIN tbl_pegawai c ON a.id_atasan_pegawai_penilai = c.id_pegawai
													LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
													LEFT JOIN ref_pangkat e ON c.id_pangkat = e.id_pangkat
													LEFT JOIN ref_skpd f ON b.id_satuan_organisasi = f.id_skpd
													LEFT JOIN ref_skpd g ON c.id_satuan_organisasi = g.id_skpd
													LEFT JOIN ref_jabatan h ON b.id_jabatan = h.id_jabatan
													LEFT JOIN ref_jabatan i ON c.id_jabatan = i.id_jabatan
												WHERE
													a.id_skp_perilaku='" . $_GET["id"] . "'
												ORDER BY
													a.dari ASC
												")) or die(mysql_error());
						?>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='150px'>Periode</td>
								<td width='5px'>:</td>
								<td style="text-transform: uppercase;"><b><?php echo(tglindonesia($ds["dari"]) . " S/D " . tglindonesia($ds["sampai"])); ?></b></td>
								<td width='150px'>&nbsp;</td>
								<td width='5px'>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>Pejabat Penilai</td>
								<td>:</td>
								<td style="text-transform: uppercase;">
									<b>
										<?php echo($ds["nama_pegawai_penilai"]); ?><br />
										NIP : <?php echo($ds["nip_penilai"]); ?><br />
										Pangkat : <?php echo($ds["pangkat_penilai"]); ?><br />
										Jabatan : <?php echo($ds["jabatan_penilai"]); ?><br />
										SKPD : <?php echo($ds["skpd_penilai"]); ?>
									</b>
								</td>
								
								<td>Atasan Pejabat Penilai</td>
								<td>:</td>
								<td style="text-transform: uppercase;">
									<b>
										<?php echo($ds["nama_pegawai_atasan_penilai"]); ?><br />
										NIP : <?php echo($ds["nip_atasan_penilai"]); ?><br />
										Pangkat : <?php echo($ds["pangkat_atasan_penilai"]); ?><br />
										Jabatan : <?php echo($ds["jabatan_atasan_penilai"]); ?><br />
										SKPD : <?php echo($ds["skpd_atasan_penilai"]); ?>
									</b>
								</td>
							</tr>
						</table>
				</fieldset>
				<br/><br/>
				<fieldset>
					<h3 style="text-align: left;">ISI DATA PENILAIAN PERILAKU PEGAWAI 
					<?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nip"))); ?>)</h3>
					
					<form name="frm" id="frm" action="php/skp/dp3_isi.php" method="post">
					<input type="hidden" name="id_skp" value="<?php echo($_GET["id"]); ?>" />

					
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<input type="button" value="Kembali" onclick="document.location.href='?mod=dp3_pilih_periode';" />
						<input type="button" value="Lihat / Cetak DP3" onclick="window.open('cetak/cetak_dp3_baru.php?id_skp=<?php echo($_GET["id"]); ?>');" />
					</div>
					</form>
				</fieldset>	
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 

