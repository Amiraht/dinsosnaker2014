<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $list_norut = array();
    $sql_list_norut = "SELECT
                        	e.no_usulan, e.tgl_usulan, COUNT(e.no_usulan) AS jumlah
                        FROM
                        	tbl_pegawai a
                        	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                        	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                        	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                        	LEFT JOIN tbl_usulan_cuti e ON (a.id_pegawai = e.id_pegawai AND e.diproses = 0)
                        WHERE
                        	e.id_pegawai IS NOT NULL
                        GROUP BY
                        	e.no_usulan
                        ORDER BY
                        		e.tgl_usulan";
    $res_list_norut = mysql_query($sql_list_norut);
    $nomor = 0;
    while($ds_list_norut = mysql_fetch_array($res_list_norut)){
        $nomor++;
        $row_norut["nomor"] = $nomor;
        $row_norut["no_usulan"] = $ds_list_norut["no_usulan"];
        $row_norut["tgl_usulan"] = $ds_list_norut["tgl_usulan"];
        $row_norut["jumlah"] = $ds_list_norut["jumlah"];
        array_push($list_norut, $row_norut);
    }
    echo("var list_norut = " . json_encode($list_norut) . ";");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
function edit_pegawai(no_usulan){
    document.location.href="?mod=cuti_proses_daftar_pegawai&no_usulan=" + no_usulan;
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
                                <h1><a style="color:#AA9F00;" href="">DAFTAR USULAN CUTI</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR USULAN CUTI</span></td>
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
							<div class="kelang"></div>
							<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
							<thead>
								<tr class="headertable">
									<th width='40px'>No.</th>
									<th>No. Usulan</th>
									<th width='100px'>Tgl. Usulan</th>
									<th width='200px'>Jumlah Pegawai<br />Yg Belum Diproses</th>
									<th width='100px'>&nbsp;</th>
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
									text += "<td style='text-align:center;'>" + item.jumlah + " Pegawai</td>";
									text += "<td><button type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='edit_pegawai(\"" + item.no_usulan + "\");'>Proses <span class='glyphicon glyphicon-chevron-right'></span></button></td>";
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
 



