<script type="text/javascript">
function realisasi(id_uraian_skp){
    //document.location.href="?mod=skp_realisasi&id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=" + id_uraian_skp;
    alert("Maaf, Konten ini telah dipindahkan ke modul lain");
}
function tambah(){
    document.location.href='?mod=skp_uraian_tambah&id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=0';
}
function edit(id_uraian_skp){
    <?php
        $add = "";
        if(isset($_GET["rat"]))
            $add = "&rat=1";
    ?>
    document.location.href='?mod=skp_uraian_tambah&id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=' + id_uraian_skp + "<?php echo($add); ?>";
}
function hapus(id_uraian_skp){
    <?php
        $add = "";
        if(isset($_GET["rat"]))
            $add = "&rat=1";
    ?>
    jConfirm("Anda yakin akan menghapus data uraian target SKP ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/skp/skp_uraian_hapus.php?id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=" + id_uraian_skp + "<?php echo($add); ?>";
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
                                <h1><a style="color:#AA9F00;" href=""></a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span></span></td>
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
					<h3 style="text-align: left;">URAIAN DATA SKP PEGAWAI <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
					<div class="bodypanel">
						<input type="button" value="Kembali" onclick="document.location.href='?mod=skp_target';" />
						<?php
							if($ds["status_supervisi"] == 3){
								if(isset($_GET["rat"])){
						?>
									<!--<input type="button" value="Tambah Data Uraian SKP" onclick="tambah();" />-->
						<?php
								}else{
						?>
									<div class="kelang_border"></div>
									<div class="alert alert-info" role="alert">
										<strong>Maaf !!!</strong> Data telah di ACC dan telah fix. Jika ingin merubah data ini,
										lakukan pada icon Revisi Akhir Tahun pada halaman sebelumnya
									</div>
						<?php
								}
							}else{
						?>
							<input type="button" value="Tambah Data Uraian SKP" onclick="tambah();" />
						<?php
							}
						?>
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
								<?php
									$STT_SPV = $ds["status_supervisi"];
									if($ds["status_supervisi"] == 3 && isset($_GET["rat"])){
								?>
								<th width='20px'>&nbsp;</th>
								<th width='20px'>&nbsp;</th>
								<?php
									}else if($ds["status_supervisi"] == 3 && empty($_GET["rat"])){
										
									}else{
								?>
								<th width='20px'>&nbsp;</th>
								<th width='20px'>&nbsp;</th>
								<?php
									}
								?>
							</tr>
						</thead>
						<tbody>
						<?php
							$res = mysql_query("SELECT
													a.*, b.satuan_waktu
												FROM
													tbl_uraian_skp a
													LEFT JOIN ref_satuan_waktu b ON a.id_satuan_waktu = b.id_satuan_waktu
												WHERE
													a.id_skp = '" . $id_skp . "'
												ORDER BY
													a.id_uraian_skp ASC") or die(mysql_error());
							$no = 0;
							while($ds = mysql_fetch_array($res)){
								$no++;
								echo("<tr>");
									echo("<td align='center'>" . $no . "</td>");
									echo("<td>" . $ds["kegiatan"] . "</td>");
									echo("<td align='center'>" . ($ds["ak"] * $ds["kuantitas"]) . "</td>");
									echo("<td align='center'>" . $ds["kuantitas"] . " " . $ds["satuan_kuantitas"] . "</td>");
									echo("<td align='center'>" . $ds["kualitas"] . "</td>");
									echo("<td align='center'>" . $ds["waktu"] . " " . $ds["satuan_waktu"] . "</td>");
									echo("<td align='center'>" . number_format($ds["biaya"], 0, ".", ",") . "</td>");
									if($STT_SPV == 3){
										if(isset($_GET["rat"])){
											echo("<td>
												<img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit data target kegiatan' onclick='edit(" . $ds["id_uraian_skp"] . ")' />
												 </td>");
											echo("<td>
													<img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus data target kegiatan' onclick='hapus(" . $ds["id_uraian_skp"] . ")' />
												 </td>");
										}
									}else{
										echo("<td>
											<img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit data target kegiatan' onclick='edit(" . $ds["id_uraian_skp"] . ")' />
											 </td>");
										echo("<td>
												<img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus data target kegiatan' onclick='hapus(" . $ds["id_uraian_skp"] . ")' />
											 </td>");
									}
									
								echo("</tr>");
							}
						?>
						</tbody>
						</table>
					</div>
				</div>
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
 



