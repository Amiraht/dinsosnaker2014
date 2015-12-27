<script type="text/javascript">
function disposisi(id, stt){
    var confstr = "Anda yakin hasil proses surat masuk ini telah benar?";
    if(stt == 4)
        confstr = "Anda yakin akan memproses ulang hasil proses surat masuk ini?";
    confirm(confstr, "PERHATIAN", function(r){
        if(r){
            var catatan = $("#catatan_" + id).val();
            //alert("KE : " + tujuan_disposisi + "\nCatatan : " + catatan);
            document.location.href = "php/hasil_surat_masuk_kaban.php?id=" + id + "&catatan=" + catatan + "&status=" + stt;
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
					<fieldset>
				<legend><h3>DAFTAR SURAT MASUK YANG TELAH DIPROSES OLEH BIDANG</h3></legend>
				<?php
					$res = mysql_query("SELECT 
											a.*, b.unit_kerja
										FROM 
											myapp_maintable_suratmasuk a
											LEFT JOIN myapp_reftable_unitkerja b ON a.id_skpd_pengirim = b.id_unit_kerja
										WHERE
											status = 3 AND tujuan_disposisi = $_SESSION[id_level]
										ORDER BY 
											id ASC");
					$ctr = 0;
					while($ds = mysql_fetch_array($res)){
						$ctr++;
						echo("<div class='listingcontent'>");
						?>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td rowspan="7" width='40px' align='center' style="background-color: #334444; color: white;"><?php echo($ctr); ?></td>
								<td width='10%'>Nomor Surat</td>
								<td width='10px'>:</td>
								<td><span class="detail"><?php echo($ds["no_surat"]); ?></span></td>
							</tr>
							<tr>
								<td width='10%'>Tanggal Surat</td>
								<td width='10px'>:</td>
								<td><span class="detail"><?php echo($ds["tgl_surat"]); ?></span></td>
							</tr>
							<tr>
								<td width='10%'>Tanggal Terima</td>
								<td width='10px'>:</td>
								<td><span class="detail"><?php echo($ds["tgl_terima"]); ?></span></td>
							</tr>
							<tr>
								<td width='10%'>Perihal</td>
								<td width='10px'>:</td>
								<td><span class="detail"><?php echo($ds["perihal_surat"]); ?></span></td>
							</tr>
							<tr>
								<td colspan="3">
									<input type="button" class="tombolkecil" value="Lihat Catatan Disposisi" onclick="lihat_cadis_sm(<?php echo($ds["id"]) ?>);" />
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<textarea id="catatan_<?php echo($ds["id"]); ?>" placeholder="Berikan Catatan Pada Disposisi"></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<input type="button" value="Hasil Proses Surat Masuk Diterima" onclick="disposisi(<?php echo($ds["id"]) ?>, 3);" />
									<input type="button" value="Tolak Dan Perbaiki Hasil Proses Ke Bidang" onclick="disposisi(<?php echo($ds["id"]) ?>, 4);" />
								</td>
							</tr>
						</table>
						<?php
						echo("</div>");
					}
				?>
				</table>
			 </fieldset>
	</div>
</td>
</tr>

<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 


