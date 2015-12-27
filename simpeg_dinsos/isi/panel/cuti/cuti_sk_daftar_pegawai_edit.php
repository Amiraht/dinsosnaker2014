<!-- CONTROLLER -->
<script type="text/javascript">
<?php    
    $jenis_cuti = array();
    $res_jenis_cuti = mysql_query("SELECT * FROM ref_jenis_cuti ORDER BY id_jenis_cuti ASC");
    while($ds_jenis_cuti = mysql_fetch_array($res_jenis_cuti)){
        $row_jenis_cuti["id_jenis_cuti"] = $ds_jenis_cuti["id_jenis_cuti"];
        $row_jenis_cuti["jenis_cuti"] = $ds_jenis_cuti["jenis_cuti"];
        array_push($jenis_cuti, $row_jenis_cuti);
    }
    echo("var jenis_cuti = " . json_encode($jenis_cuti) . ";\n");
    
    $ds_riwayat_cuti = mysql_fetch_array(mysql_query("SELECT * FROM tbl_riwayat_cuti WHERE id_riwayat_cuti='" . $_GET["id_riwayat_cuti"] . "'"));
    $pre["id_surat"] = $ds_riwayat_cuti["id_surat"];
    $pre["id_jenis_cuti"] = $ds_riwayat_cuti["id_jenis_cuti"];
    $pre["lama"] = $ds_riwayat_cuti["lama"];
    $pre["dari"] = $ds_riwayat_cuti["dari"];
    $pre["sampai"] = $ds_riwayat_cuti["sampai"];
    $pre["keterangan"] = $ds_riwayat_cuti["keterangan"];
    echo("var pre = " . json_encode($pre) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("dari");
    ambil_tanggal("tgl_usulan");
    preload();
});
function preload(){
    $("#id_jenis_cuti").val(pre.id_jenis_cuti);
    $("#lama").val(pre.lama);
    $("#dari").val(pre.dari);
    $("#sampai").val(pre.sampai);
    $("#keterangan").val(pre.keterangan);
}
function kembali(){
    document.location.href="?mod=cuti_sk_daftar_pegawai&id_surat=" + pre.id_surat;
}
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">
function something_wrong(what_is_wrong){
    jAlert(what_is_wrong, "PERHATIAN");
}
function success(){
    jAlert("Data usulan cuti telah disimpan", "PERHATIAN", function(r){
        document.location.href="?mod=cuti_sk_daftar_pegawai&id_surat=" + pre.id_surat;
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
                                <h1><a style="color:#AA9F00;" href="">EDIT DATA RIWAYAT CUTI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>EDIT DATA RIWAYAT CUTI</span></td>
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
				<form name="frm" id="frm" action="php/cuti/cuti_sk_daftar_pegawai_edit.php" method="post" target="sbm_target">
					<input type="hidden" name="id_riwayat_cuti" id="id_riwayat_cuti" value="<?php echo($_GET["id_riwayat_cuti"]); ?>" />
					<div class="panelcontainer panelform" style="width: 100%;">
						<h3 style="text-align: left;">EDIT DATA CUTI</h3>
						<div class="bodypanel bodyfilter" id="bodyfilter">        
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td width='25%'>
										<label>Jenis Cuti :</label>
										<select name="id_jenis_cuti" id="id_jenis_cuti" class="form-control">
											<option value="0">:::: Pilih Jenis Cuti ::::</option>
											<script type="text/javascript">
												var text = "";
												$.each(jenis_cuti, function(i, item){
													text += "<option value='" + item.id_jenis_cuti + "'>" + item.jenis_cuti + "</option>";
												});
												document.write(text);
											</script>
										</select>
									</td>
									<td width='25%'>
										<label>Lama Cuti (dalam hari) :</label>
										<input type="text" name="lama" id="lama" class="form-control" />
									</td>
									<td width='25%'>
										<label>Tanggal Mulai Cuti :</label>
										<input type="text" name="dari" id="dari" class="form-control" />
									</td>
									<td width='25%'>
										<label>Sampai :</label>
										<input type="text" name="sampai" id="sampai" class="form-control" />
									</td>
								</tr>
							</table>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td>
										<label>Keterangan :</label>
										<input type="text" name="keterangan" id="keterangan" class="form-control" />
									</td>
								</tr>
							</table>
							<div class="kelang"></div>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td align='left'>
										<button type="submit" class="btn btn-success"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Simpan</button>
										<button type="button" class="btn btn-info" onclick="preload();"><span class='glyphicon glyphicon-refresh'></span>&nbsp;&nbsp;Reset</button>
										<button type="button" class="btn btn-warning" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
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
 


