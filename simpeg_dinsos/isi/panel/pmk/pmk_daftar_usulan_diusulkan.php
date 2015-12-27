<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $data = array();
    $sql_data = "SELECT DISTINCT * FROM tbl_usulan_pmk WHERE status_supervisi = '2' AND 
				no_usulan IN (SELECT DISTINCT no_usulan FROM tbl_usulan_pmk ORDER BY id_usulan ASC)";
					
    $res_data = mysql_query($sql_data);
    while($ds_data = mysql_fetch_array($res_data)){
        $row_data["id_usulan"] = $ds_data["id_usulan"];
        $row_data["no_usulan"] = $ds_data["no_usulan"];
        $row_data["tgl_usulan"] = $ds_data["tgl_usulan"];
        $row_data["pejabat_pengusul"] = $ds_data["pejabat_pengusul"];
        $row_data["nip_pejabat_pengusul"] = $ds_data["nip_pejabat_pengusul"];
        $row_data["jabatan_penandatangan"] = $ds_data["jabatan_penandatangan"];
		//$row_data["status"] = $ds_data["status_supervisi"];
        array_push($data, $row_data);
    }
	
    echo("var data = " . json_encode($data) . ";\n");
	
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
    function hapus(id_usulan){
        jConfirm("Hapus data usulan dengan ID "+ id_usulan + "?", "KONFIRMASI", function(r){
            if(r){
                document.location.href = "php/pmk/pmk_daftar_diusulkan_hapus.php?id_usul=" + id_usulan;
            }
        });
    }
    
    function proses(id_usulan){
        jConfirm("Proses Data usulan PMK ID "+ id_usulan +" ?", "KONFIRMASI", function(r){
            if(r){
                document.location.href = "?mod=pmk_diusulkan_proses&id_usul=" + id_usulan;
            }
        });
    }
    
  
	function lihat_usulan(id_usulan){
		$("#dialog_usul_pmk").dialog("open");
		$.ajax({
			type: "GET",
			url: "ajax/pmk_daftar_diusulkan.php",
			data: "id_usulan=" + id_usulan,
			success: function(r){
				$("#dialog_usul_pmk").html(r);
			}
		});	
}
</script>
<!-- END OF JAVASCRIPT PAGE -->

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR SURAT USULAN PENINJAUAN MASA KERJA</h3>
	
    <div class="bodypanel">
    
	<div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th width='180px' >No.Usulan</th>
                <th width='180px'>Tgl Usulan</th>
                <th width='200px'>Pejabat Pengusul</th>
                <th width='180px'>Nip Pejabat Pengusul</th>
				<th width='200px'>Jabatan Pengusul</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <script type="text/javascript">
            $.each(data, function(i, item){
                var text = "";
                text += "<tr>";
                    text += "<td style='text-align: center;'>" + (i+1) + "</td>";
                    text += "<td style='text-align: center;'>" + item.no_usulan + "</td>";
                    text += "<td style='text-align: center;'>" + item.tgl_usulan + "</td>";
                    text += "<td style='text-align: center;'>" + item.pejabat_pengusul + "</td>";
                    text += "<td style='text-align: center;'>" + item.nip_pejabat_pengusul + "</td>";
                    text += "<td style='text-align: center;'>" + item.jabatan_penandatangan + "</td>";
                    text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_usulan + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
					text += "<td style='text-align: center;'><button type='button' title='Data Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='lihat_usulan("+ item.id_usulan +")'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
                    text += "<td style='text-align: center;'><button type='button' title='Proses Data Usulan (ACC)' class='btn btn-sm btn-success' style='width: 100%;' onclick='proses(" + item.id_usulan + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
                
				text += "</tr>";
                document.write(text);
            });
        </script>
        </tbody>
    </table>
    </div>
</div>
