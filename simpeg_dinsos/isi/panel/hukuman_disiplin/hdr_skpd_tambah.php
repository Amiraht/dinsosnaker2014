<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $sub_jenis_disiplin = array();
    $sql_sub_jenis_disiplin = "SELECT * FROM ref_sub_jenis_disiplin WHERE id_jenis_disiplin=1";
    $res_sub_jenis_disiplin = mysql_query($sql_sub_jenis_disiplin);
    while($ds_sub_jenis_disiplin = mysql_fetch_array($res_sub_jenis_disiplin)){
        $row_sjd["id_sub_jenis_disiplin"] = $ds_sub_jenis_disiplin["id_sub_jenis_disiplin"];
        $row_sjd["id_jenis_disiplin"] = $ds_sub_jenis_disiplin["id_jenis_disiplin"];
        $row_sjd["sub_jenis_disiplin"] = $ds_sub_jenis_disiplin["sub_jenis_disiplin"];
        array_push($sub_jenis_disiplin, $row_sjd);
    }
    echo("var sub_jenis_disiplin = " . json_encode($sub_jenis_disiplin) . ";\n");
    
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
    ambil_tanggal("tgl_sk");
    ambil_tanggal("tmt");
});

function kembali(){
    document.location.href="?mod=hdr_skpd_daftar";
}

function simpan(){
    /* menggabungkan semua text yang bersangkutan */
    
    // 1. membaca
    var membaca = "";
    var i_membaca = 0;
    $(".sprmembaca").each(function(){        
        if(i_membaca == 0){
            membaca += $(this).val();
        }else{
            membaca += "{}" + $(this).val();
        }
        i_membaca++;
    });
    $("#membaca").val(membaca);
    
    // 2. menimbang
    var menimbang = "";
    var i_menimbang = 0;
    $(".sprmenimbang").each(function(){        
        if(i_menimbang == 0){
            menimbang += $(this).val();
        }else{
            menimbang += "{}" + $(this).val();
        }
        i_menimbang++;
    });
    $("#menimbang").val(menimbang);
    
    // 3. mengingat
    var mengingat = "";
    var i_mengingat = 0;
    $(".sprmengingat").each(function(){        
        if(i_mengingat == 0){
            mengingat += $(this).val();
        }else{
            mengingat += "{}" + $(this).val();
        }
        i_mengingat++;
    });
    $("#mengingat").val(mengingat);
    
    // 4. menetapkan
    var menetapkan = "";
    var i_menetapkan = 0;
    $(".sprmenetapkan").each(function(){        
        if(i_menetapkan == 0){
            menetapkan += $(this).val();
        }else{
            menetapkan += "{}" + $(this).val();
        }
        i_menetapkan++;
    });
    $("#menetapkan").val(menetapkan);
    
    // 5. tembusan
    var tembusan = "";
    var i_tembusan = 0;
    $(".sprtembusan").each(function(){        
        if(i_tembusan == 0){
            tembusan += $(this).val();
        }else{
            tembusan += "{}" + $(this).val();
        }
        i_tembusan++;
    });
    $("#tembusan").val(tembusan);
    /* ------------------------------------------ */
    
    /* Submit formnya */
    $("#frm").submit();
}

/********************************** Generate tulisan pada SK *******************************/

function tambah_membaca(){
    var text = "<div class='input-group' style='margin-bottom: 5px;'>" +
                    "<input type='text' class='form-control sprmembaca' />" +
                    "<span class='input-group-btn'>" + 
                        "<button type='button' class='btn bnt-sm btn-success' onclick='hapus_membaca(this);'><span class='glyphicon glyphicon-trash'></span></button>" +
                    "</span>" +
                "</div>";
    $(".pnlMembaca").append(text);
}
function hapus_membaca(saya){
    $(saya).parent().parent().remove();
}

