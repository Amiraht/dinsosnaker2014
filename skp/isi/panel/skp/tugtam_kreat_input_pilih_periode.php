<script type="text/javascript">
function lanjut(id, id_pegawai){
    document.location.href="?mod=tugtam_kreat_input&id_skp=" + id + "&id_pegawai=" + id_pegawai;
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
                                <h1><a style="color:#AA9F00;" href="">INPUT TUGAS TAMBAHAN DAN KREATIVITAS</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>INPUT TUGAS TAMBAHAN DAN KRETIVITAS PILIH PERIODE</span></td>
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
		
				<div class="panelcontainer" style="width: 100%;">
					<h3 style="text-align: left;">DATA PERIODE PENILAIAN PEGAWAI <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nip"))); ?>)</h3>
					<div class="bodypanel">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
						<thead>
							<tr class="headertable">
								<th width='5px'>&nbsp;</th>
								<th width='40px'>No.</th>
								<th>Periode</th>
								<th width='450px'>Pejabat Penilai</th>
								<th width='450px'>Atasan Pejabat Penilai</th>
								<th width='20px'>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$res = mysql_query("SELECT
													a.*, b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
													c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai,
													AVG(d.status_supervisi) AS spv_kreat, AVG(e.status_supervisi) AS spv_tugtam
												FROM
													tbl_skp a
													LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
													LEFT JOIN tbl_pegawai c ON a.id_atasan_pegawai_penilai = c.id_pegawai
													LEFT JOIN tbl_skp_kreatifitas d ON a.id_skp = d.id_skp
													LEFT JOIN tbl_skp_tugas_tambahan e ON a.id_skp = e.id_skp
												WHERE
													a.id_pegawai = '" . $_SESSION["id_pegawai"] . "'
												GROUP BY
													a.id_skp
												ORDER BY
													a.dari ASC
												") or die(mysql_error());
							
							$no = 0;
							while($ds = mysql_fetch_array($res)){
								$status_supervisi = 0;
								if($ds["spv_kreat"] == 1 || $ds["spv_tugtam"] == 1)
									$status_supervisi = 1;
								else if($ds["spv_kreat"] == 2 || $ds["spv_tugtam"] == 2)
									$status_supervisi = 2;
								else if($ds["spv_kreat"] == 3 || $ds["spv_tugtam"] == 3)
									$status_supervisi = 3;
								$no++;
								echo("<tr>");
									echo("<td align='center'>" . status_supervisi($status_supervisi) . "</td>");
									echo("<td align='center'>" . $no . "</td>");
									//echo("<td align='center'>" . $ds["dari"] . "<br/>S/D<br/>" . $ds["dari"] . "</td>");
									echo("<td align='center'>" . tglindonesia($ds["dari"]) . " S/D " . tglindonesia($ds["sampai"]) . "</td>");
									echo("<td align='center'>" . $ds["nama_pegawai_penilai"] . " (NIP : " . $ds["nip_penilai"] . ")</td>");
									echo("<td align='center'>" . $ds["nama_pegawai_atasan_penilai"] . " (NIP : " . $ds["nip_atasan_penilai"] . ")</td>");
									echo("<td>
											<img src='image/Text-Signature-32.png' width='18px' class='linkimage' title='Lanjut Untuk Mengisikan Data Hasil Penilaian Perilaku' onclick='lanjut(" . $ds["id_skp"] . ", ".$ds["id_pegawai"].")' />
										 </td>");
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
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 

