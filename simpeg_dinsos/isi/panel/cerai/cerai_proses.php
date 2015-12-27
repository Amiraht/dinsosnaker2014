<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $agama = array();
    $res_agama = mysql_query("SELECT * FROM ref_agama");
    while($ds_agama = mysql_fetch_array($res_agama)){
        $row_agama["id_agama"] = $ds_agama["id_agama"];
        $row_agama["agama"] = $ds_agama["agama"];
        array_push($agama, $row_agama);
    }
    echo("var agama = " . json_encode($agama) . ";");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tgl_sk");
    ambil_tanggal("tgl_tidak_serumah_lagi");
    ambil_tanggal("tgl_tidak_rujuk_lagi");
});
function form_submit(){
    $("#frm").submit();
}
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">
function something_wrong(what_is_wrong){
    jAlert(what_is_wrong, "PERHATIAN");
}
function success(){
    jAlert("Data ijin perceraian telah disimpan.", "PERHATIAN", function(r){
        document.location.href="?mod=cerai_proses_daftar_pegawai&no_usulan=<?php echo($_GET["no_usulan"]); ?>";
    });
}
</script>
<!-- END OF JAVASCRIPT FROM CHILD -->


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">PROSES USULAN CERAI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>PROSES USULAN CERAI</span></td>
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
		
		<form name="frm" id="frm" action="php/cerai/cerai_proses.php" method="post" target="sbm_target" enctype="multipart/form-data">
			<input type="hidden" name="id_usulan" value="<?php echo($_GET["id_usulan"]); ?>" />
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">PROSES DATA PERCERAIAN</h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='33%'>
								<label>Nama Pasangan :</label>
								<input type="text" name="nama_pasangan" class="form-control" />
							</td>
							<td width='33%'>
								<label>Pekerjaan Pasangan :</label>
								<input type="text" name="pekerjaan_pasangan" class="form-control" />
							</td>
							<td>
								<label>Agama Pasangan</label>
								<select name="id_agama_pasangan" class="form-control">
									<option value="0">:::: Pilih Agama Pasangan ::::</option>
									<script type="text/javascript">
										var text = "";
										$.each(agama, function(i, item){
											text += "<option value='" + item.id_agama + "'>" + item.agama + "</option>";
										});
										document.write(text);
									</script>
								</select>
							</td>
						</tr>
					</table>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='33%'>
								<label>Nomor SK Perceraian :</label>
								<input type="text" name="no_sk" class="form-control" />
							</td>
							<td width='33%'>
								<label>Tanggal SK Perceraian :</label>
								<input type="text" name="tgl_sk" id="tgl_sk" class="form-control" />
							</td>
							<td>
								<label>Pejabat Penandatangan SK Perceraian :</label>
								<input type="text" name="pejabat_sk" class="form-control" />
							</td>
						</tr>
					</table>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='20%'>
								<label>Surat Tidak Akan Rujuk Lagi Tgl.</label>
								<input type="text" name="tgl_tidak_rujuk_lagi" id="tgl_tidak_rujuk_lagi" class="form-control"/>
							</td>
							<td width='20%'>
								<label>SK Tidak Serumah Lagi Tgl.</label>
								<input type="text" name="tgl_tidak_serumah_lagi" id="tgl_tidak_serumah_lagi" class="form-control"/>
							</td>
							<td>
								<label>Upload Scan SK Perceraian</label>
								<input type="file" name="scan_sk" />
							</td>
						</tr>
					</table>
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<button type="button" class="btn btn-success btn-lg" onclick="form_submit();">Simpan</button>
								<button type="reset" class="btn btn-info btn-lg">Reset</button>
								<button type="button" class="btn btn-warning btn-lg" onclick="document.location.href='?mod=cerai_proses_daftar_pegawai&no_usulan=<?php echo($_GET["no_usulan"]); ?>';">Kembali</button>
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
 
<!-- IFRAME. THE FORM WILL BE SUBMI IN THIS WAY -->
<iframe name="sbm_target" style="display: none;"></iframe>
<!-- END OF IFRAME -->