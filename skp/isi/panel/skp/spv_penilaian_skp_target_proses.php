<script type="text/javascript">
function realisasi(id_uraian_skp){
    //document.location.href="?mod=skp_realisasi&id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=" + id_uraian_skp;
    alert("Maaf, Konten ini telah dipindahkan ke modul lain");
}
function edit(id_uraian_skp){
    document.location.href='?mod=skp_uraian_tambah&id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=' + id_uraian_skp;
}
function hapus(id_uraian_skp){
    jConfirm("Anda yakin akan menghapus data uraian target SKP ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/skp/skp_uraian_hapus.php?id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=" + id_uraian_skp;
        }
    })
}
function go_spv(terima){
    $("#terima").val(terima);
    var catatan = $("#catatan").val();
    if(terima == 1)
        jConfirm("Anda yakin telah memeriksa data input ini?", "PERHATIAN", function(r){
            if(r){
                frm.submit();
            }
        });
    else{
        if(catatan == 0)
            jAlert("Maaf, jika ingin menolak harap diiskan catatan agar pegawai yang bersangkutan mengetahui alasan penolakan", "PERHATIAN")
        else
            jConfirm("Anda yakin akan menolak data input ini?", "PERHATIAN", function(r){
               if(r){
                    frm.submit();
               } 
            });
    }
}
</script>
<?php

			$id_skp = mysql_real_escape_string(trim(strip_tags($_GET["id_skp"])));
		
            $ds = mysql_fetch_array(mysql_query("SELECT
                                	a.*, b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
                                	c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai,
                                	d.pangkat AS pangkat_penilai, d.gol_ruang AS gol_ruang_penilai,
                                	e.pangkat AS pangkat_atasan_penilai, e.gol_ruang AS gol_ruang_atasan_penilai,
                                	f.skpd AS skpd_penilai, g.skpd AS skpd_atasan_penilai,
                                	h.jabatan AS jabatan_penilai, i.jabatan AS jabatan_atasan_penilai
                                FROM
                                	tbl_skp a
                                	LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
                                	LEFT JOIN tbl_pegawai c ON a.id_atasan_pegawai_penilai = c.id_pegawai
                                	LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
                                	LEFT JOIN ref_pangkat e ON c.id_pangkat = e.id_pangkat
                                	LEFT JOIN ref_skpd f ON b.id_satuan_organisasi = f.id_skpd
                                	LEFT JOIN ref_skpd g ON c.id_satuan_organisasi = g.id_skpd
                                	LEFT JOIN ref_jabatan h ON b.id_jabatan = h.id_jabatan
                                	LEFT JOIN ref_jabatan i ON c.id_jabatan = i.id_jabatan
                                WHERE
                                	a.id_skp='" . $id_skp . "'
                                ORDER BY
                                	a.dari ASC
                                "));
        ?>
		

<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">SUPERVISI PENILAIAN PROSES SKP TARGET</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>SUPERVISI PENILAIAN PROSES SKP TARGET</span></td>
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
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">DATA SKP <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nip"))); ?>)</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
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
								
								<td>Pejabat Penandatangan Penilaian SKP</td>
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
					</div>
				</div>
				<div class="kelang"></div>
				<div class="panelcontainer" style="width: 100%;">
					<h3 style="text-align: left;">PENILAIAN DATA SKP PEGAWAI <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nip"))); ?>)</h3>
					<div class="bodypanel">
						<input type="button" value="Kembali" onclick="document.location.href='?mod=spv_skp_target';" />
						<div class="kelang"></div>
						<?php
							$ds_bulan_ke = mysql_fetch_array(mysql_query("SELECT bulan FROM tbl_uraian_realisasi_skp WHERE id_skp='" . $id_skp . "' AND status_supervisi=1 GROUP BY bulan"));
							$bulan_ke = $ds_bulan_ke["bulan"];
						?>
						<div style="padding: 5px; border: solid 1px #CCC; font-family: sans-serif; font-size: 10pt; font-weight: bold;">Bulan Ke : <?php echo( $bulan_ke . " ( " . bulan_ke_skp($bulan_ke, $id_skp) . " )"); ?></div>
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
						<thead>
							<tr class="headertable">
								<th width='40px'>No.</th>
								<th>Kegiatan / Tugas Jabatan</th>
								<th width='50px'>AK</th>
								<th width='150px'>Kuantitas / Output</th>
								<th width='150px'>Kualitas / Mutu</th>
								<th width='150px'>Waktu (Bulan)</th>
								<th width='150px'>Biaya</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$res_data = mysql_query("SELECT
														a.*, b.satuan_waktu,
														c.kuantitas AS kuan_rel, c.kualitas AS kual_rel, c.waktu AS waktu_rel, c.biaya AS biaya_rel
													FROM
														tbl_uraian_skp a
														LEFT JOIN ref_satuan_waktu b ON a.id_satuan_waktu = b.id_satuan_waktu
														LEFT JOIN tbl_uraian_realisasi_skp c ON a.id_uraian_skp = c.id_uraian_skp
													WHERE
														a.id_skp = '" . $id_skp . "' AND c.status_supervisi = 1");
							$no = 0;
							while($ds_data = mysql_fetch_array($res_data)){
								$no++;
								echo("<tr>");
									echo("<td align='center'>" . $no . "</td>");
									echo("<td>" . $ds_data["kegiatan"] . "</td>");
									echo("<td align='center'>" . ($ds_data["ak"] * $ds_data["kuan_rel"]) . "</td>");
									echo("<td align='center'>" . $ds_data["kuan_rel"] . " " . $ds_data["satuan_kuantitas"] . "</td>");
									echo("<td align='center'>" . $ds_data["kual_rel"] . " %</td>");
									echo("<td align='center'>" . $ds_data["waktu_rel"] . " " . $ds_data["satuan_waktu"] . "</td>");
									echo("<td align='center'>" . number_format($ds_data["biaya_rel"], 0, ".", ",") . "</td>");
								echo("</tr>");
							}
						?>
						</tbody>
						</table>
						<div class="kelang_border"></div>
						<?php
								$ds_kehadiran = mysql_fetch_array(mysql_query("SELECT * FROM tbl_skp_kehadiran WHERE id_skp = '" . $id_skp. "' AND bulan='" . $bulan_ke . "'"));
							?>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td>
										<label>Jumlah Hari Kerja</label>
										<div class="label_caption"><?php echo($ds_kehadiran["hari"]); ?></div>
									</td>
									<td>
										<label>Hadir :</label>
										<div class="label_caption"><?php echo($ds_kehadiran["hadir"]); ?></div>
									</td>
									<td>
										<label>Tanpa Alasan :</label>
										<div class="label_caption"><?php echo($ds_kehadiran["alpa"]); ?></div>
									</td>
									<td>
										<label>Sakit :</label>
										<div class="label_caption"><?php echo($ds_kehadiran["sakit"]); ?></div>
									</td>
									<td>
										<label>Izin :</label>
										<div class="label_caption"><?php echo($ds_kehadiran["izin"]); ?></div>
									</td>
									<td>
										<label>Cuti :</label>
										<div class="label_caption"><?php echo($ds_kehadiran["cuti"]); ?></div>
									</td>
									<td>
										<label>Tugas Luar :</label>
										<div class="label_caption"><?php echo($ds_kehadiran["tugas_luar"]); ?></div>
									</td>
									<td>
										<label>Tugas Belajar :</label>                        
										<div class="label_caption"><?php echo($ds_kehadiran["tugas_belajar"]); ?></div>
									</td>
								</tr>
							</table>
					</div>
				</div>
				<div class="kelang"></div>
				<form name="frm" id="frm" action="php/skp/spv_penilaian_skp_target_proses.php" method="post">
				<input type="hidden" name="id_skp" value="<?php echo($id_skp); ?>" />
				<input type="hidden" name="bulan" value="<?php echo($bulan_ke); ?>" />
				<input type="hidden" name="id_tujuan" value="<?php echo($ds["id_pegawai"]); ?>" />
				<input type="hidden" name="terima" id="terima" />
				<div class="panelcontainer panelform" style="width: 100%;">
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<textarea placeholder="Catatan Supervisi" name="catatan" id="catatan"></textarea>
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td style="text-align: left;">
									<button type="button" class="btn btn-lg btn-success" onclick="go_spv(1);">Terima</button>
									<button type="button" class="btn btn-lg btn-default" onclick="go_spv(0);">Tolak</button>
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
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 
		
		
		
		
