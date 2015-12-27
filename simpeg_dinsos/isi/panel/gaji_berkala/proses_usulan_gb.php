<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    
	// generate JSON untuk data daftar pangkat
	$pangkat = array();
    $sql_pangkat = "SELECT * FROM ref_pangkat";
    $res_pangkat = mysql_query($sql_pangkat);
    while($ds_pangkat = mysql_fetch_array($res_pangkat)){
        $row_pangkat["id_pangkat"] = $ds_pangkat["id_pangkat"];
        $row_pangkat["gol_ruang"] = $ds_pangkat["gol_ruang"];
        $row_pangkat["pangkat"] = $ds_pangkat["pangkat"];
        array_push($pangkat, $row_pangkat);
    }
    echo("var pangkat = " . json_encode($pangkat) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tgl_usulan");
		
		$("#alert_add_sukses").click(function(){
			$(this).fadeOut('slow');
		});
    });
    
    function simpan(){
		$("#frm").submit();
     }
    
    function kembali(){
        document.location.href="?mod=gb_daftar_usulan";
    }
	
	function acc(mode, id_usulan){
		if(mode == 2){
			var catatan = $('#catatan').val();
			document.location.href="php/gaji_berkala/acc_usulan_gb.php?mode="+mode+"&id_usulan="+id_usulan+"&catatan="+catatan;
		}else{
			document.location.href="php/gaji_berkala/acc_usulan_gb.php?mode="+mode+"&id_usulan="+id_usulan;
		}	
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Data surat usulan penyesuaian masa kerja telah disimpan", "KONFIRMASI", function(r){
            document.location.href="?mod=pmk_daftar_usulan_diusulkan";
        });
    }

</script>
<!-- END OF JAVASCRIPT FROM CHILD -->
<?php
	$id_usulan = mysql_real_escape_string(trim(strip_tags($_GET['id_usulan'])));

	$sql = "SELECT * FROM tbl_usulan_gaji_berkala WHERE id_usulan = '". $id_usulan ."'";
	$query = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($query);
?>


<table width="1024" border="0" cellspacing="2" cellpadding="5">
      <tr> 
      <!-- Header -->
          <td>
        	<div id='header' style='background:url(./image/coba/header2.png) no-repeat;'>
              <table border="0" id='atasan'>
                        <tr>
                                <td colspan='2' style="text-align:right; padding-right:10px;">
                                <h1><a style="color:#AA9F00;" href="">PROSES SURAT USULAN GAJI BERKALA</a></h1>
                                </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; padding-left:10px; border-left:0px solid black;"><a href='./'> <span></span> BERANDA UTAMA </a>
                                 <span> </span> <img src="./image/panah.gif" /> <span>PROSES SURAT USULAN GAJI BERKALA</span></td>
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
		
			<form name="frm" id="frm" action="" method="POST">
			<div class="panelcontainer panelform" style="width: 100%;">
				<h3 style="text-align: left;">Proses Data Usulan Kenaikan Gaji Berkala (ID Data : <?=$row['id_usulan'];?>) </h3>
				<?php
					if(isset($_GET['code'])){
						if($_GET['code'] == 2){	
							//echo "sukses";
							echo "<div class='alert alert-success' role='alert' id='alert_add_sukses'>";
							echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
							echo "Data Usulan Kenaikan Gaji Berkala Diterima.</center>";
							echo "</div>";
						}else if($_GET['code'] == 1){
							echo "<div class='alert alert-warning' role='alert' id='alert_add_sukses'>";
							echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
							echo "Data Usulan Kenaikan Gaji Berkala Ditolak.</center>";
							echo "</div>";
						}
					}	
				?>		
				<button type="button" class="btn btn-lg btn-success" onclick="kembali();" style="margin-left:15px;margin-top:5px;">
				<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
				<div class="bodypanel bodyfilter" id="bodyfilter">
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td width='50%'>
								<label>NO. Usulan :</label>
								<input type="text" style='width:90%;' name="no_usul" id="no_usul" class="form-control" value="<?=$row['no_usulan'];?>" readonly="readonly"/>
							</td>
							<td>
								<label>Tgl. Usulan:</label>
								<input type="text" name="tgl_usul"  style='width:90%;' id="tgl_usul" class="form-control" value="<?=$row['tgl_usulan'];?>" readonly="readonly"/>
							</td>
						</tr>
						<tr>
							<td width='50%'>
								<label>Nama Pejabat Penandatangan  :</label>
								<input type="text" style='width:90%;' name="pejabat_ttd"  id="pejabat_ttd" class="form-control" value="<?=$row['nama_ttd_usulan'];?>" readonly="readonly"/>
							</td>
							<td>
							   <label>NIP Pejabat Penandatangan :</label>
							   <input type="text" style='width:90%;' name="nip_pejabat_ttd" id="nip_pejabat_ttd" class="form-control" value="<?=$row['nip_ttd_usulan'];?>" readonly="readonly"/>
							</td>
						</tr>
						
						<tr>
							 <td width="50%">
								<label>Jabatan Pejabat Penandatangan : </label>
								<input type="text" style='width:90%;' name="jabatan_ttd" id="jabatan_ttd" class="form-control" value="<?=$row['jabatan_ttd_usulan'];?>" readonly="readonly"/>
							</td>
						</tr>
						
					</table>
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td>
								 <label>Catatan Penolakan: </label>
								<textarea style="height:80px;" id="catatan" name="catatan" placeholder="Jika ditolak, isi catatan penolakan ini, jika diterima (ACC) dikosongkan saja"></textarea>
							</td>
						</tr>
					</table>
					<div class="kelang"></div>
					<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
						<tr>
							<td align='left'>
								 <input type="buttom" value="Terima" style="width: 150px; height: 40px;" class="btn btn-success" onclick="acc(3, <?=$row['id_usulan'];?>);"/>
								 <input type="button" value="Tolak" style="width: 150px; height: 40px;" class="btn btn-info"  onclick="acc(2, <?=$row['id_usulan'];?>);"/>
						   </td>
						</tr>
					</table>
				</div>
			</div>
			</form>

	</div>
</td>
</tr>
<tr>
     <td><br><div id='footer'></div></td>
 </tr>
 </table>
 