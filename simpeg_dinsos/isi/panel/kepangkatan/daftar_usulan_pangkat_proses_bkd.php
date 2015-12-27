<script type="text/javascript">
$(document).ready(function(){
	
	<?
		// query daftar data pada tabel tbl_usulan_pangkat
		$q = mysql_query("SELECT * FROM tbl_usulan_pangkat WHERE status_proses = '2' ORDER BY id_usulan DESC");
		$no = 1;
		while($d = mysql_fetch_array($q)){
	?>
		$("#btn_view<?=$no;?>").click(function(){
			var no_usulan = "<?=$d['no_usulan'];?>";
				$("#dialog_cadis").dialog("open");
					$.ajax({
							type: "GET",
							url: "ajax/pangkat_daftar_diusulkan.php",
							data: "no_usulan=" + no_usulan,
							success: function(r){
									$("#dialog_cadis").html(r);
									}
						});	
			});
	<?
			$no++;
		}
	?>	
	
});	
</script>
<!-- CONTROLLER -->

<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $data = array();
    $sql_data = "SELECT
                	a.*, b.pangkat, b.gol_ruang
                FROM
                	tbl_usulan_pangkat a
                	LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd = b.id_pangkat
                WHERE
					a.status_proses = 2
                ORDER BY
                	a.id_usulan ASC";
					
    $res_data = mysql_query($sql_data);
	
    while($ds_data = mysql_fetch_array($res_data)){
        $row_data["id_usulan"] = $ds_data["id_usulan"];
        $row_data["no_usulan"] = $ds_data["no_usulan"];
        $row_data["tgl_usulan"] = tglindonesia($ds_data["tgl_usulan"]);
        $row_data["pejabat_ttd"] = $ds_data["nama_pejabat_ttd"];
        $row_data["nip_pejabat_ttd"] = $ds_data["nip_pejabat_ttd"];
        $row_data["jabatan_ttd"] = $ds_data["jabatan_ttd"];
        $row_data["pangkat"] = $ds_data["pangkat"];
        $row_data["gol_ruang"] = $ds_data["gol_ruang"];
		$row_data["status"] = $ds_data["status_proses"];
		//$row_data["sp"] = status_supervisi($ds_data["status_proses"]);
        array_push($data, $row_data);
    }
    echo("var data = " . json_encode($data) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
	 $(document).ready(function(){
        $("#alert_add_sukses").click(function(){
			$(this).fadeOut('slow');
		});
    });
	
    function acc_surat(id_usulan){
        jConfirm("ACC data usulan dengan ID "+ id_usulan +" ini ?", "KONFIRMASI", function(r){
            if(r){
                document.location.href = "?mod=acc_usulan_pangkat&id_usulan=" + id_usulan;
            }
        });
    }
    
    function daftar_diusulkan(no_usulan){
        document.location.href = "?mod=pangkat_daftar_usulan_diusulkan&no_usulan=" + no_usulan;
    }
	
	function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
	function sukses_konfirmasi(pesan_sukses){
        jAlert(pesan_sukses, "PEMBERITAHUAN", function(r){
            document.location.href="?mod=daftar_kpk";
        });
    }
	
	function lihat(id_usulan){
		 $( "#dialog_kenpang_proses_bkd" ).dialog("open");
		 $.ajax({
				type: "GET",
				url: "ajax/pangkat_daftar_diusulkan.php",
				data: "id_usulan=" + id_usulan,
				success: function(r){
					$("#dialog_kenpang_proses_bkd").html(r);
				}
		 });	
	}
	function edit(id_usulan){
        document.location.href = "?mod=daftar_kpk_edit&id_usulan=" + id_usulan;
    }
    
    function hapus(id_usulan){
        jConfirm("Hapus Data Usulan dengan ID " + id_usulan + " ?", "KONFIRMASI", function(r){
            if(r){
                document.location.href = "php/kpk/hapus_usulan_pangkat.php?id_usulan=" + id_usulan;
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
                                <h1><a style="color:#AA9F00;" href="">DAFTAR USULAN KENAIKAN PANGKAT</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>DAFTAR USULAN KENAIKAN PANGKAT</span></td>
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
				<h3 style="text-align: left;">DAFTAR SURAT USULAN KENAIKAN PANGKAT</h3>
				<?php 
					if(isset($_GET['code']) && isset($_GET['nomor'])){
						if($_GET['code'] == 1){	
							//echo "sukses";
							echo "<div class='alert alert-success' role='alert' id='alert_add_sukses' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
							echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
							echo "Data usulan kenaikan pangkat dengan No.Usulan : <b>".$_GET['nomor']." </b> diterima.</center>";
							echo "</div>";
						}else if($_GET['code'] == 2){
							echo "<div class='alert alert-warning' role='alert' id='alert_add_sukses'  title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
							echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
							echo "Data usulan kenaikan pangkat dengan No.Usulan : <b>".$_GET['nomor']." </b> ditolak.</center>";
							echo "</div>";
						}
					} 
				?><br/>	
				<div class="bodypanel">
				<button type="button" class="btn btn-success" onclick="document.location.href='?mod=daftar_kpk_tambah';"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah Usulan</button>
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
							text += "<tr>";
								text += "<td style='text-align: center;'>" + (i+1) + "</td>";
								text += "<td style='text-align: center;'>" + item.no_usulan + "</td>";
								text += "<td style='text-align: center;'>" + item.tgl_usulan + "</td>";
								text += "<td style='text-align: center;'>" + item.pejabat_ttd + "</td>";
								text += "<td style='text-align: center;'>" + item.nip_pejabat_ttd + "</td>";
								text += "<td style='text-align: center;'>" + item.jabatan_ttd + "</td>";
								text += "<td style='text-align: center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
									if(item.status == 2){
										text += "<td style='text-align: center;'><button type='button' title='Daftar Nama Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='lihat("+ item.id_usulan +");'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
										text += "<td style='text-align: center;'><button type='button' title='Proses ACC Surat Usulan' class='btn btn-sm btn-success' style='width: 100%;' onclick='acc_surat(" + item.id_usulan + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
										text += "<td style='text-align: center;'><button type='button' title='Edit Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='edit(" + item.id_usulan + ");'><span class='glyphicon glyphicon-edit'></span></button></td>";
										text += "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(" + item.id_usulan + ");'><span class='glyphicon glyphicon-trash'></span></button></td>";
										
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
 

