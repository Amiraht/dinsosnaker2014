<!-- CONTROLLER -->
<script type="text/javascript">
<?php
	$no_usulan = mysql_real_escape_string(trim(strip_tags($_GET["no_usulan"])));
	
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
                        	LEFT JOIN tbl_usulan_cuti e ON (a.id_pegawai = e.id_pegawai AND e.no_usulan = '" . $no_usulan . "' AND e.diproses=0)
                        WHERE
                        	e.id_pegawai IS NOT NULL
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
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    $( "#catatan" ).dialog({
            autoOpen: false,
    		height: "auto",
    		width: "800",
    		modal: true,
            show: "fade",
    		hide: "fade"
        });
    
    $( "#riwayat_cuti" ).dialog({
            autoOpen: false,
    		height: "auto",
    		width: "900",
    		modal: true,
            show: "fade",
    		hide: "fade"
        });
});
function tolak(id_usulan){
    $("#id_usulan").val(id_usulan);
    $( "#catatan" ).dialog("open");
    
}
function proses_tolak(){
    var id_usulan = $("#id_usulan").val();
    var isi_catatan = $("#isi_catatan").val();
    if(isi_catatan == "")
        jAlert("Isikan catatan penolakan", "PERHATIAN");
    else{
        document.location.href="php/cuti/cuti_proses_tolak.php?id_usulan=" + id_usulan + "&isi_catatan=" + isi_catatan;
    }
}
function terima(id_usulan){
    document.location.href="?mod=cuti_proses&id_usulan=" + id_usulan + "&no_usulan=<?php echo $no_usulan; ?>";
}
function riwayat_cuti(id_usulan){
    $("#isi_riwayat_cuti").html("Loading ...");
    $( "#riwayat_cuti" ).dialog("open");
    $.ajax({
        type : "post",
        url : "ajax/riwayat_cuti.php",
        data : "id_usulan=" + id_usulan,
        success : function(r){
            $("#isi_riwayat_cuti").html(r);
        }
    });
}
</script>
<!-- END OF JAVASCRIPT PAGE -->


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">PROSES CUTI PEGAWAI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>PROSES CUTI PEGAWAI</span></td>
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
											<th width='50px'>&nbsp;</th>
											<th width='50px'>&nbsp;</th>
											<th width='50px'>&nbsp;</th>
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
											text += "<td>";
												text += "<button type='button' class='btn btn-sm btn-success' style='width:100%' title='Lihat riwayat cuti' onclick='riwayat_cuti(" + item.id_usulan + ");'><span class='glyphicon glyphicon-th'></span></button>";
											text += "</td>";
											text += "<td><button type='button' class='btn btn-sm btn-warning' style='width:100%;' onclick='tolak(" + item.id_usulan + ");' title='Tolak'><span class='glyphicon glyphicon-remove'></span></btn></td>";
											text += "<td><button type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='terima(" + item.id_usulan + ")' title='Terima'><span class='glyphicon glyphicon-ok'></span></btn></td>";
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
								<div class="bodypanel bodyfilter" id="bodyfilter">
									<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
										<tr>
											<td>
												<button type="button" class="btn btn-success btn-lg" onclick="document.location.href='?mod=cuti_proses_no_usulan';"><span class='glyphicon glyphicon-chevron-left'></span> Kembali</button>
											</td>
										</tr>
									</table>
								</div>
							</div>

							<!-- DIALOG JQUERY -->
							<div id="catatan" title="CATATAN PENOLAKAN" style="display: none;">
							<input type="hidden" id="id_usulan" />
							<div class="panelcontainer" style="width: 100%;">
								<div class="bodypanel bodyfilter">
									<textarea class="form-control" id="isi_catatan" placeholder=":::: Isikan Catatan Penolakan ::::"></textarea>
									<div class="kelang"></div>
									<button type="button" class="btn btn-info" onclick="proses_tolak();">Simpan</button>
								</div>
							</div>
							</div>

							<div id="riwayat_cuti" title="RIWAYAT CUTI PEGAWAI" style="display: none;">
							<input type="hidden" id="id_usulan" />
							<div class="panelcontainer" style="width: 100%;">
								<div class="bodypanel bodyfilter" id="isi_riwayat_cuti">
									
								</div>
							</div>
							</div>
							<!-- END OF DIALOG JQUERY -->
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 



