<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $data = array();
	if($_SESSION['id_level'] == 15){
		$sql_data = "SELECT
                	a.*, b.pangkat, b.gol_ruang
                FROM
                	tbl_usulan_gaji_berkala a
                	LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd_usulan = b.id_pangkat
                WHERE
                	a.kode_skpd LIKE '" . $_SESSION["kode_skpd"] . "%' AND 
					a.status = '2'
                ORDER BY
                	a.id_usulan ASC";
					
	}else{
		$sql_data = "SELECT
                	a.*, b.pangkat, b.gol_ruang
                FROM
                	tbl_usulan_gaji_berkala a
                	LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd_usulan = b.id_pangkat
                WHERE
                	a.kode_skpd LIKE '" . $_SESSION["kode_skpd"] . "%'
                ORDER BY
                	a.id_usulan ASC";
	}				
					
    $res_data = mysql_query($sql_data);
    while($ds_data = mysql_fetch_array($res_data)){
        $row_data["id_usulan"] = $ds_data["id_usulan"];
        $row_data["no_usulan"] = $ds_data["no_usulan"];
        $row_data["tgl_usulan"] = $ds_data["tgl_usulan"];
        $row_data["jabatan_ttd_usulan"] = $ds_data["jabatan_ttd_usulan"];
        $row_data["nama_ttd_usulan"] = $ds_data["nama_ttd_usulan"];
        $row_data["nip_ttd_usulan"] = $ds_data["nip_ttd_usulan"];
        $row_data["status"] = $ds_data["status"];
        $row_data["pangkat"] = $ds_data["pangkat"];
        $row_data["gol_ruang"] = $ds_data["gol_ruang"];
		$row_data["catatan"] = $ds_data["catatan"];
        array_push($data, $row_data);
    }
    echo("var data = " . json_encode($data) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    function edit(id_usulan){
        document.location.href = "?mod=gb_daftar_usulan_edit&id_usulan=" + id_usulan;
    }
    
    function hapus(id_usulan){
        jConfirm("Anda yakin akan menghapus data usulan ini?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/gaji_berkala/gb_daftar_usulan_hapus.php?id_usulan=" + id_usulan;
            }
        });
    }
    
    function proses_ke_bkd(id_usulan){
        jConfirm("Anda yakin akan memproses data usulan ini ke BKD?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/gaji_berkala/gb_daftar_usulan_proses_bkd.php?id_usulan=" + id_usulan;
            }
        });
    }
    
    function daftar_diusulkan(id_usulan){
        document.location.href = "?mod=gb_daftar_usulan_diusulkan&id_usulan=" + id_usulan;
    }
	
	function acc(id_usulan){
		 jConfirm("Proses data usulan ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "?mod=proses_usulan_gb&id_usulan=" + id_usulan;
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
                                <h1><a style="color:#AA9F00;" href="">DAFTAR SURAT USULAN GAJI BERKALA</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR SURAT USULAN GAJI BERKALA</span></td>
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
				<h3 style="text-align: left;">DAFTAR SURAT USULAN KENAIKAN GAJI BERKALA</h3>
				<div class="bodypanel">
				<button type="button" class="btn btn-success" onclick="document.location.href='?mod=gb_daftar_usulan_tambah';"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah Surat Usulan</button>
				<div class="kelang"></div>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
					<thead>
						<tr class="headertable">
							<th width='40px'>No.</th>
							<th>No. Usulan</th>
							<th width='100px'>Tgl. Usulan</th>
							<th width='200px'>Nama Pejabat Penandatangan</th>
							<th width='200px'>NIP Pejabat Penandatangan</th>
							<th width='200px'>Jabatan Pejabat Penandatangan</th>
							<th width='200px'>Pangkat Pejabat Penandatangan</th>
							<th width='50px'>&nbsp;</th>
							<th width='50px'>&nbsp;</th>
							<th width='50px'>&nbsp;</th>
							<th width='50px'>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<script type="text/javascript">
						$.each(data, function(i, item){
							var text = "";
							var id_level = "<?=$_SESSION['id_level'];?>";
							text += "<tr>";
								text += "<td style='text-align: center;'>" + (i+1) + "</td>";
								text += "<td style='text-align: center;'>" + item.no_usulan + "</td>";
								text += "<td style='text-align: center;'>" + item.tgl_usulan + "</td>";
								text += "<td style='text-align: center;'>" + item.nama_ttd_usulan + "</td>";
								text += "<td style='text-align: center;'>" + item.nip_ttd_usulan + "</td>";
								text += "<td style='text-align: center;'>" + item.jabatan_ttd_usulan + "</td>";
								text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
								if(item.status == 1){
									text += "<td style='text-align: center;'><button type='button' title='Edit Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='edit(" + item.id_usulan + ");'><span class='glyphicon glyphicon-edit'></span></button></td>";
									text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_usulan + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
									text += "<td style='text-align: center;'><button type='button' title='Data Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='daftar_diusulkan(" + item.id_usulan + ");'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
									
									if(id_level != '15'){
										text += "<td style='text-align: center;'><button type='button' title='Proses Ke BKD' class='btn btn-sm btn-success' style='width: 100%;' onclick='proses_ke_bkd(" + item.id_usulan + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
									}else{
										text += "<td style='text-align: center;'><button type='button' title='Proses (ACC) Usulan' class='btn btn-sm btn-success' style='width: 100%;' onclick='acc(" + item.id_usulan + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
									}	
							   }else if(item.status == 2 && id_level == 15){
									text += "<td style='text-align: center;'><button type='button' title='Edit Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='edit(" + item.id_usulan + ");'><span class='glyphicon glyphicon-edit'></span></button></td>";
									text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_usulan + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
									text += "<td style='text-align: center;'><button type='button' title='Data Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='daftar_diusulkan(" + item.id_usulan + ");'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
									
									if(id_level != '15'){
										text += "<td style='text-align: center;'><button type='button' title='Proses Ke BKD' class='btn btn-sm btn-success' style='width: 100%;' onclick='proses_ke_bkd(" + item.id_usulan + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
									}else{
										text += "<td style='text-align: center;'><button type='button' title='Proses (ACC) Data Usulan' class='btn btn-sm btn-success' style='width: 100%;' onclick='acc(" + item.id_usulan + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
									}	
							   }else{
									text += "<td style='text-align: center;'>&nbsp;</td>";
									text += "<td style='text-align: center;'>&nbsp;</td>";
									text += "<td style='text-align: center;'>&nbsp;</td>";
									text += "<td style='text-align: center;'>&nbsp;</td>";
								}
								
							text += "</tr>";
							document.write(text);
						});
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
 