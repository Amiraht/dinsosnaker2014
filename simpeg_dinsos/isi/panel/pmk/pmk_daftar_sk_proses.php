<script type="text/javascript">
$(document).ready(function(){
	<?php
		$q = mysql_query("SELECT a.* , b.id_usulan, b.no_usulan
								FROM tbl_sk_pmk a
								LEFT JOIN tbl_usulan_pmk b ON a.no_usul_pmk = b.no_usulan
								WHERE a.status='2' 
								ORDER BY a.id_surat ASC");
								
		while($d = mysql_fetch_array($q)){
	?>
		$("#btn_view<?=$d['id_surat'];?>").click(function(){
			var id_usulan = "<?=$d['id_usulan'];?>";
				$("#dialog_usul_pmk").dialog("open");
				$.ajax({
					type: "GET",
					url: "ajax/pmk_daftar_diusulkan.php",
					data: "id_usulan=" + id_usulan,
					success: function(r){
						$("#dialog_usul_pmk").html(r);
					}
				});	
			});
	<?php
			
		}
	?>	
});	
</script>

<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $data = array();
    $sql_data = "SELECT
                	a.*, b.pangkat, b.gol_ruang
                FROM
                	tbl_sk_pmk a
                	LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd = b.id_pangkat
				WHERE
					a.status = '2'	
                ORDER BY
                	a.id_surat ASC";
					
    $res_data = mysql_query($sql_data);
	
    while($ds_data = mysql_fetch_array($res_data)){
        $row_data["id_sk"] = $ds_data["id_surat"];
        $row_data["no_sk"] = $ds_data["no_sk"];
		$row_data["tgl_input"] = tglindonesia($ds_data["tgl_input"]);
        $row_data["tgl_sk"] = tglindonesia($ds_data["tgl_surat"]);
        $row_data["pejabat_ttd"] = ($ds_data["pejabat_ttd"] == "" ? "-" : $ds_data["pejabat_ttd"]);
        $row_data["nip_ttd_sk"] = $ds_data["nip_pejabat_ttd"];
		$row_data["jabatan_ttd_sk"] = $ds_data["jabatan_ttd_sk"];
		$row_data["stats"] = status_supervisi($ds_data["status"]);
		$row_data["status"] = $ds_data["status"];
        $row_data["pangkat"] = $ds_data["pangkat"];
        $row_data["gol_ruang"] = $ds_data["gol_ruang"];
        array_push($data, $row_data);
    }
    echo("var data = " . json_encode($data) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    function edit(id_sk){
        document.location.href = "?mod=pmk_daftar_sk_edit&id_sk=" + id_sk;
    }
    
    function hapus(id_sk){
        jConfirm("Hapus data SK PMK dengan ID "+ id_sk +" ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/pmk/pmk_daftar_sk_hapus.php?id_sk=" + id_sk;
            }
        });
    }
    
    function proses(id_sk){
		jConfirm("Proses ke BKD Data SK PMK dengan ID "+ id_sk +" ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "?mod=proses_sk_pmk&id_sk=" + id_sk;
            }
        });
    }
   
	 function cetak_daftar_usulan(id_usulan){
        //window.open("cetak/sk/kepangkatan/sk_usulan_kenpang.php?id_usul=" + id_usulan);
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR SK PENINJAUAN MASA KERJA (PMK) </h3>
    <div class="bodypanel">
    <button type="button" class="btn btn-success" onclick="document.location.href='?mod=pmk_daftar_sk_tambah';"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah SK</button>
    <button type="button" class="btn btn-info" onclick="document.location.href='?mod=pmk_sk_telah_proses';"><span class='glyphicon glyphicon-min'></span>&nbsp;Daftar SK Telah Diproses</button>
	<div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>No. SK</th>
                <th width='100px'>Tgl. SK</th>
                <th width='200px'>Nama Pejabat<br />Penandatangan</th>
                <th width='200px'>NIP Pejabat<br />Penandatangan</th>
				<th width='200px'>Jabatan Pejabat<br />Penandatangan</th>
                <th width='200px'>Pangkat Pejabat<br />Penandatangan</th>
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
                text += "<tr>";
                    text += "<td style='text-align: center;'>" + (i+1) + "</td>";
                    text += "<td style='text-align: center;'>" + item.no_sk + "</td>";
                    text += "<td style='text-align: center;'>" + item.tgl_sk + "</td>";
                    text += "<td style='text-align: center;'>" + item.pejabat_ttd + "</td>";
                    text += "<td style='text-align: center;'>" + item.nip_ttd_sk + "</td>";
					text += "<td style='text-align: center;'>" + item.jabatan_ttd_sk + "</td>";
                    text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
				    text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_sk + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
					text += "<td style='text-align: center;'><button type='button' title='Daftar Nama Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' id='btn_view"+ item.id_sk +"'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
                    text += "<td style='text-align: center;'><button type='button' title='Cetak Daftar Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='cetak_daftar_usulan(" + item.id_sk + ");'><span class='glyphicon glyphicon-print'></span></button></td>";
				    text += "<td style='text-align: center;'><button type='button' title='ACC (Proses) Data SK ini' class='btn btn-sm btn-success' style='width: 100%;' onclick='proses(" + item.id_sk + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
						
                text += "</tr>";
                document.write(text);
            });
        </script>
        </tbody>
    </table><br/>
	<span style="font-size:13px; font-weight:bold;">*) - Keterangan Kolom Status pada tabel diatas, jika berwarna <span style="color:yellow;">kuning</span> 
		berarti belum diproses oleh BKD.<br/>  - Jika berwarna <span style="color:green;">hijau</span> berarti sudah di ACC oleh Admin BKD.<br/>  - Dan jika berwarna 
		<span style="color:red;">merah</span> berarti sudah di proses ke BKD, namun belum di ACC (Proses) oleh admin BKD.</span><br/>
    </div>
</div>
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="DATA PEGAWAI USULAN KENAIKAN PANGKAT" style="display: none;">
    
</div>