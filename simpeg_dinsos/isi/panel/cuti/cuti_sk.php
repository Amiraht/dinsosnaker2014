<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $sk = array();
    $sql_sk = "SELECT * FROM tbl_sk_cuti ORDER BY id_surat DESC";
    $res_sk = mysql_query($sql_sk);
    $norut_sk = 0;
    while($ds_sk = mysql_fetch_array($res_sk)){
        $norut_sk++;
        $row_sk["no"] = $norut_sk;
        $row_sk["id_surat"] = $ds_sk["id_surat"];
        $row_sk["no_surat"] = $ds_sk["no_surat"];
        $row_sk["tgl_input"] = $ds_sk["tgl_input"];
        $row_sk["tgl_surat"] = $ds_sk["tgl_surat"];
        $row_sk["pejabat_surat"] = $ds_sk["pejabat_surat"];
        array_push($sk, $row_sk);
    }
    echo("var sk = " . json_encode($sk) . ";");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    $( "#pnl_upload" ).dialog({
            autoOpen: false,
    		height: "auto",
    		width: "800",
    		modal: true,
            show: "fade",
    		hide: "fade"
        });
});
function edit(id_surat){
    document.location.href="?mod=cuti_sk_edit&id_surat=" + id_surat;
}
function hapus(id_surat){
    jConfirm("Anda yakin akan menghapus data ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href = "php/cuti/cuti_sk_hapus.php?id_surat=" + id_surat;
        }
    });
}
function proses(id_surat){
    document.location.href="?mod=cuti_sk_daftar_pegawai&id_surat=" + id_surat;
}
function upload_scan_sk(id_surat){
    $("#id_surat").val(id_surat);
    $("#pnl_upload").dialog("open");
}
function cetak_sk(id_surat){
    window.open("cetak/sk/cuti/sk_cuti.php?id_surat=" + id_surat);
}
function cetak_lampiran(id_surat){
    window.open("cetak/sk/cuti/sk_cuti_lampiran.php?id_surat=" + id_surat);
}
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">
function something_wrong_upload(what_is_wrong){
    jAlert(what_is_wrong, "PERHATIAN");
}
function debug(what_is_wrong){
    alert(what_is_wrong, "PERHATIAN");
}
function success_upload(){
    jAlert("File scan SK telah diupload", "PERHATIAN", function(r){
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
                                <h1><a style="color:#AA9F00;" href="">DAFTAR DATA SK CUTI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR DATA SK CUTI</span></td>
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
						<div class="panelcontainer" style="width: 100%;">
							<h3 style="text-align: left;">DAFTAR SK CUTI YANG PERNAH DIBUAT</h3>
							<div class="bodypanel">
								<button type="button" class="btn btn-info" onclick="document.location.href='?mod=cuti_sk_tambah';"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah SK Cuti</button>
								<div class="kelang"></div>
								<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
								<thead>
									<tr class="headertable">
										<th width='40px'>No.</th>
										<th width='100px'>Tanggal<br />Input</th>
										<th width='300px'>No. Surat</th>
										<th width='100px'>Tanggal<br />Surat</th>
										<th>Pejabat Penandatangan</th>
										<th width='60px'>&nbsp;</th>
										<th width='60px'>&nbsp;</th>
										<th width='60px'>&nbsp;</th>
										<th width='60px'>&nbsp;</th>
										<th width='60px'>&nbsp;</th>
										<th width='60px'>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
								<script type="text/javascript">
									var text="";
									$.each(sk, function(i, item){
										text += "<tr>";
											text += "<td style='text-align:center;'>" + item.no + "</td>";
											text += "<td style='text-align:center;'>" + item.tgl_input + "</td>";
											text += "<td style='text-align:center;'>" + item.no_surat + "</td>";
											text += "<td style='text-align:center;'>" + item.tgl_surat + "</td>";
											text += "<td style='text-align:center;'>" + item.pejabat_surat + "</td>";
											text += "<td><button class='btn btn-sm btn-info' style='width:100%;' title='Edit Data' onclick='edit(" + item.id_surat + ");'><span class='glyphicon glyphicon-edit'></span></button></td>";
											text += "<td><button class='btn btn-sm btn-info' style='width:100%;' title='Cetak SK' onclick='cetak_sk(" + item.id_surat + ");'><span class='glyphicon glyphicon-print'></span></button></td>";
											text += "<td><button class='btn btn-sm btn-info' style='width:100%;' title='Cetak Lampiran' onclick='cetak_lampiran(" + item.id_surat + ")'><span class='glyphicon glyphicon-print'></span></button></td>";
											text += "<td><button class='btn btn-sm btn-info' style='width:100%;' title='Upload Scan SK' onclick='upload_scan_sk(" + item.id_surat + ");'><span class='glyphicon glyphicon-open'></span></button></td>";
											text += "<td><button class='btn btn-sm btn-success' style='width:100%;' title='Proses Data' onclick='proses(" + item.id_surat + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
											text += "<td><button class='btn btn-sm btn-warning' style='width:100%;' title='Hapus Data' onclick='hapus(" + item.id_surat + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
										text += "</tr>";
									});
									document.write(text);
								</script>
								</tbody>
								</table>
							</div>
						</div>

						<!-- DIALOG BOX -->
						<div id="pnl_upload" title="UPLOAD HASIL SCAN SK" style="display: none;">
						<form method="post" name="frm_upload" id="frm_upload" action="php/cuti/cuti_sk_scan_sk.php" enctype="multipart/form-data" target="sbm_target">
						<input type="hidden" id="id_surat" name="id_surat" />
						<div class="panelcontainer" style="width: 100%;">
							<div class="bodypanel bodyfilter">
								<input type="file" name="scan_sk" />
								<div class="kelang"></div>
								<button type="submit" class="btn btn-success"><span class='glyphicon glyphicon-open'></span>&nbsp;&nbsp;Upload Scan SK</button>
							</div>
						</div>
						</form>
						</div>
						<!-- END OF DIALOG BOX -->

	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 
