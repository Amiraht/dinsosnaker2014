<script type="text/javascript">
function disimpan(sttspv){
    $("#stt").val(sttspv);
    if(sttspv == 2){
        var catatan = $("#catatan").val();
        if(catatan == "")
            jAlert("Maaf, berikan catatan penolakan jika ingin menolak data ini", "PERHATIAN");
        else{
            jConfirm("Anda yakin akan menolak data pengangkatan CPNS ini?", "PERHATIAN", function(r){
                if(r){
                    $("#frm").submit();
                }
            });
        }
    }else if(sttspv == 3){
        jConfirm("Anda yakin akan menerima data pengangkatan CPNS ini?", "PERHATIAN", function(r){
            if(r){
                $("#frm").submit();
            }
        });
    }
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
                                <h1><a style="color:#AA9F00;" href="">SUPERVISI PENGANGKATAN CPNS</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>SUPERVISI PENGANGKATAN CPNS</span></td>
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
			<form name="frm" id="frm" action="php/pengangkatan_cpns/spv_pengangkatan_cpns.php" method="post">
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">DATA PENGANGKATAN CPNS <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["id_pegawai"], "nip"))); ?>)</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
					<?php
						$ds = mysql_fetch_array(mysql_query("SELECT a.*, b.pangkat, b.gol_ruang
															FROM tbl_pengangkatan_cpns a
															LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
															 WHERE id_pegawai='" . $_SESSION["id_pegawai"] . "'"));
					?>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<label>No. Persetujuan BKN :</label>
									<div class="label_caption"><?php echo($ds["no_bakn"]); ?></div>
								</td>
								<td>
									<label>Tgl. Persetujuan BKN :</label>
									<div class="label_caption"><?php echo($ds["tgl_bakn"]); ?></div>
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<label>Pejabat Penetapan :</label>
									<div class="label_caption"><?php echo($ds["pejabat_penetapan"]); ?></div>
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<label>No. SK CPNS :</label>
									<div class="label_caption"><?php echo($ds["no_sk_cpns"]); ?></div>
								</td>
								<td width='80%'>
									<label>Tgl. SK CPNS :</label>
									<div class="label_caption"><?php echo($ds["tgl_sk_cpns"]); ?></div>
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<label>Pangkat :</label>
									<div class="label_caption"><?php echo($ds["pangkat"] . " (" . $ds["gol_ruang"] . ")"); ?></div>
									</select>
								</td>
								<td>
									<label>TMT CPNS :</label>
									<div class="label_caption"><?php echo($ds["tmt_cpns"]); ?></div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="kelang"></div>
				<div class="panelcontainer panelform" style="width: 100%;">
					<div class="bodypanel bodyfilter" id="bodyfilter">
					<?php
						if($ds["status_supervisi"] == 1 || $ds["status_supervisi"] == 2){
					?>
								<input type="hidden" name="stt" id="stt"/>
								<textarea name="catatan" id="catatan" placeholder=":: Jika Ditolak, Berikan catatan penolakan disini ::"></textarea>
								<div class="kelang"></div>
								<button type="button" class="btn btn-success" onclick="disimpan(3);">Terima</button>
								<button type="button" class="btn btn-default" onclick="disimpan(2);">TolaK</button>
					<?php
						}else{
							echo("
										<div class='alert alert-info' role='alert'>
											Data pengangkatan CPNS telah disupervisi
										</div>
								");
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
 


