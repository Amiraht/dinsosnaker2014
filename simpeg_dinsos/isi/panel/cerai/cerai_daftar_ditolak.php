<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $list_pegawai = array();
    $sql_list_pegawai = "SELECT
                        	e.id_usulan, e.no_usulan, e.catatan_penolakan, a.id_pegawai, a.nama_pegawai, a.nip,
                        	b.pangkat, b.gol_ruang,
                        	c.jabatan, d.skpd
                        FROM
                        	tbl_pegawai a
                        	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                        	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                        	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                        	LEFT JOIN tbl_usulan_cerai e ON (a.id_pegawai = e.id_pegawai AND e.diproses=2)
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
        $row_pegawai["no_usulan"] = $ds_list_pegawai["no_usulan"];
        $row_pegawai["catatan_penolakan"] = $ds_list_pegawai["catatan_penolakan"];
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
});

function lihat_catatan(isi_catatan){
    $("#isi_catatan").html(isi_catatan);
    $( "#catatan" ).dialog("open");
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
                                <h1><a style="color:#AA9F00;" href="">DAFTAR USULAN CERAI DITOLAK</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR USULAN CERAI DITOLAK</span></td>
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
					<h3 style="text-align: left;">DAFTAR PEGAWAI YANG DITOLAK</h3>
					<div class="bodypanel bodyfilter" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
						<thead>
							<tr class="headertable">
								<th width='40px'>No.</th>
								<th>NO. USULAN</th>
								<th>NAMA PEGAWAI</th>
								<th width='200px'>NIP</th>
								<th width='150px'>JABATAN</th>
								<th width='300px'>SKPD</th>
								<th width='150px'>PANGKAT</th>
								<th width='100px'>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<script type="text/javascript">
						var text = "";
						$.each(list_pegawai, function(i, item){
							text += "<tr>";
								text += "<td style='text-align:center;'>" + item.no + "</td>";
								text += "<td>" + item.no_usulan + "</td>";
								text += "<td>" + item.nama_pegawai + "</td>";
								text += "<td style='text-align:center;'>" + item.nip + "</td>";
								text += "<td>" + item.jabatan + "</td>";
								text += "<td>" + item.skpd + "</td>";
								text += "<td style='text-align:center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
								text += "<td><button type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='lihat_catatan(\"" + item.catatan_penolakan + "\");'><span class='glyphicon glyphicon-retweet'></span>&nbsp;&nbsp;Catatan</btn></td>";
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
									<button type="button" class="btn btn-success btn-lg" onclick="document.location.href='?mod=cerai_daftar_usulan';"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
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
 

<!-- DIALOG JQUERY -->
<div id="catatan" title="CATATAN PENOLAKAN" style="display: none;">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <div class="" role="alert">
            <div id="isi_catatan"></div>
        </div>
    </div>
</div>
</div>
<!-- END OF DIALOG JQUERY -->