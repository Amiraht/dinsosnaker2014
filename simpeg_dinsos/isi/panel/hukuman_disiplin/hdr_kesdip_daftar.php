<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $list_pegawai = array();
    $sql_list_pegawai = "SELECT
                            	e.id_usulan, e.status, e.keterangan, a.id_pegawai, a.nama_pegawai, a.nip,
                            	b.pangkat, b.gol_ruang,
                            	c.jabatan, d.skpd,
                            	CASE
                            		WHEN f.sub_jenis_disiplin IS NULL THEN ''
                            		ELSE f.sub_jenis_disiplin
                            	END AS sub_jenis_disiplin,
                            	CASE
                            		WHEN g.jenis_disiplin IS NULL THEN ''
                            		ELSE g.jenis_disiplin
                            	END AS jenis_disiplin,
                                e.scan_sk
                            FROM
                            	tbl_pegawai a
                            	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                            	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                            	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                            	LEFT JOIN tbl_usulan_hukuman_disiplin e ON (a.id_pegawai = e.id_pegawai AND e.pemisah_hukuman = 1 AND e.status > 1)
                            	LEFT JOIN ref_sub_jenis_disiplin f ON e.id_sub_jenis_disiplin = f.id_sub_jenis_disiplin
                            	LEFT JOIN ref_jenis_disiplin g ON e.id_jenis_disiplin = g.id_jenis_disiplin
                            WHERE
                            	e.id_pegawai IS NOT NULL
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
        $row_list_pegawai["jenis_disiplin"] = $ds_list_pegawai["jenis_disiplin"];
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
function tambah(){
    document.location.href="?mod=hdsb_skpd_tambah";
}
function edit(id_usulan){
    document.location.href="?mod=hdr_kesdip_edit&id_usulan=" + id_usulan;
}
function hapus(id_usulan){
    jConfirm("Anda yakin akan menghapus usulan ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/hukuman_disiplin/hdsb_skpd_hapus.php?id_usulan=" + id_usulan;
        }
    });
}
function proses_selesai(id_usulan){
    jConfirm("Anda yakin bahwa proses ini telah selesai?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/hukuman_disiplin/hdr_kesdip_proses_selesai.php?id_usulan=" + id_usulan;
        }
    });
}
function lihat_scan_sk(scan_sk){
    if(scan_sk == "")
        jAlert("File Scan SK Belum diupload", "PERHATIAN");
    else
        window.open("sk_uploaded/hukuman_disiplin/" + scan_sk);
}
</script>
<!-- END OF JAVASRIPT PAGE -->


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">HUKUMAN DISIPLIN RINGAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>HUKUMAN DISIPLIN RINGAN</span></td>
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
					<h3 style="text-align: left;">DAFTAR PEGAWAI YANG DIKENAI HUKUMAN DISIPLIN RINGAN OLEH SKPD YANG BERSANGKUTAN</h3>
					<div class="bodypanel">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
						<thead>
							<tr class="headertable">
								<th width='40px'>No.</th>
								<th width='140px'>NIP</th>
								<th width='120px'>Nama Pegawai</th>
								<th width='120px'>Jabatan</th>
								<th width='150px'>SKPD</th>
								<th width='120px'>Pangkat</th>
								<th width='150px'>Jenis<br />Hukuman</th>
								<th width='150px'>Sub Jenis<br />Hukuman</th>
								<th>Keterangan</th>
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
									text += "<td align='center'>" + item.jenis_disiplin + "</td>";
									text += "<td align='center'>" + item.sub_jenis_disiplin + "</td>";
									text += "<td>" + item.keterangan + "</td>";
									text += "<td><button title='Lihat Data' type='button' class='btn btn-sm btn-success' style='width:100%;' onclick='edit(" + item.id_usulan + ");'><span class='glyphicon glyphicon-edit'></span></button></td>";
									text += "<td><button title='Lihat Scan SK' type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='lihat_scan_sk(\"" + item.scan_sk + "\");'><span class='glyphicon glyphicon-file'></span></button></td>";
									if(item.status < 3)
										text += "<td><button title='Proses Selesai' type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='proses_selesai(" + item.id_usulan + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
									else
										text += "<td>&nbsp;</td>";
								text += "</tr>";
							});
							document.write(text);
						</script>
						</tbody>
						</table>
						<div class="kelang"></div>
						*) hanya data yang belum di proses selesa yang dapat diproses
					</div>
				</div>
	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 


