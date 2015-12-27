<script type="text/javascript">
$(document).ready(function(){
	$( "#dialog_cadis" ).dialog({
        autoOpen: false,
		height: 600,
		width: 800,
		modal: true,
        show: "fade",
		hide: "fade"
    });
	
	// function to get AJAX Modal Pop Up list of pegawai yang disulkan pada lampiran SK
	// kepangkatan yang sudah diproses oleh BKD
	<?
		$sql = "SELECT
                	a.*, b.pangkat, b.gol_ruang
                FROM
                	tbl_sk_pmk a
                	LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd_sk = b.id_pangkat
				WHERE 
					a.status = '3'
                ORDER BY
                	a.id_data ASC";
					
		 $q = mysql_query($sql);
		 
		 while($dt = mysql_fetch_array($q)){	
	?>
			$("#lihat<?=$dt['id_surat'];?>").click(function(){
				var no_usulan = "<?=$dt['no_usul_pmk'];?>";
				$("#dialog_cadis").dialog("open");
					$.ajax({
							type: "GET",
							url: "ajax/pmk_daftar_diusulkan.php",
							data: "no_usulan=" + no_usulan,
							success: function(r){
									$("#dialog_cadis").html(r);
									}
					});	
			});
	<?
			
		}
	?>
	
	$("#lihat").click(function(){
		jAlert("TEST");
	});
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
					a.status = '3'
                ORDER BY
                	a.id_data ASC";
					
    $res_data = mysql_query($sql_data);
    while($ds_data = mysql_fetch_array($res_data)){
        $row_data["id_sk"] = $ds_data["id_data"];
        $row_data["no_sk"] = $ds_data["no_sk"];
        $row_data["tgl_sk"] = $ds_data["tgl_sk"];
        $row_data["jabatan_ttd_sk"] = $ds_data["jabatan_ttd_sk"];
        $row_data["nama_ttd_sk"] = $ds_data["pejabat_ttd"];
        $row_data["nip_ttd_sk"] = $ds_data["nip_pejabat_ttd"];
        $row_data["status"] = $ds_data["status"];
		$row_data["stats"] = status_supervisi($ds_data["status"]);
		$row_data["no_usul"] = $ds_data["no_usul_pmk"];
        $row_data["pangkat"] = $ds_data["pangkat"];
        $row_data["gol_ruang"] = $ds_data["gol_ruang"];
		$row_data["scan_sk"] = $ds_data["scan_sk"];
        array_push($data, $row_data);
    }
    echo("var data = " . json_encode($data) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    function edit(id_sk){
        document.location.href = "?mod=kenpang_daftar_sk_edit&id_sk=" + id_sk;
    }
    
    function hapus(id_sk){
        jConfirm("Hapus data SK PMK dengan ID "+ id_sk +" ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/pmk/hapus_sk_pmk.php?id_sk=" + id_sk;
            }
        });
    }
	
	function print(id_sk){
		document.location.href = "?mod=cetak_laporan_pmk&id_sk=" + id_sk;
	}
  
  function something_wrong(wrong){
		jAlert(wrong, "PERHATIAN");
	}
	
	function sukses(pesan){
		jAlert(pesan, "KONFIRMASI", function(r){
            if(r){
                document.location.href = "?mod=pmk_sk_telah_proses";
            }
        });
	}
</script>
<!-- END OF JAVASCRIPT PAGE -->

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR SK PENINJAUAN MASA KERJA YANG SUDAH DIPROSES (ACC) OLEH BKD</h3>
	
    <div class="bodypanel">
    <button type="button" class="btn btn-success" onclick="document.location.href='?mod=pmk_daftar_sk';">
	<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
    
	<div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>No. SK</th>
				<th>No Surat Usul</th>
                <th width='100px'>Tgl. SK</th>
                <th width='200px'>Nama Pejabat<br />Penandatangan</th>
                <th width='200px'>NIP Pejabat<br />Penandatangan</th>
                <th width='200px'>Jabatan Pejabat<br />Penandatangan</th>
                <th width='200px'>Pangkat Pejabat<br />Penandatangan</th>
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
					text += "<td style='text-align: center;'>" + item.no_usul + "</td>";
                    text += "<td style='text-align: center;'>" + item.tgl_sk + "</td>";
                    text += "<td style='text-align: center;'>" + item.nama_ttd_sk + "</td>";
                    text += "<td style='text-align: center;'>" + item.nip_ttd_sk + "</td>";
                    text += "<td style='text-align: center;'>" + item.jabatan_ttd_sk + "</td>";
                    text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
                    
					text += "<td style='text-align: center;'><button type='button' title='Daftar Nama Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' id='lihat"+ item.id_sk +"'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
					text += "<td style='text-align: center;'><button type='button' title='Cetak Laporan-laporan SK PMK' class='btn btn-sm btn-warning' style='width: 100%;' onclick='print("+ item.id_sk +");'><span class='glyphicon glyphicon-print'></span></button></td>";
					
				 if (item.scan_sk != '-' || item.scan_sk != ''){      
					text += "<td style='text-align: center;'><a href='sk_uploaded/kepangkatan/"+item.scan_sk+"' target='_blank'><img src='image/Text-Signature-32.png' width='35' height='35' title='Cetak File Scan SK'></a></td>";
                  }
					text += "<td><a href='?mod=upload_sk_pmk&id_data="+ item.id_sk +"' target='_blank'><img src='image/Upload-48.png' width='18px' class='linkimage' title='Upload File Scan SK' /></a></td>";
					text += "<td style='text-align: center;'><img src='image/Delete-32.png' width='35' height='35' title='Hapus Data SK' onclick='hapus("+ item.id_sk +");'></td>";
                text += "</tr>";
                document.write(text);
            });
        </script>
        </tbody>
    </table>
    </div>
</div>
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="LAMPIRAN DAFTAR PEGAWAI PADA SK PENINJAUAN MASA KERJA (PMK)" style="display: none;">
    
</div>