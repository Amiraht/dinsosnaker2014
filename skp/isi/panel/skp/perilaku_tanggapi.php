<script type="text/javascript">
$(document).ready(function(){
    $( "#helper_tugas_tambahan" ).dialog({
        autoOpen: false,
		height: "auto",
		width: "800",
		modal: true,
        show: "fade",
		hide: "fade"
    }); 
    $( "#helper_kreatifitas" ).dialog({
        autoOpen: false,
		height: "auto",
		width: "1300",
		modal: true,
        show: "fade",
		hide: "fade"
    });
    $( "#dialog_cadis" ).dialog({
        autoOpen: false,
		height: 540,
		width: 900,
		modal: true,
        show: "fade",
		hide: "fade"
    });
    $( "#bantuan_perilaku" ).dialog({
        autoOpen: false,
		height: "auto",
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
        url: "ajax/cadis_spv_perilaku.php",
        data: "id_skp=" + id_skp,
        success: function(r){
            $("#dialog_cadis").html(r);
        }
    });
}
function bantuan_perilaku(urut){
    $("#bantuan_perilaku").dialog("open");
    $("#bantuan_perilaku").html("");
    $.ajax({
        type: "GET",
        url: "ajax/bantuan_perilaku.php",
        data: "urut=" + urut,
        success: function(r){
            $("#bantuan_perilaku").html(r);
        }
    });
}
function pilihbp(id_bp, urut){
    var id = "";
    if(urut == 1)
        id = "orientasi_pelayanan";
    else if(urut == 2)
        id = "integritas";
    else if(urut == 3)
        id = "komitmen";
    else if(urut == 4)
        id = "disiplin";
    else if(urut == 5)
        id = "kerja_sama";
    else if(urut == 6)
        id = "kepemimpinan";
    
    $("#" + id).val($("#cbh_" + id_bp).val());
    $("#bantuan_perilaku").dialog("close");
}
function show_tugas_tambahan(){
    $("#hlp_tugas_tambahan").val(0);
    $( "#helper_tugas_tambahan" ).dialog("open");
}
function show_kreatifitas(){
    $("#hlp_kreatifitas").val(0);
    $( "#helper_kreatifitas" ).dialog("open");
}
function pilih_tugas_tambahan(){
    $("#tugas_tambahan").val($("#hlp_tugas_tambahan").val());
    $( "#helper_tugas_tambahan" ).dialog("close");
}
function pilih_kreatifitas(){
    $("#kreatifitas").val($("#hlp_kreatifitas").val());
    $( "#helper_kreatifitas" ).dialog("close");
}
function proses_perilaku(stt){    
    var tanggapan = frm.tanggapan.value;
    if(tanggapan == "")
        jAlert("Maaf, Tanggapan pejabat penilai harus diisi", "PERHATIAN");
    else
        frm.submit();
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
                                <h1><a style="color:#AA9F00;" href="">TANGGAPAN PERILAKU PEGAWAI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TANGAPAN PERILAKU PEGAWAI</span></td>
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
						<h3 style="text-align: left;">DATA PERIODE PENILAIAN PERILAKU <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nip"))); ?>)</h3>
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
														a.id_skp_perilaku='" . $_GET["id_skp"] . "'
													ORDER BY
														a.dari ASC
													"));
							?>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td width='150px'>Periode</td>
									<td width='5px'>:</td>
									<td style="text-transform: uppercase;"><b><?php echo(tglindonesia($ds["dari"]) . " S/D " . tglindonesia($ds["sampai"])); ?></b></td>
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
								</tr>
								<tr>
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
					<?php
						$ds_skp = mysql_fetch_array(mysql_query("SELECT * FROM tbl_skp_perilaku WHERE id_skp_perilaku='" . $_GET["id_skp"] . "'"));
					?>
					<form>
					<input type="hidden" name="id_skp" value="<?php echo($_GET["id_skp"]); ?>" />
					<div class="panelcontainer panelform" style="width: 100%;">
						<h3 style="text-align: left;">ISI DATA PENILAIAN PERILAKU PEGAWAI <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nip"))); ?>)</h3>
						<div class="bodypanel bodyfilter" id="bodyfilter">
							<input type="button" value="Kembali" onclick="document.location.href='?mod=perilaku_tanggapi_pilih_periode&id_pegawai=<?php echo($_GET["id_pegawai"]); ?>';" />
							<div class="kelang"></div>
							<table border="0px" cellspacing='0' cellpadding='0'>
								<tr>
									<td width='150px'><b>ORIENTASI PELAYANAN</b></td>
									<td width='300px' style="text-align: justify;">
										Sikap dan perilaku kerja PNS dalam memberikan pelayanan terbaik kepada
										yang dilayani antara lain meliputi masyarakat, atasan, rekan sekerja,
										unit kerja terkait, dan/atau instansi lain
									</td>
									<td width='200px'>
										<input type="text" name="orientasi_pelayanan" id="orientasi_pelayanan" placeholder=":: Orientasi Pelayanan ::" value="<?php echo($ds_skp["orientasi_pelayanan"]); ?>" />
									</td>
									
									<td>&nbsp;</td>
									
									<td width='100px'><b>DISIPLIN</b></td>
									<td width='300px' style="text-align: justify;">
										Kesanggupan PNS untuk mentaati kewajiban dan menghindari larangan yang
										ditentukan dalam peraturan per-uu-an dan/atau peraturan kedinasan yang
										apabila tidak ditaati atau dilanggar dijatuhi hukuman disiplin
									</td>
									<td width='200px'>
										<input type="text" name="disiplin" id="disiplin" placeholder=":: Disiplin ::" value="<?php echo($ds_skp["disiplin"]); ?>" />
									</td>
								</tr>
								<tr>
									<td><b>INTEGRITAS</b></td>
									<td style="text-align: justify;">
										Kemampuan untuk bertindak sesuai dengan nilai, norma
										dan etika dalam organisasi
									</td>
									<td>
										<input type="text" name="integritas" id="integritas" placeholder=":: Integritas ::" value="<?php echo($ds_skp["integritas"]); ?>" />
									</td>
									
									<td>&nbsp;</td>
									
									<td><b>KERJA SAMA</b></td>
									<td style="text-align: justify;">
										Kemauan dan kemampuan PNS untuk bekerjasama dgn rekan sekerja, atasan,
										bawahan dalam unit kerjanya serta instansi lain dlm menyelesaikan suatu
										tugas dan tanggung jawab yang ditentukan, sehingga mencapai daya guna dan
										hasil guna yang sebesar-besarnya
									</td>
									<td>
										<input type="text" name="kerja_sama" id="kerja_sama" placeholder=":: Kerja Sama ::" value="<?php echo($ds_skp["kerja_sama"]); ?>" />
									</td>
								</tr>
								<tr>
									<td><b>KOMITMEN</b></td>
									<td style="text-align: justify;">
										Kemauan dan kemampuan untuk menyelaraskan sikap dan tindakan PNS yang mewujudkan
										tujuan organisasi dengan mengutamakan kepentingan dinas daripada kepentingan diri
										sendiri, seseorang, dan/atau golongan
									</td>
									<td>
										<input type="text" name="komitmen" id="komitmen" placeholder=":: Komitmen ::" value="<?php echo($ds_skp["komitmen"]); ?>" />
									</td>
									
									<td>&nbsp;</td>
									
									<td><b>KEPEMIMPINAN</b></td>
									<td style="text-align: justify;">
										Kemampuan dan kemauan PNS untuk memotivasi dan mempengaruhi bawahan atau orang
										lain yg berkaitan dgn bidang tugasnya demi tercapainya tujuan organisasi
									</td>
									<td>
										<input type="text" name="kepemimpinan" id="kepemimpinan" placeholder=":: Kepemimpinan ::" value="<?php echo($ds_skp["kepemimpinan"]); ?>" />
									</td>
								</tr>
							</table><br />
						</div>
					</div>
					</form>
					<div class="kelang"></div>
					<form name="frm" id="frm" action="php/skp/perilaku_tanggapi.php" method="post">
					<input type="hidden" name="id_skp" value="<?php echo($_GET["id_skp"]); ?>" />
					<input type="hidden" name="id_pegawai" value="<?php echo($_GET["id_pegawai"]); ?>" />
					<div class="panelcontainer panelform" style="width: 100%;">
						<h3 style="text-align: left;">ISI DATA KEBERATAN, TANGGAPAN, DAN KEPUTUSAN PERILAKU PEGAWAI <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_GET["id_pegawai"], "nip"))); ?>)</h3>
						<div class="bodypanel bodyfilter" id="bodyfilter">
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td>
										<label>Keberatan Dari PNS Yang Dinilai :</label>
										<div style="width: 100%; height: 80px; border: solid 1px #CCC; overflow-y: scroll; padding: 10px; font-family: sans-serif; font-size: 10pt; font-weight: bold;">
											<?php echo($ds_skp["keberatan"]); ?>
										</div>
									</td>
								</tr>
							</table>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td>
										<label>Tanggapan Pejabat Penilai Akan Keberatan :</label>
										<textarea name="tanggapan" placeholder="Berikan tanggapan atas keberatan pegawai yang dinilai"><?php echo($ds_skp["tanggapan"]); ?></textarea>
									</td>
								</tr>
							</table>
							<?php
								if($ds_skp["status_supervisi"] == 2){
							?>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td style="text-align: left;">
										<input name="terima" type="button" value="KIRIM KE ATASAN PEJABAT PENILAI" style="height: 40px;" onclick="proses_perilaku(1);" />
									</td>
								</tr>
							</table>
							<?php
								}else if($ds_skp["status_supervisi"] == 1){
									echo("<div style='font-family: verdana; font-weight: light; color: #458B00; font-size: 9pt; padding: 3px 10px; background-color: #EEEEEE; margin-bottom: 10px;'>Data perilaku belum ditanggapi oleh Pegawai yang bersangkutan</div>");
								}else if($ds_skp["status_supervisi"] == 3){
									echo("<div style='font-family: verdana; font-weight: light; color: #458B00; font-size: 9pt; padding: 3px 10px; background-color: #EEEEEE; margin-bottom: 10px;'>Data keberatan sedang di proses oleh Atasan Pejabat Penilai</div>");
								}
							?>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td>
										<label>Keputusan Atasan Pejabat Penilai Akan Keberatan :</label>
										<div style="width: 100%; height: 80px; border: solid 1px #CCC; overflow-y: scroll; padding: 10px; font-family: sans-serif; font-size: 10pt; font-weight: bold;">
											<?php echo($ds_skp["keputusan"]); ?>
										</div>
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
 


<!-- DIALOG JQUERY ------------------------------------------------------------------------------------------------- -->
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="Catatan : Supervisi Perilaku, Kreatifitas, Tugas Tambahan" style="display: none;">
    
</div>
<div id="bantuan_perilaku" title="Bantuan : Perilaku Pegawai" style="display: none;">
    
</div>
<!-- ------------- -->
<!-- --------------------------------------------------------------------------------------------------------------- -->