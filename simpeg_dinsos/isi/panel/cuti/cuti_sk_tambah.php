<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $pangkat = array();
    $res_pangkat = mysql_query("SELECT * FROM ref_pangkat ORDER BY id_pangkat ASC");
    while($ds_pangkat = mysql_fetch_array($res_pangkat)){
        $row_pangkat["id_pangkat"] = $ds_pangkat["id_pangkat"];
        $row_pangkat["pangkat"] = $ds_pangkat["pangkat"];
        $row_pangkat["gol_ruang"] = $ds_pangkat["gol_ruang"];
        array_push($pangkat, $row_pangkat);
    }
    echo("var pangkat = " . json_encode($pangkat) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tgl_surat");
});
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">
function something_wrong(what_is_wrong){
    jAlert(what_is_wrong, "PERHATIAN");
}
function success(){
    jAlert("Data SK cuti telah disimpan.", "PERHATIAN", function(r){
        document.location.href="?mod=cuti_sk";
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
                                <h1><a style="color:#AA9F00;" href="">TAMBAH DATA SK CUTI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH DATA SK CUTI</span></td>
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
		
				<form name="frm" id="frm" action="php/cuti/cuti_sk_tambah.php" method="post" target="sbm_target">
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">TAMBAH DATA SK CUTI</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='33%'>
									<label>No. SK Cuti :</label>
									<input type="text" name="no_surat" id="no_surat" class="form-control" />
								</td>
								<td width='33%'>
									<label>Tanggal SK Cuti :</label>
									<input type="text" name="tgl_surat" id="tgl_surat" class="form-control" />
								</td>
								<td>
									<label>Pejabat Penandatangan SK :</label>
									<input type="text" name="pejabat_surat" id="pejabat_surat" class="form-control" />
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='33%'>
									<label>Nama Pejabat Penandatangan :</label>
									<input type="text" name="nama_surat" id="nama_surat" class="form-control" />
								</td>
								<td width='33%'>
									<label>NIP Pejabat Penandatangan :</label>
									<input type="text" name="nip_surat" id="nip_surat" class="form-control" />
								</td>
								<td>
									<label>Pangkat Pejabat Penandatangan :</label>
									<select name="pangkat_surat" id="pangkat_surat" class="form-control">
										<option value="0">----- Pilih Pangkat Pejabat -----</option>
										<script type="text/javascript">
											var pkt="";
											$.each(pangkat, function(i, item){
												pkt += "<option value='" + item.id_pangkat + "'>" + item.pangkat + " (" + item.gol_ruang + ")</option>";
											});
											document.write(pkt);
										</script>
									</select>
								</td>
							</tr>
						</table>
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<button type="submit" class="btn btn-success"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Simpan</button>
									<button type="reset" class="btn btn-info"><span class='glyphicon glyphicon-refresh'></span>&nbsp;&nbsp;Reset</button>
									<button type="button" class="btn btn-warning" onclick="document.location.href='?mod=cuti_sk';"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
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
 