<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $list_norut = array();
    $sql_list_norut = "SELECT
                        	e.id_usulan, e.no_usulan, e.tgl_usulan, rekap.total, rekap.belum, rekap.diterima, rekap.ditolak, e.diproses
                        FROM
                        	tbl_pegawai a
                        	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                        	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                        	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                        	LEFT JOIN tbl_usulan_cuti e ON (a.id_pegawai = e.id_pegawai AND e.no_usulan IS NOT NULL)
                        	INNER JOIN
                        	(
                        		SELECT
                        			ctr.no_usulan, SUM(ctr.total) AS total, SUM(ctr.belum) AS belum, SUM(ctr.diterima) AS diterima, SUM(ctr.ditolak) AS ditolak
                        		FROM
                        			(
                        				SELECT
                        					no_usulan, 1 AS total,
                        					CASE
                        						WHEN diproses = 0 THEN 1
                        						else 0
                        					END AS belum,
                        					CASE
                        						WHEN diproses = 1 THEN 1
                        						else 0
                        					END AS diterima,
                        					CASE
                        						WHEN diproses = 2 THEN 1
                        						else 0
                        					END AS ditolak
                        				FROM
                        					tbl_usulan_cuti
                        			) AS ctr
                        		GROUP BY
                        			ctr.no_usulan
                        	) rekap ON e.no_usulan = rekap.no_usulan
                        WHERE
                        	d.kode_skpd LIKE '" . $_SESSION["kode_skpd"] . "%' AND e.id_pegawai IS NOT NULL
                        GROUP BY
                        	e.no_usulan
                        ORDER BY
                        		e.tgl_usulan DESC";
								
    $res_list_norut = mysql_query($sql_list_norut);
    $nomor = 0;
	
    while($ds_list_norut = mysql_fetch_array($res_list_norut)){
        $nomor++;
        $row_norut["nomor"] = $nomor;
		$row_norut["id_usulan"] = $ds_list_norut["id_usulan"];
        $row_norut["no_usulan"] = $ds_list_norut["no_usulan"];
        $row_norut["tgl_usulan"] = $ds_list_norut["tgl_usulan"];
        $row_norut["total"] = $ds_list_norut["total"];
        $row_norut["belum"] = $ds_list_norut["belum"];
        $row_norut["diterima"] = $ds_list_norut["diterima"];
        $row_norut["ditolak"] = $ds_list_norut["ditolak"];
        $row_norut["diproses"] = $ds_list_norut["diproses"];
        array_push($list_norut, $row_norut);
    }
	
    echo("var list_norut = " . json_encode($list_norut) . ";");

?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
    function edit_pegawai(no_usulan){
        document.location.href="?mod=cuti_daftar_usulan_edit&no_usulan=" + no_usulan;
    }
    
    function lanjutkan(no_usulan){
        jConfirm("Anda yakin akan melanjutkan usulan ini ke BKD?", "PERHATIAN", function(r){
            if(r){
                document.location.href="php/cuti/cuti_daftar_usulan_lanjutkan.php?no_usulan=" + no_usulan;
            }
        });
    }
	
	function hapus(id_usulan){
        jConfirm("Hapus Data Usulan dengan ID "+id_usulan+" ini?", "PERHATIAN", function(r){
            if(r){
                document.location.href="php/cuti/cuti_daftar_usulan_hapus.php?id_usulan=" + id_usulan;
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
                                <h1><a style="color:#AA9F00;" href="">DATA USULAN CUTI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DATA USULAN CUTI</span></td>
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
				<h3 style="text-align: left;">DAFTAR USULAN CUTI YANG PERNAH DIBUAT</h3>
				<div class="bodypanel">
					<button type="button" class="btn btn-success" onclick="document.location.href='?mod=cuti_daftar_usulan_tambah';"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah Usulan Cuti</button>
					<button type="button" class="btn btn-info" onclick="document.location.href='?mod=cuti_daftar_ditolak';"><span class='glyphicon glyphicon-minus-sign'></span>&nbsp;&nbsp;Lihat Usulan Yang Ditolak</button>
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
					<thead>
						<tr class="headertable">
							<th width='40px'>No.</th>
							<th>No. Usulan</th>
							<th width='100px'>Tgl. Usulan</th>
							<th width='150px'>Jumlah Pegawai<br />Yg Diusulkan</th>
							<th width='150px'>Jumlah Pegawai<br />Yg Belum Diproses</th>
							<th width='150px'>Jumlah Pegawai<br />Yg Telah Diproses</th>
							<th width='150px'>Jumlah Pegawai<br />Yg Ditolak</th>
							<th width='80px'>&nbsp;</th>
							<th width='80px'>&nbsp;</th>
							<th width='80px'>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<script type="text/javascript">
					var text = "";
					$.each(list_norut, function(i, item){
					   text += "<tr>";
							text += "<td style='text-align:center;'>" + item.nomor + "</td>";
							text += "<td style='text-align:center;'>" + item.no_usulan + "</td>";
							text += "<td style='text-align:center;'>" + item.tgl_usulan + "</td>";
							text += "<td style='text-align:center;'>" + item.total + " Pegawai</td>";
							text += "<td style='text-align:center;'>" + item.belum + " Pegawai</td>";
							text += "<td style='text-align:center;'>" + item.diterima + " Pegawai</td>";
							text += "<td style='text-align:center;'>" + item.ditolak + " Pegawai</td>";
							text += "<td><button type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='edit_pegawai(\"" + item.no_usulan + "\");'>Edit &nbsp;<span class='glyphicon glyphicon-edit'></span></button></td>";
							text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-danger' style='width: 100%;' onclick='hapus(" + item.id_usulan + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";	
							if(item.diproses == 4)
								text += "<td><button type='button' class='btn btn-sm btn-success' style='width:100%;' onclick='lanjutkan(\"" + item.no_usulan + "\");'>Proses &nbsp;<span class='glyphicon glyphicon-cog'></span></button></td>";
							else
								text += "<td>&nbsp;</td>";
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
 