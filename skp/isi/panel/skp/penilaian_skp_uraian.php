<?php
	$id = mysql_real_escape_string(trim(strip_tags($_GET["id"])));
?>
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
function catatan(bulan){
    $("#dialog_cadis").dialog("open");
    $.ajax({
        type: "GET",
        url: "ajax/cadis_spv_penilaian_skp.php",
        data: "id_skp=<?php echo $id; ?>&bulan=" + bulan,
        success: function(r){
            $("#dialog_cadis").html(r);
        }
    });
}
function disimpan(){
    jConfirm("Anda yakin akan menyimpan data penilaian SKP ini?", "PERHATIAN", function(r){
       if(r){
            $("#frm").submit();
       } 
    });
}
function realisasi(id_uraian_skp){
    <?php
        $ds_udh_acc = mysql_fetch_array(mysql_query("SELECT * FROM tbl_skp WHERE id_skp='" . $_GET["id"] . "'"));
        if($ds_udh_acc["status_supervisi"] != 3){
    ?>
            jAlert("Maaf, SKP ini belum di ACC (terima) oleh Pejabat Penilai. Data penilaian SKP belum bisa dientry", "PERHATIAN");
    <?php
        }else{
    ?>
            document.location.href="?mod=skp_realisasi&id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=" + id_uraian_skp;
    <?php
        }
    ?>
}
function ganti_bulan(bulan_ke){
    document.location.href="?mod=penilaian_skp_uraian&id=<?php echo($_GET["id"]); ?>&bulan_ke=" + bulan_ke;
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
                                <h1><a style="color:#AA9F00;" href="">URAIAN PENILAIAN SKP</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>URAIAN PENILAIAN SKP</span></td>
                            <td>&nbsp;</td>
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
				<h3 style="text-align: left;">DATA SKP <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> 
				(NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3><br/>
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
												a.id_skp='" . $_GET["id"] . "'
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
			</fieldset>
			<br/><br/>
			<fieldset>
			<?php
				// PADA BAGIAN INI MENDESKRIPSI KAN BULAN KEBERAPA PENILAIAN DIINPUT
				$bulan_ke = 0;
				$sudah_bener = 0;
				$status_spv_belum_acc = 0;
				// CEK APAKAH MASIH ADA YANG BELUM DISUPERVISI
				$ds_cek_belum_supervisi = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS total FROM tbl_uraian_realisasi_skp WHERE id_skp='" . $_GET["id"] . "' AND status_supervisi<>'3'"));
				if($ds_cek_belum_supervisi["total"] == 0){
					/**
			 * $ds_bulan_ke = mysql_fetch_array(mysql_query("SELECT
			 *                                                     	CASE
			 *                                                     		WHEN MAX(bulan) IS NULL THEN 0
			 *                                                     		ELSE MAX(bulan)
			 *                                                     	END AS bulan
			 *                                                     FROM 
			 *                                                     	tbl_uraian_realisasi_skp WHERE id_skp = '" . $_GET["id"] . "'"));
			 */
					if($_GET["bulan_ke"] == 0 || empty($_GET["bulan_ke"]))
						$bulan_ke = intval(date("m"));
					else
						$bulan_ke = $_GET["bulan_ke"];
					$sudah_bener = 1;
				}else{
					$ds_bulan_ke = mysql_fetch_array(mysql_query("SELECT bulan, status_supervisi FROM tbl_uraian_realisasi_skp WHERE id_skp='" . $_GET["id"] . "' AND status_supervisi<>3 GROUP BY bulan"));
					$bulan_ke = $ds_bulan_ke["bulan"];
					$sudah_bener = 0;
					$status_spv_belum_acc = $ds_bulan_ke["status_supervisi"];    
				}
				
			?>
				<h3 style="text-align: left;">URAIAN DATA SKP PEGAWAI <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> 
				(NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3><br/><br/>
					<input type="button" value="Kembali" onclick="document.location.href='?mod=penilaian_skp_target';" />
					<?php
						if($status_spv_belum_acc == 2){
					?>
						<input type="button" value="Lihat Catatan Supervisi" onclick="catatan(<?php echo($bulan_ke); ?>);" />
						<div class="kelang_border"></div>
						<div class="alert alert-danger" role="alert">
							<strong>Maaf !!!</strong> Data penilaian SKP untuk bulan ini Perlu perbaikan dari pegawai yang bersangkutan.
							Maka penginputan penilaian SKP berikutnya belum dapat dilanjutkan
						</div>
					<?php
						}else if($status_spv_belum_acc == 1){
					?>
						<div class="kelang_border"></div>
						<div class="alert alert-info" role="alert">
							<strong>Maaf !!!</strong> Data penilaian SKP untuk bulan ini belum di ACC oleh Pejabat Penilai.
							Maka penginputan penilaian SKP berikutnya belum dapat dilanjutkan
						</div>
					<?php
						}
					?>
					<?php
						//echo("<h3>" . $bulan_ke . "</h3>");
						if($sudah_bener == 0){
					?>
					<div style="padding: 5px; border: solid 1px #CCC; font-family: sans-serif; font-size: 10pt; font-weight: bold;">
						Bulan Ke : <?php echo( $bulan_ke . " ( " . bulan_ke_skp($bulan_ke, $_GET["id"]) . " )"); ?>
					</div>
					<?php
						}else{
					?>
					<div class="kelang_border"></div>
					Pilih bulan untuk diinput :<br />
					<select name="cboBulan" id="cboBulan" style="width: 20%;" onchange="ganti_bulan(this.value);">
					<?php
						$arr_bulan = array(":: Pilih Bulan ::", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
											"September", "Oktober", "November", "Desember");
						$dari = $ds["dari"];
						$sampai = $ds["sampai"];
						$explode_dari = explode("-", $dari);
						$explode_sampai = explode("-", $sampai);
						$bulan_dari = intval($explode_dari[1]);
						$bulan_sampai = intval($explode_sampai[1]);
						for($i_bln=$bulan_dari; $i_bln<=$bulan_sampai; $i_bln++){
							if($i_bln == $bulan_ke)
								echo("<option value='" . $i_bln . "' selected='selected'>" . $arr_bulan[$i_bln] . "</option>");
							else
								echo("<option value='" . $i_bln . "'>" . $arr_bulan[$i_bln] . "</option>");
						}
					?>
					</select>
					<?php
						}
					?>
					
					<br/>
					<form name="frm" id="frm" action="php/skp/penilaian_skp_uraian.php" method="post">
						<input type="hidden" name="id_skp" value="<?php echo($_GET["id"]); ?>" />
						<input type="hidden" name="bulan" value="<?php echo($bulan_ke); ?>" />
						<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtablebackup">
						<thead>
							<tr class="headertable">
								<th width='40px'>No.</th>
								<th>Kegiatan / Tugas Jabatan</th>
								<th colspan="2">Kuantitas / Output</th>
								<th width='150px'>Kualitas / Mutu</th>
								<th colspan="2">Waktu</th>
								<th width='150px'>Biaya</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$res = mysql_query("SELECT
													a.*, b.satuan_waktu,
													c.kuantitas AS rel_kuantitas, c.kualitas AS rel_kualitas,
													c.waktu AS rel_waktu, c.biaya AS rel_biaya
												FROM
													tbl_uraian_skp a
													LEFT JOIN ref_satuan_waktu b ON a.id_satuan_waktu = b.id_satuan_waktu
													LEFT JOIN tbl_uraian_realisasi_skp c ON (a.id_uraian_skp = c.id_uraian_skp AND c.bulan = '" . $bulan_ke . "')
												WHERE
													a.id_skp = '" . $_GET["id"] . "'");
							$no = 0;
							while($ds = mysql_fetch_array($res)){
								$no++;
								echo("<tr>");
									echo("<td align='center'>" . $no . "</td>");
									echo("<td>" . $ds["kegiatan"] . "</td>");
									echo("<td align='center' width='50px'><input style='width: 90%;' type='text' name='kuantitas_" . $ds["id_uraian_skp"] . "' value='" . $ds["rel_kuantitas"] . "'></td>");
									echo("<td align='center' width='100px'>" . $ds["satuan_kuantitas"] . "</td>");
									echo("<td align='center'>");
											echo("<select name='kualitas_" . $ds["id_uraian_skp"] . "'>");
											for($i=0; $i<=100; $i++){
												if($ds["rel_kualitas"] == $i)
													echo("<option selected='selected'>" . $i . "</option>");
												else
													echo("<option>" . $i . "</option>");
											}
											echo("</select>");
									echo("</td>");
									echo("<td align='center' width='50px'><input style='width: 90%;' type='text' name='waktu_" . $ds["id_uraian_skp"] . "' value='" . $ds["rel_waktu"] . "'></td>");
									echo("<td align='center' width='100px'>" . $ds["satuan_waktu"] . "</td>");
									echo("<td align='center'><input style='width: 90%;' type='text' name='biaya_" . $ds["id_uraian_skp"] . "' value='" . $ds["rel_biaya"] . "'></td>");
								echo("</tr>");
							}
						?>
						</tbody>
						</table>
						<div class="kelang_border"></div>
						<?php
							$ds_kehadiran = mysql_fetch_array(mysql_query("SELECT * FROM tbl_skp_kehadiran WHERE id_skp='" . $_GET["id"] . "' AND bulan='" . $bulan_ke . "'"));
						?>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<label>Jumlah Hari Kerja</label>
									<input type="text" placeholder=":: Jumlah Hari Kerja ::" name="hari" value="<?php echo($ds_kehadiran["hari"]); ?>" />
								</td>
								<td>
									<label>Hadir :</label>
									<input type="text" placeholder=":: Hadir ::" name="hadir" value="<?php echo($ds_kehadiran["hadir"]); ?>" />
								</td>
								<td>
									<label>Tanpa Alasan :</label>
									<input type="text" placeholder=":: Tanpa Alasan ::" name="alpa" value="<?php echo($ds_kehadiran["alpa"]); ?>" />
								</td>
								<td>
									<label>Sakit :</label>
									<input type="text" placeholder=":: Sakit ::" name="sakit" value="<?php echo($ds_kehadiran["sakit"]); ?>" />
								</td>
								<td>
									<label>Izin :</label>
									<input type="text" placeholder=":: Izin ::" name="izin" value="<?php echo($ds_kehadiran["izin"]); ?>" />
								</td>
								<td>
									<label>Cuti :</label>
									<input type="text" placeholder=":: Cuti ::" name="cuti" value="<?php echo($ds_kehadiran["cuti"]); ?>" />
								</td>
								<td>
									<label>Tugas Luar :</label>
									<input type="text" placeholder=":: Tugas Luar ::" name="tugas_luar" value="<?php echo($ds_kehadiran["tugas_luar"]); ?>" />
								</td>
								<td>
									<label>Tugas Belajar :</label>
									<input type="text" placeholder=":: Tugas Belajar ::" name="tugas_belajar" value="<?php echo($ds_kehadiran["tugas_belajar"]); ?>" />
								</td>
							</tr>
						</table>
						<div class="kelang_border"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td style="text-align: right;">
								<button type="button" class="btn btn-lg btn-success" onclick="disimpan();">Simpan</button>
								<button type="reset" class="btn btn-lg btn-default">Reset</button>
							</td>
						</tr>
					</table>
					</form>
			 </fieldset>
 
 
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 
 
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="Catatan : Supervisi Penilaian SKP" style="display: none;">
    
</div>
<!-- ------------- -->

