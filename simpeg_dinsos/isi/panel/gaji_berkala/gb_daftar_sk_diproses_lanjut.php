<?php
	$id_detail_gaji_berkala = mysql_real_escape_string(trim(strip_tags($_GET['id_detail_gaji_berkala'])));
?>
<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    
    // DATA : ref_pangkat
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
    
    // DATA : ref_peraturan_gaji
    $peraturan_gaji = array();
    $sql_peraturan_gaji = "SELECT * FROM ref_peraturan_gaji ORDER BY tgl_berlaku DESC";
    $res_peraturan_gaji = mysql_query($sql_peraturan_gaji);
    while($ds_peraturan_gaji = mysql_fetch_array($res_peraturan_gaji)){
        $row_peraturan_gaji["id_peraturan_gaji"] = $ds_peraturan_gaji["id_peraturan_gaji"];
        $row_peraturan_gaji["nama_daftar_gaji"] = $ds_peraturan_gaji["nama_daftar_gaji"];
        $row_peraturan_gaji["peraturan"] = $ds_peraturan_gaji["peraturan"];
        $row_peraturan_gaji["tgl_berlaku"] = tglpjgindonesia($ds_peraturan_gaji["tgl_berlaku"]);
        array_push($peraturan_gaji, $row_peraturan_gaji);
    }
    echo("var peraturan_gaji = " . json_encode($peraturan_gaji) . ";\n");
    
    // DATA : usulan_gaji_berkala_detail
    $ugbd = array();
    $sql_ugbd = "SELECT
                    	a.*, b.id_pangkat
                    FROM
                    	tbl_usulan_gaji_berkala_detail a
                    	LEFT JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai
                    WHERE
                    	id_detail_gaji_berkala='" . $id_detail_gaji_berkala . "'";
						
    $res_ugbd = mysql_query($sql_ugbd);
    $ds_ugbd = mysql_fetch_array($res_ugbd);
    $ugbd["id_detail_gaji_berkala"] = $ds_ugbd["id_detail_gaji_berkala"];
    $ugbd["id_usulan"] = $ds_ugbd["id_usulan"];
    $ugbd["id_sk"] = $ds_ugbd["id_sk"];
    $ugbd["id_pegawai"] = $ds_ugbd["id_pegawai"];
    $ugbd["status"] = $ds_ugbd["status"];
    $ugbd["id_pangkat"] = $ds_ugbd["id_pangkat"];
    $ugbd["pangkat"] = apa_pangkat($ds_ugbd["id_pangkat"]);
    echo("var ugbd = " . json_encode($ugbd) . ";\n");
    
    // DATA : sk_gaji_berkala
    require_once("php/model/sk_gaji_berkala_model.php");
    $obj = new SKGajiBerkala_Model();
    $obj->Record($ugbd["id_sk"]);
    $sk["id_sk"] = $obj->id_sk;
    $sk["no_sk"] = $obj->no_sk;
    $sk["tgl_sk"] = $obj->tgl_sk;
    $sk["jabatan_ttd_sk"] = $obj->jabatan_ttd_sk;
    $sk["nama_ttd_sk"] = $obj->nama_ttd_sk;
    $sk["nip_ttd_sk"] = $obj->nip_ttd_sk;
    $sk["id_pangkat_ttd_sk"] = $obj->id_pangkat_ttd_sk;
    echo("var sk = " . json_encode($sk) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tmt");
        ambil_tanggal("tgl_sk");
        preload();
    });
    
    function preload(){
        $("#id_sk").val(sk.id_sk);
        $("#no_sk").val(sk.no_sk);
        $("#tgl_sk").val(sk.tgl_sk);
        $("#jabatan_pejabat_ttd_sk").val(sk.jabatan_ttd_sk);
        $("#nama_pejabat_ttd_sk").val(sk.nama_ttd_sk);
        $("#nip_pejabat_ttd_sk").val(sk.nip_ttd_sk);
        $("#id_pangkat_pejabat_ttd_sk").val(sk.id_pangkat_ttd_sk);
        $("#id_pegawai").val(ugbd.id_pegawai);
        $("#id_detail_gaji_berkala").val(ugbd.id_detail_gaji_berkala);
        $("#apa_pangkat").html(ugbd.pangkat);
    }
    
    function simpan(){
        $("#frm").submit();
    }
    
    function kembali(){
        document.location.href="?mod=gb_daftar_sk_diproses&id_sk=" + ugbd.id_sk;
    }
    
    function load_jenis_gaji(){
        var id_peraturan_gaji = $("#id_peraturan_gaji").val();
        $("#id_jenis_gaji").html("<option value='0'>----- Pilih Gaji -----</option>");
        if(id_peraturan_gaji != 0){
            $.ajax({
                type : "post",
                dataType : "json",
                data : "id_peraturan_gaji=" + id_peraturan_gaji + "&id_pangkat=" + ugbd.id_pangkat,
                url : "ajax/load_jenis_gaji.php",
                success : function(r){
                    //alert(r);
                    $.each(r, function(i,item){
                        $("#id_jenis_gaji").append("<option value='" + item.id_jenis_gaji + "'>MKG " + item.mkg + " Tahun : " + item.gaji + "</option>");
                    });
                }
            });
        }
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Data kenaikan gaji berkala pegawai telah disimpan", "PERHATIAN", function(r){
            kembali();
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
                                <h1><a style="color:#AA9F00;" href="">DAFTAR SK PENGUSULAN GAJI BERKALA</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR SK PENGUSULAN GAJI BERKALA PROSES LANJUT</span></td>
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
		<form name="frm" id="frm" action="php/gaji_berkala/gb_daftar_sk_diproses_lanjut.php" method="post" target="sbm_target">
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">SIMPAN DATA KENAIKAN GAJI BERKALA PEGAWAI</h3>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								<label>TMT Kenaikan Gaji Berkala :</label>
								<input type="text" name="tmt" id="tmt" class="form-control" />
								<input type="hidden" name="id_pegawai" id="id_pegawai" class="form-control" />
								<input type="hidden" name="id_detail_gaji_berkala" id="id_detail_gaji_berkala" class="form-control" />
							</td>
						</tr>
					</table>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='50%'>
								<label>NO. SK :</label>
								<input type="text" name="no_sk" id="no_sk" class="form-control" />
							</td>
							<td>
								<label>Tgl. SK :</label>
								<input type="text" name="tgl_sk" id="tgl_sk" class="form-control" />
							</td>
						</tr>
						<tr>
							<td width='50%'>
								<label>Nama Pejabat Penandatangan :</label>
								<input type="text" name="nama_pejabat_ttd_sk" id="nama_pejabat_ttd_sk" class="form-control" />
							</td>
							<td>
								<label>NIP Pejabat Penandatangan :</label>
								<input type="text" name="nip_pejabat_ttd_sk" id="nip_pejabat_ttd_sk" class="form-control" />
							</td>
						</tr>
						<tr>
							<td width='50%'>
								<label>Jabatan Pejabat Penandatangan :</label>
								<input type="text" name="jabatan_pejabat_ttd_sk" id="jabatan_pejabat_ttd_sk" class="form-control" />
							</td>
							<td>
								<label>Pangkat Pejabat Penandatangan :</label>
								<select name="id_pangkat_pejabat_ttd_sk" id="id_pangkat_pejabat_ttd_sk" class="form-control">
									<option value="0">----- Pilih Pangkat -----</option>
									<script type="text/javascript">
									$.each(pangkat, function(i, item){
										document.write("<option value='" + item.id_pangkat + "'>" + item.pangkat + " (" + item.gol_ruang + ")</option>");
									});
									</script>
								</select>
							</td>
						</tr>
						<tr>
							<td width='50%'>
								<label>Peraturan Gaji yang Digunakan :</label>
								<select name="id_peraturan_gaji" id="id_peraturan_gaji" class="form-control" onchange="load_jenis_gaji();">
									<option value="0">----- Pilih Peraturan yang Digunakan -----</option>
									<script type="text/javascript">
										$.each(peraturan_gaji, function(i, item){
											document.write("<option value='" + item.id_peraturan_gaji + "'>Peraturan Gaji Tanggal : " + item.tgl_berlaku + " (" + item.peraturan + ")</option>");
										});
									</script>
								</select>
							</td>
							<td>
								<label>Pilih Gaji <i style="color:green;">Pangkat Saat Ini adalah <span id="apa_pangkat"></span></i>:</label>
								<select name="id_jenis_gaji" id="id_jenis_gaji" class="form-control">
									<option value="0">----- Pilih Gaji -----</option>
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
 