function tambah_menimbang(){
    var text = "<div class='input-group' style='margin-bottom: 5px;'>" +
                    "<input type='text' class='form-control sprmenimbang' />" +
                    "<span class='input-group-btn'>" + 
                        "<button type='button' class='btn bnt-sm btn-success' onclick='hapus_menimbang(this);'><span class='glyphicon glyphicon-trash'></span></button>" +
                    "</span>" +
                "</div>";
    $(".pnlMenimbang").append(text);
}
function hapus_menimbang(saya){
    $(saya).parent().parent().remove();
}

function tambah_mengingat(){
    var text = "<div class='input-group' style='margin-bottom: 5px;'>" +
                    "<input type='text' class='form-control sprmengingat' />" +
                    "<span class='input-group-btn'>" + 
                        "<button type='button' class='btn bnt-sm btn-success' onclick='hapus_mengingat(this);'><span class='glyphicon glyphicon-trash'></span></button>" +
                    "</span>" +
                "</div>";
    $(".pnlMengingat").append(text);
}
function hapus_mengingat(saya){
    $(saya).parent().parent().remove();
}

function tambah_menetapkan(){
    var text = "<div class='input-group' style='margin-bottom: 5px;'>" +
                    "<input type='text' class='form-control sprmenetapkan' />" +
                    "<span class='input-group-btn'>" + 
                        "<button type='button' class='btn bnt-sm btn-success' onclick='hapus_menetapkan(this);'><span class='glyphicon glyphicon-trash'></span></button>" +
                    "</span>" +
                "</div>";
    $(".pnlMenetapkan").append(text);
}
function hapus_menetapkan(saya){
    $(saya).parent().parent().remove();
}

function tambah_tembusan(){
    var text = "<div class='input-group' style='margin-bottom: 5px;'>" +
                    "<input type='text' class='form-control sprtembusan' />" +
                    "<span class='input-group-btn'>" + 
                        "<button type='button' class='btn bnt-sm btn-success' onclick='hapus_tembusan(this);'><span class='glyphicon glyphicon-trash'></span></button>" +
                    "</span>" +
                "</div>";
    $(".pnlTembusan").append(text);
}
function hapus_tembusan(saya){
    $(saya).parent().parent().remove();
}

