<script type="text/javascript">
$(document).ready(function(){
   $( "#helper_kualitas" ).dialog({
        autoOpen: false,
		height: "auto",
		width: "1200",
		modal: true,
        show: "fade",
		hide: "fade"
    }); 
});
function show_helper_kualitas(){
    $("#hlp_kualitas").val(0);
    $("#hlp_angka").html("");
    $( "#helper_kualitas" ).dialog("open");
}
function push_hlp_angka(){
    var isi = "";
    var dari = 0;
    var sampai = 0;
    var id_hlp_kualitas = $("#hlp_kualitas").val();
    if(id_hlp_kualitas == 1){
        dari = 91;
        sampai = 100;
    }else if(id_hlp_kualitas == 2){
        dari = 76;
        sampai = 90;
    }else if(id_hlp_kualitas == 3){
        dari = 61;
        sampai = 75;
    }else if(id_hlp_kualitas == 4){
        dari = 51;
        sampai = 60;
    }else if(id_hlp_kualitas == 5){
        dari = 0;
        sampai = 50;
    }
    for(var i=dari; i<=sampai; i++){
        isi += "<option value='" + i + "'>" + i + "</option>";
    }
    $("#hlp_angka").html(isi);
}
function pilih_kualitas(parsing_kal){
    var kualitas = $("#hlp_angka").val();
    $("#kualitas").val(kualitas);
    $( "#helper_kualitas" ).dialog("close");
}
</script>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">TAMBAH REALISASI SKP</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH REALISASI SKP</span></td>
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
				<h3 style="text-align: left;">DATA SKP <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<?php
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
												a.id_skp='" . $_GET["id_skp"] . "'
											ORDER BY
												a.dari ASC
											"));
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
				</div>
			</div>
			<div class="kelang"></div>
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">URAIAN TARGET SKP</h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
				<?php
					$ds_target = mysql_fetch_array(mysql_query("SELECT
												a.*, b.satuan_waktu
											FROM
												tbl_uraian_skp a
												LEFT JOIN ref_satuan_waktu b ON a.id_satuan_waktu = b.id_satuan_waktu
											WHERE
												a.id_uraian_skp = '" . $_GET["id_uraian_skp"] . "'"));
				?>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='150px'>Kegiatan</td>
							<td width='5px'>:</td>
							<td width='300px' style="text-transform: uppercase;"><b><?php echo($ds_target["kegiatan"]); ?></b></td>
							
							<td width='150px'>Kualitas</td>
							<td width='5px'>:</td>
							<td style="text-transform: uppercase;"><b><?php echo($ds_target["kualitas"]); ?> %</b></td>
						</tr>
						<tr>
							<td width='150px'>AK</td>
							<td width='5px'>:</td>
							<td style="text-transform: uppercase;"><b><?php echo($ds_target["ak"] * $ds_target["kuantitas"]); ?></b></td>
							
							<td width='150px'>Waktu</td>
							<td width='5px'>:</td>
							<td style="text-transform: uppercase;"><b><?php echo($ds_target["waktu"] . " " . $ds_target["satuan_waktu"]); ?></b></td>
						</tr>
						<tr>
							<td width='150px'>Kuantitas</td>
							<td width='5px'>:</td>
							<td style="text-transform: uppercase;"><b><?php echo($ds_target["kuantitas"] . " " . $ds_target["satuan_kuantitas"]); ?></b></td>
							
							<td width='150px'>Biaya</td>
							<td width='5px'>:</td>
							<td style="text-transform: uppercase;"><b><?php echo(number_format($ds_target["biaya"], 0, ".", ",")); ?></b></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="kelang"></div>
			<?php
				$ds_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_uraian_realisasi_skp WHERE id_uraian_realisasi_skp='" . $_GET["id_uraian_realisasi_skp"] . "'"));
			?>
			<form name="frm" id="frm" action="php/skp/skp_realisasi_tambah.php" method="post">
			<input type="hidden" name="id_uraian_realisasi_skp" value="<?php echo($_GET["id_uraian_realisasi_skp"]); ?>" />
			<input type="hidden" name="id_uraian_skp" value="<?php echo($_GET["id_uraian_skp"]); ?>" />
			<input type="hidden" name="id_skp" value="<?php echo($_GET["id_skp"]); ?>" />
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">TAMBAH DATA REALISASI URAIAN SKP PEGAWAI <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<input type="button" value="Kembali" onclick="document.location.href='?mod=skp_realisasi&id_skp=<?php echo($_GET["id_skp"]); ?>&id_uraian_skp=<?php echo($_GET["id_uraian_skp"]); ?>';" />
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<label>Kuantitas / Output : (dalam <?php echo($ds_target["satuan_kuantitas"]); ?>)</label>
								<input type="text" name="kuantitas" id="kuantitas" placeholder=":: Kuantitas / Output ::" title="Kuantitas / Output" value="<?php echo($ds_data["kuantitas"]); ?>" />
							</td>
						</tr>
					</table>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='33%'>
								<label>
									Kualitas / Mutu :
									<a href="javascript:show_helper_kualitas();" class="link_auto_panel input_widget">bantuan</a>
								</label>
								<input type="text" name="kualitas" id="kualitas" placeholder=":: Kualitas / Mutu ::" title="Kualitas / Mutu" value="<?php echo($ds_data["kualitas"]); ?>" />
							</td>
							<td width='33%'>
								<label>Waktu : (dalam <?php echo($ds_target["satuan_waktu"]); ?>)</label>
								<input type="text" name="waktu" id="waktu" placeholder=":: Waktu ::" title="Waktu" value="<?php echo($ds_data["waktu"]); ?>" />
							</td>
							<td>
								<label>Biaya :</label>
								<input type="text" name="biaya" id="biaya" placeholder=":: Biaya ::" title="Biaya" value="<?php echo($ds_data["biaya"]); ?>" />
							</td>
						</tr>
					</table>
					<table border="0px" cellspacing='0' cellpadding='0' width='70%'>
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
			<!-- DIALOG JQUERY -->
			<div id="helper_kualitas" title="BANTUAN : PANDUAN KUALITAS SKP" style="display: none;">
			<div class="panelcontainer panelform" style="width: 100%;">
				<div class="bodypanel">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<select id="hlp_kualitas" onchange="push_hlp_angka();">
									<option value="0">:: Pilih Keterangan ::</option>
									<?php
										$res_cb = mysql_query("SELECT * FROM ref_kualitas_skp ORDER BY id_kualitas_skp");
										while($ds_cb = mysql_fetch_array($res_cb)){
											echo("<option value='" . $ds_cb["id_kualitas_skp"] . "'>" . $ds_cb["kualitas_skp"] . "</option>");
										}
									?>
								</select>
							</td>
						</tr>
					</table>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='100px'>
								<select id="hlp_angka">
									
								</select>
							</td>
							<td>
								<input type="button" value="Pilih Kualitas" onclick="pilih_kualitas();" />
							</td>
						</tr>
					</table>
				</div>
			</div>
			</div>
			<!-- ------------- -->
	</div>
</td>
</tr>

<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 




