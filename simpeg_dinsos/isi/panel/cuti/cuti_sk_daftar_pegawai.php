<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $list_pegawai = array();
    $sql_list_pegawai = "SELECT
                            	e.id_riwayat_cuti, f.jenis_cuti, e.lama, e.dari, e.sampai, a.id_pegawai, a.nama_pegawai, a.nip,
                            	b.pangkat, b.gol_ruang,
                            	c.jabatan, d.skpd
                            FROM
                            	tbl_pegawai a
                            	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                            	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                            	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                            	INNER JOIN tbl_riwayat_cuti e ON (a.id_pegawai = e.id_pegawai AND e.id_surat = '" . $_GET["id_surat"] . "')
                            	LEFT JOIN ref_jenis_cuti f ON e.id_jenis_cuti = f.id_jenis_cuti
                            ORDER BY
                            		a.nama_pegawai ASC";
    $res_list_pegawai = mysql_query($sql_list_pegawai);
    $norut_list_pegawai = 0;
    while($ds_list_pegawai = mysql_fetch_array($res_list_pegawai)){
        $norut_list_pegawai++;
        $row_list_pegawai["no"] = $norut_list_pegawai;
        $row_list_pegawai["id_riwayat_cuti"] = $ds_list_pegawai["id_riwayat_cuti"];
        $row_list_pegawai["jenis_cuti"] = $ds_list_pegawai["jenis_cuti"];
        $row_list_pegawai["lama"] = $ds_list_pegawai["lama"];
        $row_list_pegawai["dari"] = $ds_list_pegawai["dari"];
        $row_list_pegawai["sampai"] = $ds_list_pegawai["sampai"];
        $row_list_pegawai["id_pegawai"] = $ds_list_pegawai["id_pegawai"];
        $row_list_pegawai["nama_pegawai"] = $ds_list_pegawai["nama_pegawai"];
        $row_list_pegawai["nip"] = $ds_list_pegawai["nip"];
        $row_list_pegawai["pangkat"] = $ds_list_pegawai["pangkat"];
        $row_list_pegawai["gol_ruang"] = $ds_list_pegawai["gol_ruang"];
        $row_list_pegawai["jabatan"] = $ds_list_pegawai["jabatan"];
        $row_list_pegawai["skpd"] = $ds_list_pegawai["skpd"];
        array_push($list_pegawai, $row_list_pegawai);
    }
    echo("var list_pegawai = " . json_encode($list_pegawai) . ";\n");
    echo("var qs_id_surat = " . $_GET["id_surat"] . ";");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
function tambah_pegawai_langsung(){
    document.location.href="?mod=cuti_sk_tambah_pegawai_langsung&id_surat=" + qs_id_surat;
}
function tambah_pegawai_dari_usulan(){
    document.location.href="?mod=cuti_sk_tambah_daftar_usulan&id_surat=" + qs_id_surat;
}
function hapus(id_riwayat_cuti){
    document.location.href="php/cuti/cuti_sk_daftar_pegawai_hapus.php?id_riwayat_cuti=" + id_riwayat_cuti;
}
function edit(id_riwayat_cuti){
    document.location.href="?mod=cuti_sk_daftar_pegawai_edit&id_riwayat_cuti=" + id_riwayat_cuti;
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
                                <h1><a style="color:#AA9F00;" href="">DAFTAR PEGAWAI DALAM SK CUTI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR PEGAWAI DALAM SK CUTI</span></td>
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
						<h3 style="text-align: left;">DAFTAR PEGAWAI YANG DIUSULKAN CUTI</h3>
						<div class="bodypanel">
							<button type="button" class="btn btn-warning" onclick="document.location.href='?mod=cuti_sk';"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
							<button type="button" class="btn btn-success" onclick="tambah_pegawai_dari_usulan();"><span class='glyphicon glyphicon-tags'></span>&nbsp;&nbsp;Tambah Pegawai Dari Usulan SKPD</button>
							<button type="button" class="btn btn-info" onclick="tambah_pegawai_langsung();"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah Pegawai Langsung</button>
							<div class="kelang"></div>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
							<thead>
								<tr class="headertable">
									<th width='40px'>No.</th>
									<th>NAMA PEGAWAI</th>
									<th width='150px'>NIP</th>
									<th width='200px'>JABATAN</th>
									<th width='200px'>SKPD</th>
									<th width='150px'>PANGKAT</th>
									<th width='100px'>JENIS CUTI</th>
									<th width='100px'>TMT</th>
									<th width='80px'>&nbsp;</th>
									<th width='80px'>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<script type="text/javascript">
								var text = "";
								$.each(list_pegawai, function(i, item){
									text += "<tr>";
										text += "<td class='tengah tengah_tengah'>" + item.no + "</td>";
										text += "<td>" + item.nama_pegawai + "</td>";
										text += "<td class='tengah tengah_tengah'>" + item.nip + "</td>";
										text += "<td>" + item.jabatan + "</td>";
										text += "<td>" + item.skpd + "</td>";
										text += "<td class='tengah tengah_tengah'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
										text += "<td class='tengah tengah_tengah'>" + item.jenis_cuti + "</td>";
										text += "<td class='tengah tengah_tengah'>" + item.dari + "<br />S/D<br />" + item.sampai + "</td>";
										text += "<td><button class='btn btn-sm btn-info' style='width:100%;' onclick='edit(" + item.id_riwayat_cuti + ");'><span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;Edit</button></td>";
										text += "<td><button class='btn btn-sm btn-warning' style='width:100%;' onclick='hapus(" + item.id_riwayat_cuti + ");'><span class='glyphicon glyphicon-trash'></span>&nbsp;&nbsp;Hapus</button></td>";
									text += "</tr>";
								});
								document.write(text);
							</script>
							</tbody>
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
 




