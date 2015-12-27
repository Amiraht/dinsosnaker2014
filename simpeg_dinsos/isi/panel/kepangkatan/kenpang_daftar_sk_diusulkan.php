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
	
	
});	
</script>

<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $data = array();
    $sql_data = "SELECT
                	a.*, b.pangkat, b.gol_ruang
                FROM
                	tbl_sk_kenpang a
                	LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd_sk = b.id_pangkat
				WHERE 
					a.status_supervisi = '2'
                ORDER BY
                	a.id_data ASC";
					
    $res_data = mysql_query($sql_data);
    while($ds_data = mysql_fetch_array($res_data)){
        $row_data["id_sk"] = $ds_data["id_data"];
        $row_data["no_sk"] = $ds_data["no_sk"];
        $row_data["tgl_sk"] = $ds_data["tgl_sk"];
        $row_data["jabatan_ttd_sk"] = $ds_data["jabatan_ttd_sk"];
        $row_data["nama_ttd_sk"] = $ds_data["nama_ttd_sk"];
        $row_data["nip_ttd_sk"] = $ds_data["nip_ttd_sk"];
        $row_data["status"] = $ds_data["status_supervisi"];
		$row_data["stats"] = status_supervisi($ds_data["status_supervisi"]);
		$row_data["no_usul"] = $ds_data["no_usulan_naik_pangkat"];
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
	function lihat_usulan(id_sk){
				$("#dialog_cadis").dialog("open");
					$.ajax({
							type: "GET",
							url: "ajax/daftar_diusulkan_sk_kenpang.php",
							data: "id_sk=" + id_sk,
							success: function(r){
									$("#dialog_cadis").html(r);
									}
					});	
	}

    function edit(id_sk){
        document.location.href = "?mod=kenpang_daftar_sk_edit&id_sk=" + id_sk;
    }
    
    function hapus(id_sk){
        jConfirm("Hapus data usulan dengan ID "+ id_sk +" ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/kpk/hapus_sk_pangkat.php?id_sk=" + id_sk;
            }
        });
    }
    
    function proses(id_sk){
        document.location.href = "?mod=acc_sk_kenpang&id_sk=" + id_sk;
    }
    
    function daftar_diusulkan(id_sk){
        document.location.href = "?mod=kenpang_daftar_sk_diusulkan&id_sk=" + id_sk;
    }

	function cetak_sk(file){
		 jConfirm("Cetak File SK ?", "KONFIRMASI", function(r){
            if(r){
              window.open('sk_uploaded/kepangkatan/' + file);
            }
        });
	}
	
	function acc_peg(id_pegawai){
		jConfirm("ACC Pegawai dengan ID "+id_pegawai+" ?", "KONFIRMASI", function(r){
            if(r){
				jAlert("Pegawai ini ditolak", "KONFIRMASI");
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
                                <h1><a style="color:#AA9F00;" href="">DAFTAR SK KEPANGKATAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR SK KEPANGKATAN</span></td>
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
				<h3 style="text-align: left;">DAFTAR SK PENGUSULAN KENAIKAN PANGKAT YANG DIUSULKAN KE BKD</h3>
				
				<div class="bodypanel">
				<button type="button" class="btn btn-success" onclick="document.location.href='?mod=kenpang_daftar_sk';">
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
								text += "<td><a href='?mod=upload_sk_kenpang&id_data="+ item.id_sk +"'><img src='image/Upload-48.png' width='18px' class='linkimage' title='Upload SK' /></a></td>";
								text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_sk + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
								text += "<td style='text-align: center;'><button type='button' title='Data Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='lihat_usulan("+ item.id_sk +")'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
								text += "<td style='text-align: center;'><button type='button' title='Proses Data Usulan (ACC)' class='btn btn-sm btn-success' style='width: 100%;' onclick='proses(" + item.id_sk + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
								text += "<td style='text-align: center;'><button type='button' class='btn btn-sm btn-success' style='width: 100%;' title='Print SK' onclick='cetak("+item.scan_sk+")'><span class='glyphicon glyphicon-print'></span></button></td>";
								text += "<td><a href='?mod=simpan_berkas_sk_kepangkatan&id_data="+ item.id_sk +"' ><img src='image/attachment-48.png' width='18px' class='linkimage' title='Upload Dan Simpan Berkas File SK' /></a></td>";			
									
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
 
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="DATA PEGAWAI USULAN KENAIKAN PANGKAT" style="display: none;">
    
</div>