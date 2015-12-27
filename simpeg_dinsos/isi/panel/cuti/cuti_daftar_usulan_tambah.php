<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $list_pegawai = array();
    $sql_list_pegawai = "SELECT
                        	e.id_usulan, a.id_pegawai, a.nama_pegawai, a.nip,
                        	b.pangkat, b.gol_ruang,
                        	c.jabatan, d.skpd
                        FROM
                        	tbl_pegawai a
                        	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                        	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                        	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                        	LEFT JOIN tbl_usulan_cuti e ON (a.id_pegawai = e.id_pegawai AND e.no_usulan IS NULL)
                        WHERE
                        	d.kode_skpd LIKE '" . $_SESSION["kode_skpd"] . "%' AND e.id_pegawai IS NOT NULL
                        ORDER BY
                        		a.nama_pegawai ASC";
    $res_list_pegawai = mysql_query($sql_list_pegawai);
    $no_list_pegawai = 0;
    while($ds_list_pegawai = mysql_fetch_array($res_list_pegawai)){
        $no_list_pegawai++;
        $row_pegawai["no"] = $no_list_pegawai;
        $row_pegawai["id_usulan"] = $ds_list_pegawai["id_usulan"];
        $row_pegawai["id_pegawai"] = $ds_list_pegawai["id_pegawai"];
        $row_pegawai["nama_pegawai"] = $ds_list_pegawai["nama_pegawai"];
        $row_pegawai["nip"] = $ds_list_pegawai["nip"];
        $row_pegawai["pangkat"] = $ds_list_pegawai["pangkat"];
        $row_pegawai["gol_ruang"] = $ds_list_pegawai["gol_ruang"];
        $row_pegawai["jabatan"] = $ds_list_pegawai["jabatan"];
        $row_pegawai["skpd"] = $ds_list_pegawai["skpd"];
        array_push($list_pegawai, $row_pegawai);
    }
    echo("var list_pegawai = " . json_encode($list_pegawai) . ";");
    
    $jenis_cuti = array();
    $res_jenis_cuti = mysql_query("SELECT * FROM ref_jenis_cuti ORDER BY id_jenis_cuti ASC");
    while($ds_jenis_cuti = mysql_fetch_array($res_jenis_cuti)){
        $row_jenis_cuti["id_jenis_cuti"] = $ds_jenis_cuti["id_jenis_cuti"];
        $row_jenis_cuti["jenis_cuti"] = $ds_jenis_cuti["jenis_cuti"];
        array_push($jenis_cuti, $row_jenis_cuti);
    }
    echo("var jenis_cuti = " . json_encode($jenis_cuti) . ";");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("dari");
    ambil_tanggal("sampai");
    ambil_tanggal("tgl_usulan");
});
function batal(id_usulan){
    document.location.href="php/cuti/cuti_daftar_usulan_pop_pegawai.php?id_usulan=" + id_usulan + "&mod=cuti_daftar_usulan_tambah";
}
function simpan_usulan(){
    var no_usulan = $("#no_usulan").val();
    var tgl_usulan = $("#tgl_usulan").val();
    var pejabat_usulan = $("#pejabat_usulan").val()
    if(no_usulan != "" && tgl_usulan != "" && pejabat_usulan != ""){
        jConfirm("Anda yakin akan menyimpan data usulan cuti ini?", "PERHATIAN", function(r){
           if(r){
                //document.location.href="php/cuti/cuti_daftar_usulan_tambah.php?no_usulan=" + no_usulan;
                $("#submit_target").attr("src", "php/cuti/cuti_daftar_usulan_tambah.php?no_usulan=" + no_usulan + "&tgl_usulan=" + tgl_usulan + "&pejabat_usulan=" + pejabat_usulan);
           } 
        });
    }else{
        jAlert("Isikan nomor, tanggal, dan pejabat penandatangan usulan", "PERHATIAN");
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
    jAlert("Data usulan cuti telah disimpan", "PERHATIAN", function(r){
        document.location.href="?mod=cuti_daftar_usulan";
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
                                <h1><a style="color:#AA9F00;" href="">TAMBAH PEGAWAI USULAN CUTI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>TAMBAH PEGAWAI USULAN CUTI</span></td>
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
			<form name="frm" id="frm" action="php/cuti/cuti_daftar_usulan_push_pegawai.php" method="post">
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">TAMBAH PEGAWAI UNTUK DIUSULKAN</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='50%'>
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
								<td>
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
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td align='left'>
									<button type="submit" class="btn btn-success"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah</button>
								</td>
							</tr>
						</table>
					</div>
				</div>
				</form>
				<div class="kelang"></div>
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">DAFTAR PEGAWAI YANG DIUSULKAN</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
						<thead>
							<tr class="headertable">
								<th width='40px'>No.</th>
								<th>NAMA PEGAWAI</th>
								<th width='200px'>NIP</th>
								<th width='200px'>JABATAN</th>
								<th width='300px'>SKPD</th>
								<th width='200px'>PANGKAT</th>
								<th width='80px'>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<script type="text/javascript">
						var text = "";
						$.each(list_pegawai, function(i, item){
							text += "<tr>";
								text += "<td style='text-align:center;'>" + item.no + "</td>";
								text += "<td>" + item.nama_pegawai + "</td>";
								text += "<td style='text-align:center;'>" + item.nip + "</td>";
								text += "<td>" + item.jabatan + "</td>";
								text += "<td>" + item.skpd + "</td>";
								text += "<td style='text-align:center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
								text += "<td><button type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='batal(" + item.id_usulan + ");'><span class='glyphicon glyphicon-remove'></span>&nbsp;&nbsp;Batal</btn></td>";
							text += "</tr>";
						});
						document.write(text);
						</script>
						</tbody>
						</table>
					</div>
				</div>
				<div class="kelang"></div>
				<div class="panelcontainer panelform" style="width: 100%;">
					<h3 style="text-align: left;">MASUKKAN DATA SURAT USULAN</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td>
									<label>No. Surat Usulan :</label>
									<input placeholder=":: NOMOR SURAT USULAN ::" type="text" name="no_usulan" id="no_usulan" />
								</td>
							</tr>
						</table>
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='50%'>
									<label>Tgl. Surat Usulan :</label>
									<input placeholder=":: TGL. SURAT USULAN ::" type="text" name="tgl_usulan" id="tgl_usulan" />
								</td>
								<td>
									<label>Pejabat Penandatangan Surat Usulan :</label>
									<input placeholder=":: PEJABAT PENANDATANGAN SURAT USULAN ::" type="text" name="pejabat_usulan" id="pejabat_usulan" />
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
								<td>
									<button type="button" class="btn btn-success btn-lg" onclick="simpan_usulan();"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Simpan Usulan Cuti</button>
								</td>
							</tr>
						</table>
					</div>
				</div>
			
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 


