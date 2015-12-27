<script type="text/javascript">
$(document).ready(function(){
    $( "#dialog_cadis" ).dialog({
        autoOpen: false,
		height: 540,
		width: 900,
		modal: true,
        show: "fade",
		hide: "fade"
    }); 
});
function catatan(id_skp){
    $("#dialog_cadis").dialog("open");
    $.ajax({
        type: "GET",
        url: "ajax/cadis_spv_upload_dp3.php",
        data: "id_skp=" + id_skp,
        success: function(r){
            $("#dialog_cadis").html(r);
        }
    });
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
                                <h1><a style="color:#AA9F00;" href="">PROSES UPLOAD DP3</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>PROSES UPLOAD DP3</span></td>
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
					<h3 style="text-align: left;">DATA PERIODE <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nip"))); ?>)</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<?php
							$id_skp = mysql_real_escape_string(trim(strip_tags($_GET["id"])));
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
				<form name="frm" id="frm" action="php/skp/upload_dp3_proses.php" method="post" enctype="multipart/form-data">
				<?php
					$ds_dp3 = mysql_fetch_array(mysql_query("SELECT id_skp, status_supervisi FROM tbl_skp_dp3_upload WHERE id_skp='" . $id_skp . "'"));
				?>
				<input type="hidden" name="id_skp" value="<?php echo $id_skp; ?>" />
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">UPLOAD DATA PENILAIAN PERILAKU PEGAWAI <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nip"))); ?>)</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<input type="button" value="Kembali" onclick="document.location.href='?mod=upload_dp3_pilih_periode';" />
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='50%'>
							<tr>
								<td>
									<b>
									Status supervisi atasan pejabat penilai :
									<i>
									<?php
										switch($ds_dp3["status_supervisi"]){
											case 1 :
												echo("Belum di supervisi");
												break;
											case 2 :
												echo("Perlu perbaikan");
												break;
											case 3 :
												echo("Diterima");
												break;
										}
									?>
									</i>
										<a href="javascript:catatan(<?php echo($_GET["id"]); ?>);" class="link_auto_panel input_widget">Lihat Catatan Supervisi</a>
									</b>
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<?php
								if(isset($_GET["err_msg"]) && $_GET["err_msg"] != ""){
							?>
							<tr>
								<td class="err_msg"><?php echo($_GET["err_msg"]); ?></td>
							</tr>
							<?php   
								}
							?>
							<tr>
								<td>
									<label>
										Target SKP :
										<a href="isi/panel/skp/lihat_upload_dp3.php?id_skp=<?php echo($_GET["id"]); ?>&jenis=skp" target="_blank" class="link_auto_panel input_widget">Lihat</a>
									</label>
									<input type="file" name="skp" />
								</td>
							</tr>
							<tr>
								<td>
									<label>
										Penilaian SKP :
										<a href="isi/panel/skp/lihat_upload_dp3.php?id_skp=<?php echo($_GET["id"]); ?>&jenis=penilaian" target="_blank" class="link_auto_panel input_widget">Lihat</a>
									</label>
									<input type="file" name="penilaian" />
								</td>
							</tr>
							<tr>
								<td>
									<label>
										DP3 :
										<a href="isi/panel/skp/lihat_upload_dp3.php?id_skp=<?php echo($_GET["id"]); ?>&jenis=dp3" target="_blank" class="link_auto_panel input_widget">Lihat</a>
									</label>
									<input type="file" name="dp3" />
								</td>
							</tr>
						</table>
						<?php
							if(isset($ds_skp["status_supervisi"]) && $ds_skp["status_supervisi"] != 3){
						?>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td style="text-align: left;">
									<input type="submit" value="UPLOAD" style="width: 150px; height: 40px;" />
									<input type="reset" value="RESET" style="width: 150px; height: 40px;" />
								</td>
							</tr>
						</table>
						<?php
							}else{
						?>
						<table border="0px" cellspacing='0' cellpadding='0' width='50%'>
							<tr>
								<td>
									<b>
										Data perilaku ini telah diterima (ACC). Data tidak dapat diubah kembali
									</b>
								</td>
							</tr>
						</table>
						<?php
							}
						?>
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
 
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="Catatan : Supervisi Upload Hasil Penilaian Pegawai" style="display: none;">
    
</div>
<!-- ------------- -->