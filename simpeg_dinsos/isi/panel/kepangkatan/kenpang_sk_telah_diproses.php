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
                	tbl_sk_kenpang a
                	LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd_sk = b.id_pangkat
				WHERE 
					a.status_supervisi = '3'
                ORDER BY
                	a.id_data DESC";
					
    $res_data = mysql_query($sql_data);
    while($ds_data = mysql_fetch_array($res_data)){
        $row_data["id_sk"] = $ds_data["id_data"];
        $row_data["no_sk"] = $ds_data["no_sk"];
        $row_data["tgl_sk"] = tglindonesia($ds_data["tgl_sk"]);
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
	function list_peg(id_sk){
		$("#dialog_cadis").dialog("open");
					$.ajax({
							type: "GET",
							url: "ajax/sk_pangkat_daftar_diusulkan.php",
							data: "id_data=" + id_sk,
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
    
    function proses_ke_bkd(id_sk){
        document.location.href = "?mod=kenpang_daftar_sk_diproses&id_sk=" + id_sk;
    }
    
    function daftar_diusulkan(id_sk){
        document.location.href = "?mod=kenpang_daftar_sk_diusulkan&id_sk=" + id_sk;
    }
	
	function something_wrong(wrong){
		jAlert(wrong, "PERHATIAN");
	}
	
	function sukses(pesan){
		jAlert(pesan, "KONFIRMASI", function(r){
            if(r){
                document.location.href = "?mod=kenpang_daftar_sk";
            }
        });
	}
    
	function lampiran_sk(id_sk){
		window.open('cetak/sk/kepangkatan/sk_usulan_kenpang.php?id_sk='+id_sk);
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
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR SK KEPANGKATAN YANG TELAH DIPROSES</span></td>
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
					<h3 style="text-align: left;">DAFTAR SK PENGUSULAN KENAIKAN PANGKAT YANG SUDAH DIPROSES (ACC) OLEH BKD</h3>
					<?php
						// all the notification act mas bro
						/*
						if(isset($_GET['code'])  AND isset($_GET['act'])){
							if($_GET['code'] == 1 AND $_GET['act'] == 'del'){
					?>		
							<div class="alert alert-success" role="alert">
									<center><img src="image/icn_alert_success.png" width="18px;" />
									Hapus Data SK Pengusulan Kenaikan Pangkat <strong>Sukses</strong>.</center>
								</div>
					<?		
							}else if($_GET['code'] == 2 AND $_GET['act'] == 'del'){
					?>	
								<div class="alert alert-warning" role="alert">
									<center><img src="image/icn_alert_warning.png" width="18px;" />
									<strong>Maaf</strong>, Data SK Pengusulan Kenaikan Pangkat gagal dihapus.</center>
								</div>
					<?	
							}
						}	
						*/
					?>
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
									
									text += "<td style='text-align: center;'><button type='button' title='Daftar Nama Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='list_peg("+ item.id_sk +");' ><span class='glyphicon glyphicon-bookmark'></span></button></td>";
									text += "<td style='text-align: center;'><button type='button' title='Cetak Laporan-laporan SK Kepangkatan' class='btn btn-sm btn-warning' style='width: 100%;' onclick='cetak_sk_kenpang("+ item.id_sk +");'><span class='glyphicon glyphicon-print'></span></button></td>";
								 
									if (item.scan_sk == "-" || item.scan_sk == ""){      
									text += "<td><a href='?mod=upload_sk_kenpang&id_data="+ item.id_sk +"'><img src='image/Upload-48.png' width='18px' class='linkimage' title='Upload File Scan SK' /></a></td>";
									
								  }else{
									text += "<td style='text-align: center;'><a href='sk_uploaded/kepangkatan/"+item.scan_sk+"' target='_blank'><img src='image/Text-Signature-32.png' width='35' height='35' title='Cetak File Scan SK'></a></td>";
								  }
								
								  text += "<td style='text-align: center;'><button type='button' title='Cetak Lampiran SK' class='btn btn-sm btn-info' style='width: 100%;' onclick='lampiran_sk("+ item.id_sk +");'><span class='glyphicon glyphicon-print'></span></button></td>";
								  
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