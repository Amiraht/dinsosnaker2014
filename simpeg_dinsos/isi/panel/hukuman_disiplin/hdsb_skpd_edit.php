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
    
    include("php/model/usulan_hukuman_disiplin_model.php");
    $obj = new UsulanHukumanDisiplin();
    $obj->Record($_GET["id_usulan"]);
    $record["id_usulan"] = $obj->id_usulan;
    $record["id_sub_jenis_disiplin"] = $obj->id_sub_jenis_disiplin;
    $record["keterangan"] = $obj->keterangan;
    $record["no_sk"] = $obj->no_sk;
    $record["tgl_sk"] = $obj->tgl_sk;
    $record["jabatan_pejabat_sk"] = $obj->jabatan_pejabat_sk;
    $record["pangkat_pejabat_sk"] = $obj->pangkat_pejabat_sk;
    $record["nama_pejabat_sk"] = $obj->nama_pejabat_sk;
    $record["nip_pejabat_sk"] = $obj->nip_pejabat_sk;
    $record["membaca"] = $obj->membaca;
    $record["menimbang"] = $obj->menimbang;
    $record["mengingat"] = $obj->mengingat;
    $record["menetapkan"] = $obj->menetapkan;
    $record["tembusan"] = $obj->tembusan;
    echo("var record = " . json_encode($record) . ";\n");
?>
function preload(){
    $("#id_usulan").val(record.id_usulan);
    $("#id_sub_jenis_disiplin").val(record.id_sub_jenis_disiplin);
    $("#keterangan").val(record.keterangan);
    $("#no_sk").val(record.no_sk);
    $("#tgl_sk").val(record.tgl_sk);
    $("#jabatan_pejabat_sk").val(record.jabatan_pejabat_sk);
    $("#pangkat_pejabat_sk").val(record.pangkat_pejabat_sk);
    $("#nama_pejabat_sk").val(record.nama_pejabat_sk);
    $("#nip_pejabat_sk").val(record.nip_pejabat_sk);
    
    // split membaca
    $.each(record.membaca.split("{}"), function(i, item){
        //alert(item);
        tambah_membaca(item);
    });
    
    // split menimbang
    $.each(record.menimbang.split("{}"), function(i, item){
        //alert(item);
        tambah_menimbang(item);
    });
    
    // split mengingat
    $.each(record.mengingat.split("{}"), function(i, item){
        //alert(item);
        tambah_mengingat(item);
    });
    
    // split menetapkan
    $.each(record.menetapkan.split("{}"), function(i, item){
        //alert(item);
        tambah_menetapkan(item);
    });
    
    // split tembusan
    $.each(record.tembusan.split("{}"), function(i, item){
        //alert(item);
        tambah_tembusan(item);
    });
}
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tgl_sk");
    preload();
});

function kembali(){
    document.location.href="?mod=hdsb_skpd_daftar";
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

function tambah_membaca(isi){
    if(typeof isi == "undefined")
        isi = "";
    var text = "<div class='input-group' style='margin-bottom: 5px;'>" +
                    "<input type='text' class='form-control sprmembaca' value='" + isi + "' />" +
                    "<span class='input-group-btn'>" + 
                        "<button type='button' class='btn bnt-sm btn-success' onclick='hapus_membaca(this);'><span class='glyphicon glyphicon-trash'></span></button>" +
                    "</span>" +
                "</div>";
    $(".pnlMembaca").append(text);
}
function hapus_membaca(saya){
    $(saya).parent().parent().remove();
}

function tambah_menimbang(isi){
    if(typeof isi == "undefined")
        isi = "";
    var text = "<div class='input-group' style='margin-bottom: 5px;'>" +
                    "<input type='text' class='form-control sprmenimbang' value='" + isi + "' />" +
                    "<span class='input-group-btn'>" + 
                        "<button type='button' class='btn bnt-sm btn-success' onclick='hapus_menimbang(this);'><span class='glyphicon glyphicon-trash'></span></button>" +
                    "</span>" +
                "</div>";
    $(".pnlMenimbang").append(text);
}
function hapus_menimbang(saya){
    $(saya).parent().parent().remove();
}

function tambah_mengingat(isi){
    if(typeof isi == "undefined")
        isi = "";
    var text = "<div class='input-group' style='margin-bottom: 5px;'>" +
                    "<input type='text' class='form-control sprmengingat' value='" + isi + "' />" +
                    "<span class='input-group-btn'>" + 
                        "<button type='button' class='btn bnt-sm btn-success' onclick='hapus_mengingat(this);'><span class='glyphicon glyphicon-trash'></span></button>" +
                    "</span>" +
                "</div>";
    $(".pnlMengingat").append(text);
}
function hapus_mengingat(saya){
    $(saya).parent().parent().remove();
}

function tambah_menetapkan(isi){
    if(typeof isi == "undefined")
        isi = "";
    var text = "<div class='input-group' style='margin-bottom: 5px;'>" +
                    "<input type='text' class='form-control sprmenetapkan' value='" + isi + "' />" +
                    "<span class='input-group-btn'>" + 
                        "<button type='button' class='btn bnt-sm btn-success' onclick='hapus_menetapkan(this);'><span class='glyphicon glyphicon-trash'></span></button>" +
                    "</span>" +
                "</div>";
    $(".pnlMenetapkan").append(text);
}
function hapus_menetapkan(saya){
    $(saya).parent().parent().remove();
}

function tambah_tembusan(isi){
    if(typeof isi == "undefined")
        isi = "";
    var text = "<div class='input-group' style='margin-bottom: 5px;'>" +
                    "<input type='text' class='form-control sprtembusan' value='" + isi + "' />" +
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
        document.location.href="?mod=hdsb_skpd_daftar";
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
		
		<form name="frm" id="frm" action="php/hukuman_disiplin/hdsb_skpd_edit.php" method="post" target="sbm_target">
			<input type="hidden" name="id_usulan" id="id_usulan" />
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">EDIT DATA PEGAWAI YANG AKAN DIKENAI HUKUMAN DISIPLIN SEDANG ATAU BERAT</h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
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
 