/********************************* Akhir Generate tulisan pada SK ********************************/
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">
function something_wrong(what_is_wrong){
    jAlert(what_is_wrong, "PERHATIAN");
}
function success(){
    jAlert("Data pegawai yang dikenai hukuman ringan telah disimpan", "PERHATIAN", function(r){
        document.location.href="?mod=hdr_skpd_daftar";
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
                                <h1><a style="color:#AA9F00;" href="">HUKUMAN DISIPLIN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>HUKUMAN DISIPLIN</span></td>
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
		
			<form name="frm" id="frm" action="php/hukuman_disiplin/hdr_skpd_tambah.php" method="post" target="sbm_target">
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">TAMBAH PEGAWAI YANG AKAN DIKENAI HUKUMAN DISIPLIN RINGAN</h3>
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
								<td width='30%'>
									<select name="id_sub_jenis_disiplin" id="id_sub_jenis_disiplin" class="form-control">
										<option value="0">------------- Pilih Sub Jenis Disiplin  -------------</option>
										<?php
											$dis = "SELECT * FROM ref_sub_jenis_disiplin WHERE id_jenis_disiplin = '1'";
											$qr = mysql_query($dis);
											if($rw = mysql_fetch_array($qr)){
												echo "<option value='".$rw['id_sub_jenis_disiplin']."'>".$rw['sub_jenis_disiplin']."</option>";
											}
										?>
									</select>
								</td>
								<td width='20%'>
									<input type="text" name="tmt" id="tmt" class="form-control" placeholder="TMT Hukuman Disiplin" />
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<label>Keterangan</label>
									<input type="text" name="keterangan" id="keterangan" class="form-control" />
								</td>
							</tr>
						</table>
					</div>
				</div>

				<div class="kelang"></div>

				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">DATA SK HUKUMAN</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='70%'>
									<label>NO. SK</label>
									<input type="text" class="form-control" name="no_sk" id="no_sk" />
								</td>
								<td>
									<label>Tanggal SK</label>
									<input type="text" class="form-control" name="tgl_sk" id="tgl_sk" />
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='70%'>
									<label>Jabatan Pejabat Penandatangan SK / Yang Berwenang Menghukum</label>
									<input type="text" class="form-control" name="jabatan_pejabat_sk" id="jabatan_pejabat_sk" />
								</td>
								<td>
									<label>Pangkat Pejabat Penandatangan :</label>
									<select name="pangkat_pejabat_sk" id="pangkat_pejabat_sk" class="form-control">
										<option value="0">----- Pilih Pangkat Pejabat -----</option>
										<?php
											$ps = "SELECT * FROM ref_pangkat ORDER BY id_pangkat ASC";
											$pq = mysql_query($ps) or die(mysql_error());
											while($pk = mysql_fetch_array($pq)){
												echo "<option value='".$pk['id_pangkat']."'>".$pk['pangkat']." ( ".$pk['gol_ruang']." )</option>";
											}
										?>
									</select>
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='50%'>
									<label>Nama Pejabat Penandatangan SK</label>
									<input type="text" class="form-control" name="nama_pejabat_sk" id="nama_pejabat_sk" />
								</td>
								<td>
									<label>NIP Pejabat Penandatangan SK</label>
									<input type="text" class="form-control" name="nip_pejabat_sk" id="nip_pejabat_sk" />
								</td>
							</tr>
						</table>
					</div>
				</div>

				<div class="kelang"></div>

				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">MEMBACA</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<div class="pnlMembaca"><!-- textbox2 yang mau dibentuk menjadi paragraf membaca berada disini --></div>
						<div class="kelang"></div>
						<button type="button" class="btn btn-sm btn-info" onclick="tambah_membaca();">Tambah Tulisan</button>
						<input type="hidden" name="membaca" id="membaca" />
					</div>
				</div>

				<div class="kelang"></div>

				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">MENIMBANG</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<div class="pnlMenimbang"><!-- textbox2 yang mau dibentuk menjadi paragraf menimbang berada disini --></div>
						<div class="kelang"></div>
						<button type="button" class="btn btn-sm btn-info" onclick="tambah_menimbang();">Tambah Tulisan</button>
						<input type="hidden" name="menimbang" id="menimbang" />
					</div>
				</div>

				<div class="kelang"></div>

				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">MENGINGAT</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<div class="pnlMengingat"><!-- textbox2 yang mau dibentuk menjadi paragraf menimbang berada disini --></div>
						<div class="kelang"></div>
						<button type="button" class="btn btn-sm btn-info" onclick="tambah_mengingat();">Tambah Tulisan</button>
						<input type="hidden" name="mengingat" id="mengingat" />
					</div>
				</div>

				<div class="kelang"></div>

				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">MENETAPKAN</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<div class="pnlMenetapkan"><!-- textbox2 yang mau dibentuk menjadi paragraf menetapkan berada disini --></div>
						<div class="kelang"></div>
						<button type="button" class="btn btn-sm btn-info" onclick="tambah_menetapkan();">Tambah Tulisan</button>
						<input type="hidden" name="menetapkan" id="menetapkan" />
					</div>
				</div>

				<div class="kelang"></div>

				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">TEMBUSAN</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<div class="pnlTembusan"><!-- textbox2 yang mau dibentuk menjadi paragraf menimbang berada disini --></div>
						<div class="kelang"></div>
						<button type="button" class="btn btn-sm btn-info" onclick="tambah_tembusan();">Tambah Tulisan</button>
						<input type="hidden" name="tembusan" id="tembusan" />
					</div>
				</div>

				<div class="kelang"></div>

				<div class="panelcontainer panelform" style="width: 100%;">
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<button type="button" class="btn btn-lg btn-success" onclick="simpan();"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Simpan Data</button>
						<button type="button" class="btn btn-lg btn-warning" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
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
 