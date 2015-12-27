<?php
    $spv_tugtam = 0;
    $spv_kreat = 0;
?>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">LIHAT TUGAS TAMBAHAN DAN KREATIVITAS</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>LIHAT TUGAS TAMBAHAN DAN KREATIVITAS</span></td>
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
		<input type="button" value="Kembali" onclick="document.location.href='?mod=tugtam_kreat_lihat_pilih_periode&id_pegawai=<?php echo($_GET["id_pegawai"]); ?>';" />
				<div class="kelang"></div>
				<form name="frm_tugas_tambahan" id="frm_tugas_tambahan" action="php/skp/tugas_tambahan_tambah.php" method="post">
				<div class="panelcontainer" style="width: 100%;">
					<h3 style="text-align: left;">ISI DATA TUGAS TAMBAHAN <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nip"))); ?>)</h3>
					<div class="bodypanel">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
						<thead>
							<tr class="headertable">
								<th width='40px'>No.</th>
								<th>Tugas Tambahan</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$res_tugas_tambahan = mysql_query("SELECT * FROM tbl_skp_tugas_tambahan WHERE id_skp='" . $_GET["id_skp"] . "'");
							$no_tugas_tambahan = 0;
							while($ds_tugas_tambahan = mysql_fetch_array($res_tugas_tambahan)){
								$spv_tugtam = $ds_tugas_tambahan["status_supervisi"];
								$no_tugas_tambahan++;
								echo("<tr>");
									echo("<td  align='center'>" . $no_tugas_tambahan . "</td>");
									echo("<td>" . $ds_tugas_tambahan["tugas_tambahan"] . "</td>");
								echo("</tr>");
							}
						?>
						</tbody>
					</table>
					</div>
				</div>
				</form>
				<div class="kelang"></div>
				<form name="frm_kreatifitas" id="frm_kreatifitas" action="php/skp/kreatifitas_tambah.php" method="post">
				<div class="panelcontainer" style="width: 100%;">
					<h3 style="text-align: left;">ISI DATA KREATIFITAS <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nip"))); ?>)</h3>
					<div class="bodypanel">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
						<thead>
							<tr class="headertable">
								<th width='40px'>No.</th>
								<th>Kreatifitas</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$res_tugas_tambahan = mysql_query("SELECT * FROM tbl_skp_kreatifitas WHERE id_skp='" . $_GET["id_skp"] . "'");
							$no_tugas_tambahan = 0;
							while($ds_tugas_tambahan = mysql_fetch_array($res_tugas_tambahan)){
								$spv_kreat = $ds_tugas_tambahan["status_supervisi"];
								$no_tugas_tambahan++;
								echo("<tr>");
									echo("<td align='center'>" . $no_tugas_tambahan . "</td>");
									echo("<td>" . $ds_tugas_tambahan["kreatifitas"] . "</td>");
								echo("</tr>");
							}
						?>
						</tbody>
					</table>
					</div>
				</div>
				</form>
				<div class="kelang"></div>
				<?php
					if($spv_tugtam == 1 || $spv_kreat == 1){
				?>
				<form name="frm_spv" id="frm_spv" action="php/skp/tugtam_kreat_lihat.php" method="post">
				<input type="hidden" name="id_skp" value="<?php echo($_GET["id_skp"]); ?>" />
				<div class="panelcontainer panelform" style="width: 100%;">
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<textarea placeholder="Catatan Keberatan" name="catatan"></textarea>
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td style="text-align: left;">
									<input type="submit" name="terima" value="TERIMA" style="width: 150px; height: 40px;" />
									<input type="submit" name="tolak" value="KEBERATAN" style="width: 150px; height: 40px;" />
								</td>
							</tr>
						</table>
					</div>
				</div>
				</form>
				<?php
					}
				?>
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 




				