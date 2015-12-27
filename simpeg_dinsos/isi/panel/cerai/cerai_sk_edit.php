<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    require_once("php/model/ijin_cerai_model.php");
    $obj = new IjinCerai_Model();
    $obj->Record($_GET["id_cerai"]);
    $data["id_cerai"] = $obj->id_cerai;
    $data["nama_pasangan"] = $obj->nama_pasangan;
    $data["pekerjaan_pasangan"] = $obj->pekerjaan_pasangan;
    $data["id_agama_pasangan"] = $obj->id_agama_pasangan;
    $data["alasan"] = $obj->alasan;
    $data["no_sp"] = $obj->no_sp;
    $data["tgl_sp"] = $obj->tgl_sp;
    $data["nip_pejabat_sp"] = $obj->nip_pejabat_sp;
    $data["nama_pejabat_sp"] = $obj->nama_pejabat_sp;
    $data["jabatan_pejabat_sp"] = $obj->jabatan_pejabat_sp;
    $data["id_pangkat_pejabat_sp"] = $obj->id_pangkat_pejabat_sp;    
    $data["nip_kesdip"] = $obj->nip_kesdip;
    $data["nama_kesdip"] = $obj->nama_kesdip;
    $data["id_pangkat_kesdip"] = $obj->id_pangkat_kesdip;
    $data["no_spgl"] = $obj->no_spgl;
    $data["no_smp"] = $obj->no_smp;
    $data["tgl_spgl"] = $obj->tgl_spgl;
    $data["tgl_smp"] = $obj->tgl_smp;
    $data["nip_pejabat_spgl"] = $obj->nip_pejabat_spgl;
    $data["nama_pejabat_spgl"] = $obj->nama_pejabat_spgl;
    $data["jabatan_pejabat_spgl"] = $obj->jabatan_pejabat_spgl;
    $data["id_pangkat_pejabat_spgl"] = $obj->id_pangkat_pejabat_spgl;
    $data["hari_h_spgl"] = $obj->hari_h_spgl;
    $data["tgl_h_spgl"] = $obj->tgl_h_spgl;
    $data["jam_h_spgl"] = $obj->jam_h_spgl;
    $data["tempat_h_spgl"] = $obj->tempat_h_spgl;
    $data["membaca_sk"] = $obj->membaca_sk;
    $data["menimbang_sk"] = $obj->menimbang_sk;
    $data["mengingat_sk"] = $obj->mengingat_sk;
    $data["memperhatikan_sk"] = $obj->memperhatikan_sk;
    $data["tembusan_sk"] = $obj->tembusan_sk;
    $data["no_sk"] = $obj->no_sk;
    $data["tgl_sk"] = $obj->tgl_sk;
    $data["nama_pejabat_sk"] = $obj->nama_pejabat_sk;
    $data["nip_pejabat_sk"] = $obj->nip_pejabat_sk;
    $data["jabatan_pejabat_sk"] = $obj->jabatan_pejabat_sk;
    $data["id_pangkat_pejabat_sk"] = $obj->id_pangkat_pejabat_sk;
    echo("var data = " . json_encode($data) . ";\n");
    
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
        ambil_tanggal("tgl_smp");
        ambil_tanggal("tgl_spgl");
        ambil_tanggal("tgl_h_spgl");
        ambil_tanggal("tgl_sk");
        preload();
    });
    
    function preload(){
        $("#id_cerai").val(data.id_cerai);
        $("#nama_pasangan").val(data.nama_pasangan);
        $("#pekerjaan_pasangan").val(data.pekerjaan_pasangan);
        $("#id_agama_pasangan").val(data.id_agama_pasangan);
        $("#alasan").val(data.alasan);
        $("#no_sp").val(data.no_sp);
        $("#tgl_sp").val(data.tgl_sp);
        $("#nip_pejabat_sp").val(data.nip_pejabat_sp);
        $("#nama_pejabat_sp").val(data.nama_pejabat_sp);
        $("#jabatan_pejabat_sp").val(data.jabatan_pejabat_sp);
        $("#id_pangkat_pejabat_sp").val(data.id_pangkat_pejabat_sp);
        $("#nip_kesdip").val(data.nip_kesdip);
        $("#nama_kesdip").val(data.nama_kesdip);
        $("#id_pangkat_kesdip").val(data.id_pangkat_kesdip);
        $("#no_spgl").val(data.no_spgl);
        $("#no_smp").val(data.no_smp);
        $("#tgl_spgl").val(data.tgl_spgl);
        $("#tgl_smp").val(data.tgl_smp);
        $("#nip_pejabat_spgl").val(data.nip_pejabat_spgl);
        $("#nama_pejabat_spgl").val(data.nama_pejabat_spgl);
        $("#jabatan_pejabat_spgl").val(data.jabatan_pejabat_spgl);
        $("#id_pangkat_pejabat_spgl").val(data.id_pangkat_pejabat_spgl);
        $("#hari_h_spgl").val(data.hari_h_spgl);
        $("#tgl_h_spgl").val(data.tgl_h_spgl);
        $("#jam_h_spgl").val(data.jam_h_spgl);
        $("#tempat_h_spgl").val(data.tempat_h_spgl);
        $("#membaca_sk").val(data.membaca_sk);
        $("#menimbang_sk").val(data.menimbang_sk);
        $("#mengingat_sk").val(data.mengingat_sk);
        $("#memperhatikan_sk").val(data.memperhatikan_sk);
        $("#tembusan_sk").val(data.tembusan_sk);
        $("#no_sk").val(data.no_sk);
        $("#tgl_sk").val(data.tgl_sk);
        $("#nama_pejabat_sk").val(data.nama_pejabat_sk);
        $("#nip_pejabat_sk").val(data.nip_pejabat_sk);
        $("#jabatan_pejabat_sk").val(data.jabatan_pejabat_sk);
        $("#id_pangkat_pejabat_sk").val(data.id_pangkat_pejabat_sk);
    }
    
    function simpan(){
        $("#frm").submit();
    }
    
    function kembali(){
        document.location.href="?mod=cerai_sk";
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
            document.location.href="?mod=cerai_sk";
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
                                <h1><a style="color:#AA9F00;" href="">EDIT DATA SK CERAI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>EDIT DATA SK CERAI</span></td>
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
				<form name="frm" id="frm" action="php/cerai/cerai_sk_edit.php" method="post" target="sbm_target">

					<div class="panelcontainer panelform" style="width: 100%;">
						<h3 style="text-align: left;">EDIT DATA USULAN CUTI</h3>
						<div class="bodypanel bodyfilter" id="bodyfilter">
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
										<input type="hidden" name="id_cerai" id="id_cerai" />
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
						</div>
					</div>

					<div class="kelang"></div>

					<div class="panelcontainer panelform" style="width: 100%;">
						<h3 style="text-align: left;">DATA PEJABAT KEPALA BIDANG KESEJAHTERAAN DAN DISIPLIN (UNTUK SURAT PANGGILAN DAN SURAT MELAKUKAN PEMERIKSAAN)</h3>
						<div class="bodypanel bodyfilter" id="bodyfilter">
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td width='33%'>
										<label>NIP :</label>
										<input type="text" name="nip_kesdip" id="nip_kesdip" class="form-control" />
									</td>
									<td width='33%'>
										<label>Nama Pejabat :</label>
										<input type="text" name="nama_kesdip" id="nama_kesdip" class="form-control" />
									</td>
									<td>
										<label>Pangkat Pejabat :</label>
										<select name="id_pangkat_kesdip" id="id_pangkat_kesdip" class="form-control">
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
						</div>
					</div>

					<div class="kelang"></div>

					<div class="panelcontainer panelform" style="width: 100%;">
						<h3 style="text-align: left;">DATA SURAT PANGGILAN DAN SURAT MELAKUKAN PEMERIKSAAN</h3>
						<div class="bodypanel bodyfilter" id="bodyfilter">
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td width='50%'>
										<label>No. Surat Panggilan :</label>
										<input type="text" name="no_spgl" id="no_spgl" class="form-control" />
									</td>
									<td>
										<label>No. Surat Melakukan Pemeriksaan :</label>
										<input type="text" name="no_smp" id="no_smp" class="form-control" />
									</td>
								</tr>
								<tr>
									<td width='50%'>
										<label>Tgl. Surat Panggilan :</label>
										<input type="text" name="tgl_spgl" id="tgl_spgl" class="form-control" />
									</td>
									<td>
										<label>Tgl. Surat Melakukan Pemeriksaan :</label>
										<input type="text" name="tgl_smp" id="tgl_smp" class="form-control" />
									</td>
								</tr>
							</table>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td width='50%'>
										<label>NIP Pejabat Penandatangan :</label>
										<input type="text" name="nip_pejabat_spgl" id="nip_pejabat_spgl" class="form-control" />
									</td>
									<td>
										<label>Nama Pejabat Penandatangan :</label>
										<input type="text" name="nama_pejabat_spgl" id="nama_pejabat_spgl" class="form-control" />
									</td>
								</tr>
							</table>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td width='50%'>
										<label>Jabatan Pejabat Penandatangan :</label>
										<input type="text" name="jabatan_pejabat_spgl" id="jabatan_pejabat_spgl" class="form-control" />
									</td>
									<td>
										<label>Pangkat Pejabat Penandatangan :</label>
										<select name="id_pangkat_pejabat_spgl" id="id_pangkat_pejabat_spgl" class="form-control">
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
						</div>
					</div>

					<div class="kelang"></div>

					<div class="panelcontainer panelform" style="width: 100%;">
						<h3 style="text-align: left;">JADWAL PELAKSANAAN PANGGILAN DAN PEMERIKSAAN</h3>
						<div class="bodypanel bodyfilter" id="bodyfilter">
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td width='33%'>
										<label>Hari :</label>
										<input type="text" name="hari_h_spgl" id="hari_h_spgl" class="form-control" />
									</td>
									<td width='33%'>
										<label>Tanggal :</label>
										<input type="text" name="tgl_h_spgl" id="tgl_h_spgl" class="form-control" />
									</td>
									<td>
										<label>Jam :</label>
										<input type="text" name="jam_h_spgl" id="jam_h_spgl" class="form-control" />
									</td>
								</tr>
							</table>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td>
										<label>Tempat :</label>
										<input type="text" name="tempat_h_spgl" id="tempat_h_spgl" class="form-control" />
									</td>
								</tr>
							</table>
						</div>
					</div>

					<div class="kelang"></div>

					<div class="panelcontainer panelform" style="width: 100%;">
						<h3 style="text-align: left;">DATA SK PERCERAIAN</h3>
						<div class="bodypanel bodyfilter" id="bodyfilter">
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td>
										<label>Membaca : (Pisahkan Item dengan 2 enter)</label>
										<textarea name="membaca_sk" id="membaca_sk" class="form-control" rows="10"></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<label>Menimbang : (Pisahkan Item dengan 2 enter)</label>
										<textarea name="menimbang_sk" id="menimbang_sk" class="form-control" rows="10"></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<label>Mengingat : (Pisahkan Item dengan 2 enter)</label>
										<textarea name="mengingat_sk" id="mengingat_sk" class="form-control" rows="10"></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<label>Memperhatikan : (Pisahkan Item dengan 2 enter)</label>
										<textarea name="memperhatikan_sk" id="memperhatikan_sk" class="form-control" rows="10"></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<label>Tembusan : (Pisahkan Item dengan 2 enter)</label>
										<textarea name="tembusan_sk" id="tembusan_sk" class="form-control" rows="7"></textarea>
									</td>
								</tr>
							</table>
							
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td>
										<label>No. SK :</label>
										<input type="text" name="no_sk" id="no_sk" class="form-control" />
									</td>
								</tr>
							</table>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td width='33%'>
										<label>Tgl. SK :</label>
										<input type="text" name="tgl_sk" id="tgl_sk" class="form-control" />
									</td>
									<td width='33%'>
										<label>NIP Pejabat Penandatangan SK :</label>
										<input type="text" name="nip_pejabat_sk" id="nip_pejabat_sk" class="form-control" />
									</td>
									<td>
										<label>Nama Pejabat Penandatangan SK :</label>
										<input type="text" name="nama_pejabat_sk" id="nama_pejabat_sk" class="form-control" />
									</td>
								</tr>
							</table>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td width='50%'>
										<label>Jabatan Pejabat Penandatangan SK :</label>
										<input type="text" name="jabatan_pejabat_sk" id="jabatan_pejabat_sk" class="form-control" />
									</td>
									<td>
										<label>Pangkat Pejabat Penandatangan SK :</label>
										<select name="id_pangkat_pejabat_sk" id="id_pangkat_pejabat_sk" class="form-control">
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
						</div>
					</div>

					<div class="kelang"></div>

					<div class="panelcontainer panelform" style="width: 100%;">
						<div class="bodypanel bodyfilter" id="bodyfilter">
							<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td align='left'>
										<button type="button" class="btn btn-lg btn-success" onclick="simpan();"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Edit</button>
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