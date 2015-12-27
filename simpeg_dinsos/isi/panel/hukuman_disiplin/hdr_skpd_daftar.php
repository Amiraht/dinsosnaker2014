<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $list_pegawai = array();
    $sql_list_pegawai = "SELECT
                            	e.id_usulan, e.status, e.keterangan, f.sub_jenis_disiplin, a.id_pegawai, a.nama_pegawai, a.nip,
                            	b.pangkat, b.gol_ruang,
                            	c.jabatan, d.skpd, e.scan_sk
                            FROM
                            	tbl_pegawai a
                            	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                            	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                            	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                            	LEFT JOIN tbl_usulan_hukuman_disiplin e ON (a.id_pegawai = e.id_pegawai AND e.pemisah_hukuman = 1)
                            	LEFT JOIN ref_sub_jenis_disiplin f ON e.id_sub_jenis_disiplin = f.id_sub_jenis_disiplin
                            WHERE
                            	d.kode_skpd LIKE '" . $_SESSION["simpeg_kode_skpd"] . "%' AND e.id_pegawai IS NOT NULL
                            ORDER BY
                            		e.id_usulan DESC";
    $res_list_pegawai = mysql_query($sql_list_pegawai);
    $no = 0;
    while($ds_list_pegawai = mysql_fetch_array($res_list_pegawai)){
        $no++;
        $row_list_pegawai["no"] = $no;
        $row_list_pegawai["id_usulan"] = $ds_list_pegawai["id_usulan"];
        $row_list_pegawai["status"] = $ds_list_pegawai["status"];
        $row_list_pegawai["keterangan"] = $ds_list_pegawai["keterangan"];
        $row_list_pegawai["sub_jenis_disiplin"] = $ds_list_pegawai["sub_jenis_disiplin"];
        $row_list_pegawai["id_pegawai"] = $ds_list_pegawai["id_pegawai"];
        $row_list_pegawai["nama_pegawai"] = $ds_list_pegawai["nama_pegawai"];
        $row_list_pegawai["nip"] = $ds_list_pegawai["nip"];
        $row_list_pegawai["pangkat"] = $ds_list_pegawai["pangkat"];
        $row_list_pegawai["gol_ruang"] = $ds_list_pegawai["gol_ruang"];
        $row_list_pegawai["jabatan"] = $ds_list_pegawai["jabatan"];
        $row_list_pegawai["skpd"] = $ds_list_pegawai["skpd"];
        $row_list_pegawai["scan_sk"] = $ds_list_pegawai["scan_sk"];
        array_push($list_pegawai, $row_list_pegawai);
    }
    echo("var list_pegawai = " . json_encode($list_pegawai) . ";\n");
?>
</script>
<?php
    //echo($sql_list_pegawai);
?>
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
function tambah(){
    document.location.href="?mod=hdr_skpd_tambah";
}
function edit(id_usulan){
    document.location.href="?mod=hdr_skpd_edit&id_usulan=" + id_usulan;
}
function hapus(id_usulan){
    jConfirm("Anda yakin akan menghapus usulan ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/hukuman_disiplin/hdr_skpd_hapus.php?id_usulan=" + id_usulan;
        }
    });
}
function proses_ke_bkd(id_usulan){
    jConfirm("Anda yakin akan melaporkan data hukuman disiplin ringan ini ke BKD?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/hukuman_disiplin/hdr_skpd_proses_ke_bkd.php?id_usulan=" + id_usulan;
        }
    });
}

function upload_scan_sk(id_usulan){
    $("#id_usulan").val(id_usulan);
    $("#pnl_upload").dialog("open");
}

function lihat_scan_sk(scan_sk){
    if(scan_sk == "")
        jAlert("File Scan SK Belum diupload", "PERHATIAN");
    else
        window.open("sk_uploaded/hukuman_disiplin/" + scan_sk);
}

function cetak_sk(id_usulan){
    window.open("cetak/sk/hukuman_disiplin/sk_hd.php?id_usulan=" + id_usulan);
}
</script>
<!-- END OF JAVASRIPT PAGE -->

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
		
			<div class="panelcontainer" style="width: 100%;">
				<h3 style="text-align: left;">DAFTAR PEGAWAI YANG DIKENAI HUKUMAN DISIPLIN RINGAN</h3>
				<div class="bodypanel">
					<button type="button" class="btn btn-success" onclick="tambah();"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah Pegawai Yang Dikenai Hukuman Disiplin Ringan</button>
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
					<thead>
						<tr class="headertable">
							<th width='40px'>No.</th>
							<th width='150px'>NIP</th>
							<th width='150px'>Nama Pegawai</th>
							<th width='150px'>Jabatan</th>
							<th width='150px'>SKPD</th>
							<th width='150px'>Pangkat</th>
							<th width='150px'>Sub Jenis<br />Hukuman</th>
							<th>Keterangan</th>
							<th width='50px'>&nbsp;</th>
							<th width='50px'>&nbsp;</th>
							<th width='50px'>&nbsp;</th>
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
								text += "<td align='center'>" + item.no + "</td>";
								text += "<td>" + item.nip + "</td>";
								text += "<td>" + item.nama_pegawai + "</td>";
								text += "<td>" + item.jabatan + "</td>";
								text += "<td>" + item.skpd + "</td>";
								text += "<td>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
								text += "<td align='center'>" + item.sub_jenis_disiplin + "</td>";
								text += "<td>" + item.keterangan + "</td>";
								text += "<td><button title='Cetak SK' type='button' class='btn btn-sm btn-success' style='width:100%;' onclick='cetak_sk(" + item.id_usulan + ");'><span class='glyphicon glyphicon-print'></span></button></td>";
								text += "<td><button title='Upload SK' type='button' class='btn btn-sm btn-success' style='width:100%;' onclick='upload_scan_sk(" + item.id_usulan + ");'><span class='glyphicon glyphicon-open'></span></button></td>";
								text += "<td><button title='Lihat Scan SK' type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='lihat_scan_sk(\"" + item.scan_sk + "\");'><span class='glyphicon glyphicon-file'></span></button></td>";
								text += "<td><button title='Edit Data' type='button' class='btn btn-sm btn-success' style='width:100%;' onclick='edit(" + item.id_usulan + ");'><span class='glyphicon glyphicon-edit'></span></button></td>"; 
								if(item.status == 1){
									text += "<td><button title='Hapus' type='button' class='btn btn-sm btn-warning' style='width:100%;' onclick='hapus(" + item.id_usulan + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
									text += "<td><button title='Proses Ke BKD' type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='proses_ke_bkd(" + item.id_usulan + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
								}
								else{
									text += "<td>&nbsp;</td>";
									text += "<td>&nbsp;</td>";
								}
							text += "</tr>";
						});
						document.write(text);
					</script>
					</tbody>
					</table>
					<div class="kelang"></div>
					*) hanya data yang belum diserahkan ke BKD yang dapat diproses
				</div>
			</div>

	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 

<!-- DIALOG BOX -->
<div id="pnl_upload" title="UPLOAD HASIL SCAN SK" style="display: none;">
<form method="post" name="frm_upload" id="frm_upload" action="php/hukuman_disiplin/hd_upload_sk.php" enctype="multipart/form-data" target="sbm_target">
<input type="hidden" id="id_usulan" name="id_usulan" />
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

<!-- SUBMIT TARGET -->
<iframe src="" name="sbm_target" style="display: none;"></iframe>
<!-- END OF SUBMIT TARGET -->