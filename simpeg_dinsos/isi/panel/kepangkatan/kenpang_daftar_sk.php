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
	
	$("#expand").click(function(){
        $("#bodyfilter").slideToggle(500);
    });
	
	ambil_tanggal("tgl_sk");
});	
</script>

<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $data = array();
	if(isset($_POST['no_sk']) && $_POST['no_sk'] <> ''){
		$sql_data = "SELECT
						a.*, b.pangkat, b.gol_ruang
					FROM
						tbl_sk_kenpang a
						LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd_sk = b.id_pangkat
					WHERE 
						a.no_sk LIKE '%". $_POST['no_sk'] ."%' 
					ORDER BY
						a.id_data ASC";
	}else if(isset($_POST['tgl_sk']) && $_POST['tgl_sk'] <> ''){
		$sql_data = "SELECT
						a.*, b.pangkat, b.gol_ruang
					FROM
						tbl_sk_kenpang a
						LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd_sk = b.id_pangkat
					WHERE 
						a.tgl_sk LIKE '%". $_POST['tgl_sk'] ."%'
					ORDER BY
						a.id_data ASC";
	}else{
		$sql_data = "SELECT
						a.*, b.pangkat, b.gol_ruang
					FROM
						tbl_sk_kenpang a
						LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd_sk = b.id_pangkat
					ORDER BY
						a.id_data ASC LIMIT 120";
	}					
					
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
	
	function add_peg(id_sk){
		document.location.href="?mod=sk_kenpang_tambah_pegawai&id_data="+ id_sk;
	}
	
    function edit(id_sk){
        document.location.href = "?mod=kenpang_daftar_sk_edit&id_sk=" + id_sk;
    }
    
    function hapus(id_sk){
        jConfirm("Hapus data SK dengan ID "+ id_sk +" ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/kpk/hapus_sk_pangkat.php?id_sk=" + id_sk;
            }
        });
    }
    
    function proses_ke_bkd(id_sk){
		jConfirm("Proses ke BKD Data SK Kepangkatan dengan ID "+ id_sk +" ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/kpk/sk_kenpang_proses_bkd.php?id_sk=" + id_sk;
            }
        });
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
	 function cetak_daftar_usulan(id_sk){
        window.open("cetak/sk/kepangkatan/sk_usulan_kenpang.php?id_sk=" + id_sk);
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
                                <h1><a style="color:#AA9F00;" href="">DAFTAR DATA SK KEPANGKATAN</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR DATA SK KEPANGKATAN</span></td>
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
		
			<form name="frm" action="?mod=kenpang_daftar_sk" method="post">
				<div class="panelcontainer" style="width: 100%;">
					<h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA PENCARIAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
					<div class="bodypanel" id="bodyfilter">
						<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='20%'>Nomor Surat Keputusan (SK)</td>
								<td width='10px'>:</td>
								<td><input type="text" name="no_sk" value="<?=isset($_POST["no_sk"]) ? $_POST['no_sk'] : ""; ?>" title="Input Nomor SK Kepangkatan"/></td>
							</tr>
							<tr>
								<td width='20%'>Tanggal Surat</td>
								<td width='10px'>:</td>
								<td>
									<input type="text" name="tgl_sk" id="tgl_sk" class="ufilter" value="<?=isset($_POST["tgl_sk"]) ? $_POST["tgl_sk"] : ""; ?>" />
								</td>
							</tr>
							
						</table>
						<div class="kelang"></div>
						<table border="0px" cellspacing='0' cellpadding='0' width='40%'>
							<tr>
								<td width='50%'><input type="submit" value='Filter' style="width: 100%;" class="btn btn-success" /></td>
								<td width='50%'><input type="reset" value='Reset' style="width: 100%;" class="btn btn-warning"/></td>
							</tr>
						</table>
					</div>
				</div>
			</form>
			<div class="kelang"></div>
			<div class="kelang"></div>
			<div class="panelcontainer" style="width: 100%;">
				<h3 style="text-align: left;">DAFTAR SK PENGUSULAN KENAIKAN PANGKAT</h3>
				<div class="bodypanel">
				<button type="button" class="btn btn-success" onclick="document.location.href='?mod=kenpang_tambah_sk';"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah Usulan ke BKN</button>
				<button type="button" class="btn btn-info" onclick="document.location.href='?mod=kenpang_sk_telah_diproses';"><span class='glyphicon glyphicon-min'></span>&nbsp;Daftar SK Telah Diproses</button>
				<div class="kelang"></div>
				<table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
					<thead>
						<tr class="headertable">
							<th>Status</th>
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
							<th width='50px'>&nbsp;</th>
							<th width='50px'>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<script type="text/javascript">
						$.each(data, function(i, item){
							var text = "";
							text += "<tr>";
								text += "<td style='text-align: center;'>" + item.stats + "</td>";
								text += "<td style='text-align: center;'>" + (i+1) + "</td>";
								text += "<td style='text-align: center;'>" + item.no_sk + "</td>";
								text += "<td style='text-align: center;'>" + item.tgl_sk + "</td>";
								text += "<td style='text-align: center;'>" + item.nama_ttd_sk + "</td>";
								text += "<td style='text-align: center;'>" + item.nip_ttd_sk + "</td>";
								text += "<td style='text-align: center;'>" + item.jabatan_ttd_sk + "</td>";
								text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
								if(item.status == 1){
									text += "<td style='text-align: center;'><button type='button' title='Edit Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='edit(" + item.id_sk + ");'><span class='glyphicon glyphicon-edit'></span></button></td>";
									text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_sk + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
									text += "<td style='text-align: center;'><button type='button' title='Daftar Nama Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='list_peg("+ item.id_sk +")'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
									text += "<td style='text-align: center;'><button type='button' title='Tambahkan Pegawai Pada Lampiran SK' class='btn btn-sm btn-success' style='width: 100%;' onclick='add_peg("+ item.id_sk +")'><span class='glyphicon glyphicon-plus'></span></button></td>";
									text += "<td style='text-align: center;'><button type='button' title='Cetak Daftar Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='cetak_daftar_usulan(" + item.id_sk + ");'><span class='glyphicon glyphicon-print'></span></button></td>";
									text += "<td style='text-align: center;'><button type='button' title='Proses Ke BKD' class='btn btn-sm btn-success' style='width: 100%;' onclick='proses_ke_bkd(" + item.id_sk + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
									
								}else{
									text += "<td style='text-align: center;'>&nbsp;</td>";
									text += "<td style='text-align: center;'>&nbsp;</td>";
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
				</table><br/>
				<span style="font-size:13px; font-weight:bold;">*) - Keterangan Kolom Status pada tabel diatas, jika berwarna <span style="color:yellow;">kuning</span> 
					berarti belum diproses oleh BKD.<br/>  - Jika berwarna <span style="color:green;">hijau</span> berarti sudah di ACC oleh Admin BKD.<br/>  - Dan jika berwarna 
					<span style="color:red;">merah</span> berarti sudah di proses ke BKD, namun belum di ACC (Proses) oleh admin BKD.</span><br/>
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
<div id="dialog_cadis" title="DAFTAR LAMPIRAN PEGAWAI SK KENAIKAN PANGKAT" style="display: none;">
    
</div>