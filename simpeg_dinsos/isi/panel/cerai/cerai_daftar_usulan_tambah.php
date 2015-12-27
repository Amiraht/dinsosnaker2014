<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $agama = array();
    $sql_agama = "SELECT * FROM ref_agama";
    $res_agama = mysql_query($sql_agama);
    while($ds_agama = mysql_fetch_array($res_agama)){
        $row_agama["id_agama"] = $ds_agama["id_agama"];
        $row_agama["agama"] = $ds_agama["agama"];
        array_push($agama, $row_agama);
    }
    echo("var agama = " . json_encode($agama) . ";\n");

    $pangkat = array();
    $sql_pangkat = "SELECT * FROM ref_pangkat";
    $res_pangkat = mysql_query($sql_pangkat);
    while($ds_pangkat = mysql_fetch_array($res_pangkat)){
        $row_pangkat["id_pangkat"] = $ds_pangkat["id_pangkat"];
        $row_pangkat["gol_ruang"] = $ds_pangkat["gol_ruang"];
        $row_pangkat["pangkat"] = $ds_pangkat["pangkat"];
        array_push($pangkat, $row_pangkat);
    }
    echo("var pangkat = " . json_encode($pangkat) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tgl_sp");
    });
    
    function simpan(){
        $("#frm").submit();
    }
    
    function kembali(){
        document.location.href="?mod=cerai_daftar_usulan";
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Data usulan perceraian telah disimpan", "PERHATIAN", function(r){
            document.location.href="?mod=cerai_daftar_usulan";
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
                                <h1><a style="color:#AA9F00;" href="">TAMBAH DAFTAR USULAN CERAI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH DAFTAR USULAN CERAI</span></td>
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
			<form name="frm" id="frm" action="php/cerai/cerai_daftar_usulan_tambah.php" method="post" target="sbm_target">
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">TAMBAH PEGAWAI UNTUK DIUSULKAN</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search NIP" id="nip" name="nip" />
										<span class="input-group-btn">
											<button type="button" class="btn bnt-sm btn-success" onclick="show_auto_search_pegawai('nip');"><span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;Search</button>
										</span>
									</div>
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='33%'>
									<label>Nama Pasangan :</label>
									<input type="text" name="nama_pasangan" id="nama_pasangan" class="form-control" />
								</td>
								<td width='33%'>
									<label>Pekerjaan Pasangan :</label>
									<input type="text" name="pekerjaan_pasangan" id="pekerjaan_pasangan" class="form-control" />
								</td>
								<td>
									<label>Agama Pasangan :</label>
									<select name="id_agama_pasangan" id="id_agama_pasangan" class="form-control">
										<option value="0">----- Pilih Agama -----</option>
									<script type="text/javascript">
										$.each(agama, function(i, item){
											document.write("<option value='" + item.id_agama + "'>" + item.agama + "</option>");
										});
									</script>
									</select>
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<label>Alasan Bercerai :</label>
									<textarea name="alasan" id="alasan" class="form-control"></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<label>No. Surat Usulan :</label>
									<input type="text" name="no_sp" id="no_sp" class="form-control" />
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='33%'>
									<label>Tgl. Surat Usulan :</label>
									<input type="text" name="tgl_sp" id="tgl_sp" class="form-control" />
								</td>
								<td width='33%'>
									<label>NIP Pejabat Penandatangan Surat Usulan :</label>
									<input type="text" name="nip_pejabat_sp" id="nip_pejabat_sp" class="form-control" />
								</td>
								<td>
									<label>Nama Pejabat Penandatangan Surat Usulan :</label>
									<input type="text" name="nama_pejabat_sp" id="nama_pejabat_sp" class="form-control" />
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='50%'>
									<label>Jabatan Pejabat Penandatangan Surat Usulan :</label>
									<input type="text" name="jabatan_pejabat_sp" id="jabatan_pejabat_sp" class="form-control" />
								</td>
								<td>
									<label>Pangkat Pejabat Penandatangan Surat Usulan :</label>
									<select name="id_pangkat_pejabat_sp" id="id_pangkat_pejabat_sp" class="form-control">
										<option value="0">----- Pilih Pangkat -----</option>
										<script type="text/javascript">
										$.each(pangkat, function(i, item){
											document.write("<option value='" + item.id_pangkat + "'>" + item.pangkat + " (" + item.gol_ruang + ")</option>");
										});
										</script>
									</select>
								</td>
							</tr>
						</table>
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td align='left'>
									<button type="button" class="btn btn-lg btn-success" onclick="simpan();"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Tambah</button>
									<button type="button" class="btn btn-lg btn-warning" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
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
 <div class="kelang"></div>
<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>